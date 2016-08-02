<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_2_3($object)
{
  if (Db::getInstance()->ExecuteS('SHOW COLUMNS FROM `'._DB_PREFIX_.'linksmenutop` LIKE \'new_popup\'') == false)
    Db::getInstance()->Execute('ALTER TABLE `'._DB_PREFIX_.'linksmenutop` ADD `new_popup` TINYINT( 1 ) NOT NULL DEFAULT 0 AFTER `new_window`');
  return true;
}
