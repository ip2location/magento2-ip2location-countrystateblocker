<?php
namespace Hexasoft\IP2LocationCountryBlocker\Block\Adminhtml\Rule\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
	/**
	 * Class constructor
	 *
	 * @return void
	 */
	protected function _construct()
	{
		parent::_construct();
		$this->setId('rule_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Rule Information'));
	}

	/**
	 * @return $this
	 */
	protected function _beforeToHtml()
	{
		$this->addTab(
			'rule_info',
			[
				'label' => __('General'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock(
					'Hexasoft\IP2LocationCountryBlocker\Block\Adminhtml\Rule\Edit\Tab\Info'
				)->toHtml(),
				'active' => true
			]
		);

		return parent::_beforeToHtml();
	}
}
