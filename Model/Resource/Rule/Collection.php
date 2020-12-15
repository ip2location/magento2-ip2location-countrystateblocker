<?php
namespace Hexasoft\IP2LocationCountryBlocker\Model\Resource\Rule;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	/**
	 * Define model & resource model
	 */
	protected function _construct()
	{
		$this->_init(
			'Hexasoft\IP2LocationCountryBlocker\Model\Rule',
			'Hexasoft\IP2LocationCountryBlocker\Model\Resource\Rule'
		);
	}
}
