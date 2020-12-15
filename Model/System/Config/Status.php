<?php
namespace Hexasoft\IP2LocationCountryBlocker\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
	/**
	 * @return array
	 */
	public function toOptionArray()
	{
		return [
			1	=> __('Enabled'),
			0	=> __('Disabled'),
		];
	}
}
