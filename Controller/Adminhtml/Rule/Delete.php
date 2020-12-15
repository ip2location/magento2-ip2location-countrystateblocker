<?php
namespace Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

use Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

class Delete extends Rule
{
   /**
	* @return void
	*/
   public function execute()
   {
	  $ruleId = (int) $this->getRequest()->getParam('id');

	  if ($ruleId) {
		 /** @var $ruleModel \Hexasoft\IP2LocationCountryBlocker\Model\Rule */
		 $ruleModel = $this->_ruleFactory->create();
		 $ruleModel->load($ruleId);

		 // Check this rule exists or not
		 if (!$ruleModel->getId()) {
			$this->messageManager->addError(__('This rule no longer exists.'));
		 } else {
			   try {
				  // Delete rule
				  $ruleModel->delete();
				  $this->messageManager->addSuccess(__('The rule has been deleted.'));

				  // Redirect to grid page
				  $this->_redirect('*/*/');
				  return;
			   } catch (\Exception $e) {
				   $this->messageManager->addError($e->getMessage());
				   $this->_redirect('*/*/edit', ['id' => $ruleModel->getId()]);
			   }
			}
	  }
   }
}
