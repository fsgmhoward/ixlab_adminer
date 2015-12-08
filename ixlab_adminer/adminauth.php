<?php
if (!defined('DATA_ACCESS')) { die('Insufficient Permissions'); }
if (!isset($_COOKIE['adminer_token'])) { $auth = false; }

define('SYSTEM_ROOT','yes');
require "../../config.php";

$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWD);
mysql_select_db(DB_NAME,$conn);

$system_url = mysql_query('SELECT * FROM '.DB_PREFIX.'options WHERE name="system_url"');
$system_url = mysql_fetch_array($system_url);
define('SYSTEM_URL',$system_url['value']);

if (isset($_GET['logout_and_return'])){
    if (isset($_COOKIE['adminer_token'])){
        mysql_query('DELETE FROM '.DB_PREFIX.'ixlab_adminer WHERE token="'.$_COOKIE['adminer_token'].'"');
        setcookie("adminer_token", $_COOKIE['adminer_token'], time()-1);
    }
    header("Location: ".SYSTEM_URL);
}

if (isset($_GET['logout'])){
    if (isset($_COOKIE['adminer_token'])){
        mysql_query('DELETE FROM '.DB_PREFIX.'ixlab_adminer WHERE token="'.$_COOKIE['adminer_token'].'"');
        setcookie("adminer_token", $_COOKIE['adminer_token'], time()-1);
    }
    header("Location: ./");
}

$result = mysql_query("SELECT * FROM ".DB_PREFIX."ixlab_adminer WHERE token='".$_COOKIE['adminer_token']."'");
$auth = false;
while ($row = mysql_fetch_array($result)){
    if ($row['expire_time']>=time()){
        mysql_query('UPDATE '.DB_PREFIX.'ixlab_adminer SET expire_time='.(time()+600).' WHERE token="'.$_COOKIE['adminer_token'].'"');
        setcookie("adminer_token", $_COOKIE['adminer_token'], time()+600, "/");
        $auth = true;
    }
}
?>