<?php
namespace Hexasoft\IP2LocationCountryBlocker\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
	const XML_PATH_ENABLED		= 'hexasoft_ip2locationcountryblocker/settings/enabled';
	const XML_PATH_METHOD		= 'hexasoft_ip2locationcountryblocker/settings/method';
	const XML_PATH_DATABASE		= 'hexasoft_ip2locationcountryblocker/settings/databaseLocation';
	const XML_PATH_API_KEY		= 'hexasoft_ip2locationcountryblocker/settings/apiKey';


	/**
	  * @var \Magento\Framework\App\Config\ScopeConfigInterface
	  */
	 protected $_scopeConfig;

	/**
	  * @param Context $context
	  * @param ScopeConfigInterface $scopeConfig
	  */
	 public function __construct(
		 Context $context,
		 ScopeConfigInterface $scopeConfig
	 ) {
		 parent::__construct($context);
		 $this->_scopeConfig = $scopeConfig;
	 }

	/**
	  * Check for module is enabled
	  *
	  * @return bool
	  */
	public function isEnabled($store = null)
	{
		return $this->_scopeConfig->getValue(
			self::XML_PATH_ENABLED,
			ScopeInterface::SCOPE_STORE
		);
	}

	/**
	  * Get the lookup method
	  *
	  * @return int
	  */
	public function getMethod()
	{
		return $this->_scopeConfig->getValue(
			self::XML_PATH_METHOD,
			ScopeInterface::SCOPE_STORE
		);
	}

	/**
	  * Get the IP2Location database location
	  *
	  * @return string
	  */
	public function getDatabaseLocation()
	{
		return $this->_scopeConfig->getValue(
			self::XML_PATH_DATABASE,
			ScopeInterface::SCOPE_STORE
		);
	}

	/**
	  * Get API Key
	  *
	  * @return string
	  */
	public function getAPIKey()
	{
		return $this->_scopeConfig->getValue(
			self::XML_PATH_API_KEY,
			ScopeInterface::SCOPE_STORE
		);
	}
}
