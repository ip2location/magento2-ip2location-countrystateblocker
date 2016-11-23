<?php
namespace IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

use IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

class Edit extends Rule
{
	/**
	 * @return void
	 */
	public function execute()
	{
		$ruleId = $this->getRequest()->getParam('id');

		/** @var \IP2Location\CountryStateBlocker\Model\Rule $model */
		$model = $this->_ruleFactory->create();

		if ($ruleId) {
			$model->load($ruleId);

			if (!$model->getId()) {
				$this->messageManager->addError(__('This rule no longer exists.'));
				$this->_redirect('*/*/');
				return;
			}
		}

		// Restore previously entered form data from session
		$data = $this->_session->getRuleData(true);

		if (!empty($data)) {
			$model->setData($data);
		}

		$fields = $model->getData();
		$newData = [];

		foreach ($fields as $key => $value) {
			$newData[$key] = $value;

			if (!is_array($value) && strpos($value, ';')) {
				$values = explode(';', $value);
				$newData[$key] = $values;
			}
		}

		$model->setData($newData);

		$this->_coreRegistry->register('ip2location_countrystateblocker_rule', $model);

		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('IP2Location_CountryStateBlocker::main_menu');
		$resultPage->getConfig()->getTitle()->prepend(__('IP2Location Country-State Blocker'));

		return $resultPage;
	}
}
