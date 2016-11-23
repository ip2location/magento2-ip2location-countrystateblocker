<?php
namespace IP2Location\CountryStateBlocker\Model\Resource\Rule;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	/**
	 * Define model & resource model
	 */
	protected function _construct()
	{
		$this->_init(
			'IP2Location\CountryStateBlocker\Model\Rule',
			'IP2Location\CountryStateBlocker\Model\Resource\Rule'
		);
	}
}
