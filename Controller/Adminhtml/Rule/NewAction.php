<?php
namespace IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

use IP2Location\CountryStateBlocker\Controller\Adminhtml\Rule;

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
