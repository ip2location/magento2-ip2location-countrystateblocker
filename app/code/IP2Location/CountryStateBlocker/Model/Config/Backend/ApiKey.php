<?php

namespace IP2Location\CountryStateBlocker\Model\Config\Backend;

class ApiKey extends \Magento\Framework\App\Config\Value
{
    public function beforeSave()
    {
		if ($this->getFieldsetDataValue('method') == 2) {
			$ch = curl_init();
			curl_setopt_array($ch, array(
				CURLOPT_HEADER			=> 0,
				CURLOPT_URL				=> 'http://api.ip2location.com/v2/?check=1&key=' . $this->getValue(),
				CURLOPT_RETURNTRANSFER	=> 1,
				CURLOPT_TIMEOUT			=> 10,
				CURLOPT_SSL_VERIFYPEER	=> 0,
			));

			$result = curl_exec($ch);
			curl_close($ch);

			$json = json_decode($result);

			if (!preg_match('/^\d+$/', $json->response)) {
				throw new \Magento\Framework\Exception\ValidatorException(__('The API key is invalid.'));
			}
			elseif ($result == 0) {
				throw new \Magento\Framework\Exception\ValidatorException(__('Your IP2Location web service credit is running out.'));
			}
		}

        parent::beforeSave();
    }
}