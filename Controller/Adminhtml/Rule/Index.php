<?php
namespace Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

use Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

class Index extends Rule
{
	/**
	 * @return void
	 */
	public function execute()
	{
		if ($this->getRequest()->getQuery('ajax')) {
			$this->_forward('grid');
			return;
		}

		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Hexasoft_IP2LocationCountryBlocker::main_menu');
		$resultPage->getConfig()->getTitle()->prepend(__('IP2Location Country Blocker'));

		return $resultPage;
   }
}
