<?php
namespace IP2Location\CountryStateBlocker\Block\Adminhtml;
use Magento\Backend\Block\Widget\Grid\Container;

class Rule extends Container
{
	/**
	  * Constructor
	  *
	  * @return void
	  */
	protected function _construct()
	{
		$this->_controller = 'adminhtml_rule';
		$this->_blockGroup = 'IP2Location_CountryStateBlocker';
		$this->_headerText = __('Manage Rule');
		$this->_addButtonLabel = __('Add Rule');
		parent::_construct();
	}
}
