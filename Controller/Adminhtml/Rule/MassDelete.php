<?php
namespace IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

use IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

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
				/** @var $ruleModel \IP2Location\CountryStateBlocker\Model\Rule */
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
