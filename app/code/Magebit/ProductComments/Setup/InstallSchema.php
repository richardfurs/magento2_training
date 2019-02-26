<?php


namespace Magebit\ProductComments\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'comments_table'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('comments_table'))
            ->addColumn(
                'comment_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Comment ID'
            )
            ->addColumn(
                'comment_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50,
                ['nullable' => false, 'default' => ''],
                'Comment Name'
            )->addColumn(
                'comment_email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50,
                ['nullable' => false, 'default' => ''],
                'Comment Email'
            )->addColumn(
                'comment_text',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'Comment Text'
            );
        $setup->getConnection()->createTable($table);
    }
}