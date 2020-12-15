<?php
namespace Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

use Hexasoft\IP2LocationCountryBlocker\Controller\Adminhtml\Rule;

class NewAction extends Rule
{
   /**
	 * Create new rule action
	 *
	 * @return void
	 */
   public function execute()
   {
	  $this->_forward('edit');
   }
}
