<?php
namespace IP2Location\CountryStateBlocker\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

class Mode implements ArrayInterface
{
	/**
	 * @return array
	 */
	public function toOptionArray()
	{
		return [
			1	=> __('Equals To'),
			2	=> __('Begins With'),
			3	=> __('Regular Expression'),
		];
	}
}
