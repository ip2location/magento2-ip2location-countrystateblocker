<?php
namespace IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

use IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

class Grid extends Rule
{
	/**
	 * @return void
	 */
	public function execute()
	{
	  return $this->_resultPageFactory->create();
	}
}
