<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE `{$installer->getTable('vs7_autoposition/increment')}` (
  `increment_id` int(10) UNSIGNED NOT NULL,
  `manufacturer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `increment` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `vs7_autoposition_inc`
  ADD PRIMARY KEY (`increment_id`);
ALTER TABLE `vs7_autoposition_inc`
  MODIFY `increment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
");

$installer->endSetup();