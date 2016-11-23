<?php
namespace IP2Location\CountryStateBlocker\Block\Adminhtml\Rule\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use IP2Location\CountryStateBlocker\Model\System\Config\Status;
use IP2Location\CountryStateBlocker\Model\System\Config\Mode;
use IP2Location\CountryStateBlocker\Model\System\Config\Code;
use IP2Location\CountryStateBlocker\Model\System\Config\Location;

class Info extends Generic implements TabInterface
{
	/**
	 * @var \IP2Location\CountryStateBlocker\Model\Config\Status
	 */
	protected $_ruleStatus;

	/**
	 * @var \IP2Location\CountryStateBlocker\Model\Config\Mode
	 */
	protected $_ruleMode;

	/**
	 * @var \IP2Location\CountryStateBlocker\Model\Config\Code
	 */
	protected $_ruleCode;

	/**
	 * @var \IP2Location\CountryStateBlocker\Model\Config\Location
	 */
	protected $_ruleLocation;

   /**
	 * @param Context $context
	 * @param Registry $registry
	 * @param FormFactory $formFactory
	 * @param Status $ruleStatus
	 * @param array $data
	 */
	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		Status $ruleStatus,
		Mode $ruleMode,
		Code $ruleCode,
		Location $ruleLocation,
		array $data = []
	) {
		$this->_ruleStatus = $ruleStatus;
		$this->_ruleMode = $ruleMode;
		$this->_ruleCode = $ruleCode;
		$this->_ruleLocation = $ruleLocation;

		parent::__construct($context, $registry, $formFactory, $data);
	}

	/**
	 * Prepare form fields
	 *
	 * @return \Magento\Backend\Block\Widget\Form
	 */
	protected function _prepareForm()
	{
	   /** @var $model \IP2Location\CountryStateBlocker\Model\Rule */
		$model = $this->_coreRegistry->registry('ip2location_countrystateblocker_rule');

		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create();
		$form->setFieldNameSuffix('rule');

		$fieldset = $form->addFieldset(
			'base_fieldset',
			['legend' => __('General')]
		);

		if ($model->getId()) {
			$fieldset->addField(
				'rule_id',
				'hidden',
				['name' => 'rule_id']
			);
		}

		$fieldset->addField(
			'origins',
			'multiselect',
			[
				'name'			=> 'origins',
				'label'			=> __('Origins'),
				'values'		=> $this->_ruleLocation->toOptionArray(),
				'required'		=> true,
				'class'			=> 'chosen',
			]
		);

		$fieldset->addField(
			'mode',
			'select',
			[
				'name'      => 'mode',
				'label'     => __('Mode'),
				'options'   => $this->_ruleMode->toOptionArray()
			]
		);

		$fieldset->addField(
			'from',
			'text',
			[
				'name'		=> 'from',
				'label'		=> __('From'),
				'required'	=> true,
				'note'		=> 'Enter URI without <strong>' . rtrim($this->_storeManager->getStore()->getBaseUrl(), '/') . '</strong>',
			]
		);

		$fieldset->addField(
			'to',
			'text',
			[
				'name'		=> 'to',
				'label'		=> __('To'),
				'required'	=> true,
				'note'		=> 'Enter URI without <strong>' . rtrim($this->_storeManager->getStore()->getBaseUrl(), '/') . '</strong>',
			]
		);

		$fieldset->addField(
			'code',
			'select',
			[
				'name'		=> 'code',
				'label'		=> __('Code'),
				'options'	=> $this->_ruleCode->toOptionArray()
			]
		);

		$fieldset->addField(
			'status',
			'select',
			[
				'name'		=> 'status',
				'label'		=> __('Status'),
				'options'	=> $this->_ruleStatus->toOptionArray()
			]
		);

		$data = $model->getData();
		$form->setValues($data);
		$this->setForm($form);

		return parent::_prepareForm();
	}

	/**
	 * Prepare label for tab
	 *
	 * @return string
	 */
	public function getTabLabel()
	{
		return __('Rule Info');
	}

	/**
	 * Prepare title for tab
	 *
	 * @return string
	 */
	public function getTabTitle()
	{
		return __('Rule Info');
	}

	/**
	 * {@inheritdoc}
	 */
	public function canShowTab()
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isHidden()
	{
		return false;
	}
}
