<?php
namespace IP2Location\CountryStateBlocker\Block\Adminhtml\Rule;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Edit extends Container
{
	/**
	  * Core registry
	  *
	  * @var \Magento\Framework\Registry
	  */
	protected $_coreRegistry = null;

	/**
	  * @param Context $context
	  * @param Registry $registry
	  * @param array $data
	  */
	public function __construct(
		Context $context,
		Registry $registry,
		array $data = []
	) {
		$this->_coreRegistry = $registry;
		parent::__construct($context, $data);
	}

	/**
	  * Class constructor
	  *
	  * @return void
	  */
	protected function _construct()
	{
		$this->_objectId = 'id';
		$this->_controller = 'adminhtml_rule';
		$this->_blockGroup = 'IP2Location_CountryStateBlocker';

		parent::_construct();

		$this->buttonList->update('save', 'label', __('Save'));
		$this->buttonList->update('delete', 'label', __('Delete'));
	}

	/**
	  * Prepare layout
	  *
	  * @return \Magento\Framework\View\Element\AbstractBlock
	  */
	protected function _prepareLayout()
	{
		$this->_formScripts[] = '
			requirejs([\'jquery\', \'chosen\'], function($, chosen){
				$(function(){
					$(\'.chosen\').chosen({width: \'100%\', placeholder_text_multiple: \'Origins\'}).on(\'change\', function(){
						if (Array.isArray($(this).val())) {
							var origins = $(this).val();

							for (var origin in origins) {
								if (origins[origin] == \'*\') {
									$(this).val([\'*\']);
									$(this).trigger(\'chosen:updated\');
									return;
								}
							}
						}
					});

					if($(\'#code\').val() == 404){
						$(\'#to\').val(\'\').prop(\'disabled\', true);
					}
					else{
						$(\'#to\').prop(\'disabled\', false);
					}

					$(\'#code\').on(\'change\', function(){
						if($(this).val() == 404){
							$(\'#to\').val(\'\').prop(\'disabled\', true);
						}
						else{
							$(\'#to\').prop(\'disabled\', false);
						}
					});
				});
			});
		';

		return parent::_prepareLayout();
	}
}
