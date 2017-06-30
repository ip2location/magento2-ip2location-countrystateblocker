<?php
namespace IP2Location\CountryStateBlocker\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

class Code implements ArrayInterface
{
	/**
	 * @return array
	 */
	public function toOptionArray()
	{
		return [
			301	=> __('Redirect Permanently (301)'),
			302	=> __('Redirect Temporarily (302)'),
			404	=> __('Page Not Found (404)'),
		];
	}
}
