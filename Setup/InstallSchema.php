<?php

namespace Quarcade\ExternalOrder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Quarcade\ExternalOrder\Setup
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /* Add External Order Id field to all required tables */
        $installer->getConnection()->addColumn(
            $installer->getTable('quote'),
            'external_order_id',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 40,
                'nullable' => true,
                'comment' => 'External Order Id',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order'),
            'external_order_id',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 40,
                'nullable' => true,
                'comment' => 'External Order Id',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_grid'),
            'external_order_id',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 40,
                'nullable' => true,
                'comment' => 'External Order Id',
            ]
        );

        $installer->endSetup();
    }
}