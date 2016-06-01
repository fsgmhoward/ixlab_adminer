<?php
// 这个文件由Howard Liu编写。
// 根据Apache License 2.0进行授权。

if (file_exists('../../config.php')){
    define('SYSTEM_ROOT','yes');
    require "../../config.php";
    define('TIEBASIGNER_INSTALLED', TRUE);
    session_start();
    if (!isset($_SESSION['ixnet_adminer_auth']) && $_GET['server']==DB_HOST) {
        exit('Insufficient Permission');
    }
}