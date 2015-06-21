<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/18/15
 * Time: 8:19 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
	->newTable($installer->getTable('queen_skip/permit'))
	->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
	   'identity'  => true,
	   'unsigned'  => true,
	   'nullable'  => false,
	   'primary'   => true,
	), 'ID')
	->addColumn('authority', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
	   'nullable'  => false,
	), 'Authority')
	->addColumn('name', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
	   'nullable'  => false,
	), 'Name')
	->addColumn('duration', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
	   'nullable'  => false,
	), 'Duration')
	->addColumn('price', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
	   'nullable'  => false,
	), 'Price');
$installer->getConnection()->createTable($table);

$installer->endSetup();