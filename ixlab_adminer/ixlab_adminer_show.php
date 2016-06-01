<?php
if (!defined('SYSTEM_ROOT') || ROLE != 'admin') { die('Insufficient Permissions'); }

if (isset($_GET['go'])){
    // 检查SESSION，如果没激活则激活SESSION
    if (version_compare(phpversion(), '5.4.0', '<')) {
        // 快升级你的PHP！
        if(session_id() == '') {
            session_start();
        }
    } elseif (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // 保存一个已经认证的SESSION，加入这个isset则通过认证
    $_SESSION['ixnet_adminer_auth'] = true;
    header("Location:./plugins/ixlab_adminer/?server=".DB_HOST."&username=".DB_USER."&db=".DB_NAME);
    exit;
}

require_once 'ixnet_helpers.php';
$returnValue = require 'ixlab_adminer_desc.php';
$version = ixnet_helpers_version('ixlab_adminer.plugin.fsgmhoward.php', $returnValue['plugin']['version']);
loadhead();
?>

<div class="panel panel-info">
    <div class="panel-heading">Adminer数据库管理器</div>
    <div class="panel-body">
        <p class="text-primary">点击此键即可进入Adminer数据库编辑器</p>
        <a class="btn btn-default" href="?plugin=ixlab_adminer&go=yes" target="_blank">进入Adminer数据库编辑器</a>
        <hr size="2px">
        <?php
        if(!$version['isUpToDate']) {
            echo '<p>Adminer管理器插件有新版本：<span class="text-info">'.$version['remoteVersion'].'</span>，当前版本为：<span class="text-info">'.$version['currentVersion'].'</span></p>';
            if (isset($version['raw']['data']['updates'][$version['remoteVersion']])) {
                echo '<p class="text-info">'.$version['remoteVersion'].'版本更新内容：'.$version['raw']['data']['updates'][$version['remoteVersion']].'。</p>';
            }
            echo '<p>请前往<a href="https://blog.ixnet.work/2016/01/22/adminer/" target="_blank">https://blog.ixnet.work/2016/01/22/adminer/</a>下载最新版本。</p>';
        } else {
            echo '<p>版本检查完毕，你的插件是最新版本</p>';
        }
        echo '<p>当前版本分支为'.$version['branch'].'。</p>';
        ?>
        <hr size="2px">
        <p class="text-muted">Copyright &copy; <a href="https://www.ixnet.work">IX Network</a>, 2015-2016.</p>
    </div>
</div>
<?php
loadfoot();
