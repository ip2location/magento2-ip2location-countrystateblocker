<?php
namespace Hexasoft\IP2LocationCountryBlocker\Model;

use Magento\Framework\Model\AbstractModel;

class Rule extends AbstractModel
{
	/**
	 * Define resource model
	 */
	protected function _construct()
	{
		$this->_init('Hexasoft\IP2LocationCountryBlocker\Model\Resource\Rule');
	}
}
