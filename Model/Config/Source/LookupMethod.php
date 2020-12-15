<?php

namespace Hexasoft\IP2LocationCountryBlocker\Model\Config\Source;

class LookupMethod extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
	/**
	 * Get all options
	 *
	 * @return array
	 */
	public function getAllOptions()
	{
		return [
			[
				'value'	=> 1,
				'label'	=> 'Local Binary Database',
			],
			[
				'value'	=> 2,
				'label'	=> 'Remote API Service',
			],
		];
	}
}