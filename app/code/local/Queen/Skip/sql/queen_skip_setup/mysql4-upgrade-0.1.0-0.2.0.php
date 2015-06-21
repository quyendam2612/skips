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
   ->newTable($installer->getTable('queen_skip/postcode'))
   ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
       'identity'  => true,
       'unsigned'  => true,
       'nullable'  => false,
       'primary'   => true,
   ), 'ID')
   ->addColumn('town', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
       'nullable'  => false,
   ), 'Town')
   ->addColumn('district_from', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
       'nullable'  => false,
   ), 'District From')
   ->addColumn('district_to', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
       'nullable'  => false,
   ), 'District To')
   ->addColumn('postcode', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
       'nullable'  => false,
   ), 'Area/incode')
   ->addColumn('permit', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
       'nullable'  => false,
   ), 'Permit')
   ->addColumn('drive', Varien_Db_Ddl_Table::TYPE_BOOLEAN, 0, array(
       'nullable'  => false,
   ), 'Drive Only');
$installer->getConnection()->createTable($table);

$installer->endSetup();