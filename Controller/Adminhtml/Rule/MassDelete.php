<?php
namespace Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

use Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

class MassDelete extends Rule
{
	/**
	* @return void
	*/
	public function execute()
	{
		// Get IDs of the selected rule
		$ruleIds = $this->getRequest()->getParam('rule');

		foreach ($ruleIds as $ruleId) {
			try {
				/** @var $ruleModel \Hexasoft\IP2LocationCountryBlocker\Model\Rule */
				$ruleModel = $this->_ruleFactory->create();
				$ruleModel->load($ruleId)->delete();
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
		}

		if (count($ruleIds)) {
			$this->messageManager->addSuccess(
				__('A total of %1 record(s) were deleted.', count($ruleIds))
			);
		}

		$this->_redirect('*/*/index');
	}
}
