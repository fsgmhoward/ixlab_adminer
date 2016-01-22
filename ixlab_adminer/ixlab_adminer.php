<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }
/*
Plugin Name: Adminer数据库编辑器
Version: 1.5.1
Description: Adminer数据库编辑器,由4.2.3版本修改而来
Author: FSGMHoward@IXLab
Author Email: howard@ixnet.work
Author URL: https://www.ixnet.ga/
Plugin URL: https://blog.ixnet.work/2016/01/22/adminer/
For: 不限
*/

function ixlab_adminer_navi() {
	echo '<li ';
	if(isset($_GET['plugin']) && $_GET['plugin'] == 'ixlab_adminer') { echo 'class="active"'; }
	echo '><a href="index.php?plugin=ixlab_adminer"><span class="glyphicon glyphicon-briefcase"></span> Adminer数据库编辑器</a></li>';
}

addAction('navi_3','ixlab_adminer_navi');
addAction('navi_9','ixlab_adminer_navi');