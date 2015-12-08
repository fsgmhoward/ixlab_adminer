<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }
/*
Plugin Name: Adminer数据库编辑器
Version: 1.4
Description: Adminer数据库编辑器,由4.2.3版本修改而来
Author: FSGMHoward@IXLab
Author Email: ixlab@qq.com
Author URL: https://www.ixlab.ga/
Plugin URL: http://www.stus8.com/forum.php?mod=viewthread&tid=4918
For: 不限
*/

function ixlab_adminer_navi() {
	echo '<li ';
	if(isset($_GET['plugin']) && $_GET['plugin'] == 'ixlab_adminer') { echo 'class="active"'; }
	echo '><a href="index.php?plugin=ixlab_adminer"><span class="glyphicon glyphicon-briefcase"></span> Adminer数据库编辑器</a></li>';
}

addAction('navi_3','ixlab_adminer_navi');
addAction('navi_9','ixlab_adminer_navi');