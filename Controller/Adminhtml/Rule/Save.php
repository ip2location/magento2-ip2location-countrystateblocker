<?php
namespace Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

use Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

class Save extends Rule
{
   /**
	 * @return void
	 */
   public function execute()
   {
	  $isPost = $this->getRequest()->getPost();

	  if ($isPost) {
		$ruleModel = $this->_ruleFactory->create();
		$ruleId = $this->getRequest()->getParam('id');

		if ($ruleId) {
			$ruleModel->load($ruleId);
		}

		$formData = $this->getRequest()->getParam('rule');

		foreach ($formData as $key => $value) {
			if (is_array($value)) {
				$formData[$key] = implode(';', $value);
			}
		}

		if ($formData['code'] == 404) {
			$formData['to'] = '';
		}

		$ruleModel->setData($formData);

		try {
			if ($formData['mode'] == 3) {
				if (@preg_match('/' . $formData['from'] . '/', sha1(microtime())) === FALSE) {
					$this->messageManager->addError('Invalid regular expression.');
					$this->_redirect('*/*/edit', ['id' => $ruleModel->getId(), '_current' => true]);
					return;
				}
			}

			// Save rule
			$ruleModel->save();

			// Display success message
			$this->messageManager->addSuccess(__('The rule has been saved.'));

			// Check if 'Save and Continue'
			if ($this->getRequest()->getParam('back')) {
				$this->_redirect('*/*/edit', ['id' => $ruleModel->getId(), '_current' => true]);
				return;
			}

			// Go to grid page
			$this->_redirect('*/*/');
			return;
		} catch (\Exception $e) {
			$this->messageManager->addError($e->getMessage());
		}

		$this->_getSession()->setFormData($formData);
		$this->_redirect('*/*/edit', ['id' => $ruleId]);
	  }
   }
}