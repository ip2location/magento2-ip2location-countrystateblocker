<?php

namespace IP2Location\CountryStateBlocker\Model\Config\Backend;

class Rule extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
	/**
	 * @var \Magento\Framework\Data\Form\Element\Factory
	 */
	protected $_elementFactory;

	/**
	 * @param \Magento\Backend\Block\Template\Context $context
	 * @param \Magento\Framework\Data\Form\Element\Factory $elementFactory
	 * @param array $data
	 */
	public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Data\Form\Element\Factory $elementFactory, array $data = [])
	{
		$this->_elementFactory  = $elementFactory;
		parent::__construct($context, $data);
	}

	protected function _construct(){
		$this->addColumn('origins', ['label' => __('Origins')]);
		$this->addColumn('mode', ['label' => __('Mode')]);
		$this->addColumn('from', ['label' => __('From')]);
		$this->addColumn('to', ['label' => __('To')]);
		$this->addColumn('code', ['label' => __('Code')]);
		$this->addColumn('status', ['label' => __('Status')]);
		$this->_addAfter = false;
		$this->_addButtonLabel = __('Add');
		parent::_construct();
	}
}