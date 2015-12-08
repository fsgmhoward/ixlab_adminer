<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }

function callback_init() {
	global $m;
	$m->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."ixlab_adminer` (
`id`  int(255) NOT NULL AUTO_INCREMENT,
`token`  char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`expire_time`  int(255)  NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1;");
}

function callback_remove() {
	global $m;
	$m->query("DROP TABLE IF EXISTS `".DB_PREFIX."ixlab_adminer`");
	option::del('plugin_ixlab_adminer');
}
?>