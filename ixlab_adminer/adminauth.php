<?php
//Written by FSGM-Howard on Jan 3, 2016
//Copyright (c) FSGM-Howard, 2016. All rights reserved
//For more information about software license, please refer to ../LICENSE
//This file uses WMZZ's Library

if (!defined('DATA_ACCESS')) { die('Insufficient Permissions'); }
if (file_exists('../../config.php')){
    define('TIEBASIGNER_INSTALLED', TRUE);

    if (!isset($_COOKIE['adminer_token'])) { $auth = false; }

    if (extension_loaded('mysqli')) {
        include "../../lib/class.mysqli.php";
    }else{
        include "../../lib/class.mysql.php";
    }

    define('SYSTEM_ROOT','yes');
    require "../../config.php";

    $conn = new wmysql(DB_HOST,DB_USER,DB_PASSWD,DB_NAME);

    $system_url = $conn->once_fetch_array('SELECT * FROM `'.DB_PREFIX.'options` WHERE `name`="system_url";');
    define('SYSTEM_URL',$system_url['value']);

    if (isset($_GET['logout'])){
        if (isset($_COOKIE['adminer_token'])){
            $conn->query('DELETE FROM `'.DB_PREFIX.'ixlab_adminer` WHERE `token`="'.$_COOKIE['adminer_token'].'";');
            setcookie("adminer_token", '', time()-1, '/');
        }
        header("Location: ".(isset($_GET['return']) ? SYSTEM_URL : "./"));
    }

    $auth = false;
    $row = $conn->once_fetch_array("SELECT * FROM `".DB_PREFIX."ixlab_adminer` WHERE `token`='".$_COOKIE['adminer_token']."';");
    if ($row['expire_time']>=time()){
        $conn->query('UPDATE '.DB_PREFIX.'ixlab_adminer SET expire_time='.(time()+600).' WHERE token="'.$_COOKIE['adminer_token'].'"');
        setcookie('adminer_token', $_COOKIE['adminer_token'], time()+600, '/');
        $auth = true;
    }
}