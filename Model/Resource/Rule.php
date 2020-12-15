<?php
namespace Hexasoft\IP2LocationCountryBlocker\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Rule extends AbstractDb
{
	/**
	 * Define main table
	 */
	protected function _construct()
	{
		$this->_init('hexasoft_ip2locationcountryblocker_rule', 'rule_id');
	}
}
