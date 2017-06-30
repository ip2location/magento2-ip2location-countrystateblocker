<?php
namespace IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

use IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

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
		$resultPage->setActiveMenu('IP2Location_CountryStateBlocker::main_menu');
		$resultPage->getConfig()->getTitle()->prepend(__('IP2Location Country-State Blocker'));

		return $resultPage;
   }
}
