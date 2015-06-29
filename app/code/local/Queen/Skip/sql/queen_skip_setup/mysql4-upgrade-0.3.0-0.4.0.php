<?php
/**
 *
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$tableName = $installer->getTable('queen_skip/postcode');
$installer->run("
ALTER TABLE `$tableName` ADD `permit_require` INT(1) NOT NULL DEFAULT '0' AFTER `permit`;
");

$installer->endSetup();