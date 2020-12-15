<?php
namespace Hexasoft\IP2LocationCountryBlocker\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = $installer->getTable('hexasoft_ip2locationcountryblocker_rule');

        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'rule_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity'	=> true,
                        'unsigned'	=> true,
                        'nullable'	=> false,
                        'primary'	=> true
                    ],
                    'Rule ID'
                )
                ->addColumn(
                    'origins',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Origins'
                )
                ->addColumn(
                    'mode',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Mode'
                )
                ->addColumn(
                    'from',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'From'
                )
                 ->addColumn(
                    'to',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'To'
                )
				->addColumn(
                    'code',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Code'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
				->addIndex(
					$installer->getIdxName('hexasoft_ip2locationcountryblocker_rule',
					['status']),
					['status']
				)
                ->setComment('Rule Table')
                ->setOption('charset', 'utf8');

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}