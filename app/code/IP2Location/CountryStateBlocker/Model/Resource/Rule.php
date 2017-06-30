<?php
namespace IP2Location\CountryStateBlocker\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Rule extends AbstractDb
{
	/**
	 * Define main table
	 */
	protected function _construct()
	{
		$this->_init('ip2location_countrystateblocker_rule', 'rule_id');
	}
}
