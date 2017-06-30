<?php
namespace IP2Location\CountryStateBlocker\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use IP2Location\CountryStateBlocker\Model\RuleFactory;

class Rule extends Action
{
	/**
	 * Core registry
	 *
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry;

	/**
	 * Result page factory
	 *
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	protected $_resultPageFactory;

	/**
	 * Rule model factory
	 *
	 * @var \IP2Location\CountryStateBlocker\Model\RuleFactory
	 */
	protected $_ruleFactory;

	/**
	 * @param Context $context
	 * @param Registry $coreRegistry
	 * @param PageFactory $resultPageFactory
	 * @param RuleFactory $ruleFactory
	 */
	public function __construct(
		Context $context,
		Registry $coreRegistry,
		PageFactory $resultPageFactory,
		RuleFactory $ruleFactory
	) {
	   parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_ruleFactory = $ruleFactory;
	}

	public function execute(){

	}

	/**
	 * Rule access rights checking
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('IP2Location_CountryStateBlocker::manage_rule');
	}
}
