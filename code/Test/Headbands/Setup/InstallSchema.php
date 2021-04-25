<?php

namespace Test\Headbands\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 *
 * @package Test\Headbands\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install Blog Posts table
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable('test_headbands_post');

        if ($setup->getConnection()->isTableExists($tableName) != true) {
            $table = $setup->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    255,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Content'
                )
                ->addColumn(
                    'image',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => true, 'default' => null],
                    'Image'
                )
                ->addColumn(
                    'link',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => null],
                    'Link'
                )
                ->addColumn(
                    'categories',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => null],
                    'Categories'
                )
                ->addColumn(
                    'from_date',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Date start'
                )
                ->addColumn(
                    'to_date',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Date expire'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->setComment('Test Headbands - Posts');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}