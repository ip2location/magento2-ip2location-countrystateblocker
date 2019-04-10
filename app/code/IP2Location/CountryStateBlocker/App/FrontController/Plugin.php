<?php
namespace IP2Location\CountryStateBlocker\App\FrontController;

class Plugin
{
	protected $_session;
	protected $_ruleFactory;
	protected $_dataHelper;
	protected $_storeManager;

	public function __construct(
		\Magento\Backend\Model\Session						$session,
		\Magento\Store\Model\StoreManager					$storeManager,
		\IP2Location\CountryStateBlocker\Model\RuleFactory	$ruleFactory,
		\IP2Location\CountryStateBlocker\Helper\Data		$dataHelper
	) {
		$this->_session			= $session;
		$this->_storeManager	= $storeManager;
		$this->_ruleFactory		= $ruleFactory;
		$this->_dataHelper		= $dataHelper;
	}

	public function aroundDispatch(
		\Magento\Framework\App\FrontControllerInterface	$subject,
		callable										$proceed,
		\Magento\Framework\App\RequestInterface			$request
	) {
		if (!$this->_dataHelper->isEnabled()) {
			return $proceed($request);
		}

		if ($this->_session->getRedirected()) {
			$this->_session->setRedirected(null);
			return $proceed($request);
		}

		$this->_session->setRedirected(1);

		if (!$this->_session->getCountryCode()) {
			$ip = $_SERVER['REMOTE_ADDR'];

			if (isset($_SERVER['DEV_MODE'])) {
				$ip = '8.8.8.8';
			}

			if ($this->_dataHelper->getMethod() == 1) {
				require_once BP . '/app/code/IP2Location/CountryStateBlocker/lib/class.IP2Location.php';

				if (file_exists($this->_dataHelper->getDatabaseLocation())) {
					$geolocation = new \IP2Location\Database($this->_dataHelper->getDatabaseLocation(), \IP2Location\Database::FILE_IO);
					$records = $geolocation->lookup($ip, \IP2Location\Database::ALL);

					$this->_session->setCountryCode($records['countryCode']);
					$this->_session->setRegionName($records['regionName']);
				}
			}
			else{
				$ch = curl_init();
				curl_setopt_array($ch, array(
					CURLOPT_HEADER			=> 0,
					CURLOPT_URL				=> 'http://api.ip2location.com/v2/?' . http_build_query(array(
												'key'		=> $this->_dataHelper->getAPIKey(),
												'ip'		=> $ip,
												'format'	=> 'json',
												'package'	=> 'WS3',
											)),
					CURLOPT_RETURNTRANSFER	=> 1,
					CURLOPT_TIMEOUT			=> 10,
					CURLOPT_SSL_VERIFYPEER	=> 0,
				));

				$result = curl_exec($ch);
				curl_close($ch);

				if ($json = json_decode($result)) {
					$this->_session->setCountryCode($json->country_code);
					$this->_session->setRegionName($json->region_name);
				}
			}
		}

		if ($this->_session->getCountryCode()) {
			$triggered = false;

			$ruleModel = $this->_ruleFactory->create();
			$ruleCollection = $ruleModel->getCollection();
			$rules = $ruleCollection->getData();

			foreach ($rules as $rule) {
				if ($rule['status'] == 0) {
					continue;
				}

				if ($this->checkLocation($this->_session->getCountryCode(), $this->_session->getRegionName(), $rule['origins'])) {
					$rule['from'] = str_replace($this->_storeManager->getStore()->getBaseUrl(), '', $rule['from']);

					if ($rule['from'] == '/') {
						$rule['from'] = '';
					}

					$urlInterface = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\UrlInterface');
					$uri = str_replace($this->_storeManager->getStore()->getBaseUrl(), '', $urlInterface->getCurrentUrl());

					switch ($rule['mode']) {
						// Equals to
						case 1:
							if ($rule['from'] == $uri) {
								$triggered = true;
							}

							break;

						// Begins with
						case 2:
							if (substr($uri, 0, strlen($rule['from'])) === $rule['from']) {
								$triggered = true;
							}

							break;

						// Regular expression
						case 3:
							if (preg_match('/' . $rule['from'] . '/', $uri)) {
								$triggered = true;
							}
							break;
					}
				}

				if ($triggered) {
					break;
				}
			}

			if ($triggered) {
				if ($rule['code'] == 404) {
					$request->setModuleName('code')->setControllerName('index')->setActionName('noroute')->setDispatched(false);
					return $proceed($request);
				}

				else if ($rule['code'] == 301) {
					header('Location: ' . ((substr($rule['to'], 0, 4) == 'http') ? $rule['to'] : ($this->_storeManager->getStore()->getBaseUrl() . $rule['to'])), true, 301);
					die;
				}

				else if ($rule['code'] == 302) {
					header('Location: ' . ((substr($rule['to'], 0, 4) == 'http') ? $rule['to'] : ($this->_storeManager->getStore()->getBaseUrl() . $rule['to'])));
					die;
				}
			}
		}

		return $proceed($request);
	}

	private function checkLocation($countryCode, $regionName, $origins){
		$origins = explode(';', $origins);

		foreach ($origins as $origin) {
			if ($origin == '*') {
				return true;
			}

			if ($origin == $countryCode . '-*') {
				return true;
			}

			if ($origin == $countryCode . '-' . $regionName) {
				return true;
			}
		}

		return false;
	}
}
