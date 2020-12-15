<?php
namespace Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

use Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

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
