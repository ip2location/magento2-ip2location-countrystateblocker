<?php
namespace Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

use Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

class Edit extends Rule
{
	/**
	 * @return void
	 */
	public function execute()
	{
		$ruleId = $this->getRequest()->getParam('id');

		/** @var \Hexasoft\IP2LocationCountryBlocker\Model\Rule $model */
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

		$this->_coreRegistry->register('hexasoft_ip2locationcountryblocker_rule', $model);

		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Hexasoft_IP2LocationCountryBlocker::main_menu');
		$resultPage->getConfig()->getTitle()->prepend(__('IP2Location Country Blocker'));

		return $resultPage;
	}
}
