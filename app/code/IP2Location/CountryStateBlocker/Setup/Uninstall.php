<?php
namespace IP2Location\CountryStateBlocker\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
	public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();

		$installer->getConnection()->dropTable($installer->getTable('ip2location_countrystateblocker_rule'));

		$installer->endSetup();
	}
}
