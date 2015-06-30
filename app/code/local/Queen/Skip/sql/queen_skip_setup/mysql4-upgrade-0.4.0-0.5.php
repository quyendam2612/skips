<?php
/**
 *
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$tableName = $installer->getTable('queen_skip/skip');
$installer->run("
CREATE TABLE IF NOT EXISTS `queen_skip_skip` (
`id` int(6) NOT NULL,
`product_id` varchar(16) NOT NULL,
`order_id` int(16) NOT NULL,
`email` varchar(64) NOT NULL,
`status` int(1) NOT NULL,
`collect_date` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `queen_skip_skip` ADD PRIMARY KEY (`id`);
ALTER TABLE `queen_skip_skip` MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

");

$installer->endSetup();
