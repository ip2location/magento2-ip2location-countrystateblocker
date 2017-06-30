<?php
namespace IP2Location\CountryStateBlocker\Model;

use Magento\Framework\Model\AbstractModel;

class Rule extends AbstractModel
{
	/**
	 * Define resource model
	 */
	protected function _construct()
	{
		$this->_init('IP2Location\CountryStateBlocker\Model\Resource\Rule');
	}
}
