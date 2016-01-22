<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }
if (ROLE != 'admin') { die('Insufficient Permissions'); }
include __DIR__.'/ixnetwork_version.func.php';
$ixnetwork_versionCheck = ixnetwork_version('ixlab_adminer.plugin.fsgmhoward.php', '1.5.1');
loadhead();
?>
<br />
<br />
<br />
<br />
<h5>点击此键即可进入Adminer数据库编辑器</h5>
<form action="" method="post">
<input name="submit" type="submit" class="btn btn-primary" value="进入Adminer数据库编辑器" />
</form>
<br />
<?php
if(!$ixnetwork_versionCheck['IsUpToDate']){
    echo "Adminer管理器插件有新版本：".$ixnetwork_versionCheck['RemoteVersion']."，当前版本为".$ixnetwork_versionCheck['CurrentVersion'];
    echo "请前往<a href='https://blog.ixnet.work/2016/01/22/adminer/' target='_blank'>https://blog.ixnet.work/2016/01/22/adminer/</a>查看新版下载地址";
}else{
    echo "版本检查完毕，你的插件是最新版本";
}
?>
<br />
<p>Copyright &copy; FSGM-Howard, 2015-2016. All rights reserved.</p>
<?php
loadfoot();
if (isset($_POST['submit'])){
    function randomkeys(){
	    $output='';
	    for($a=0;$a<20; $a++){
	    	$output.=chr(mt_rand(33, 126));    
	    }
     	return md5($output);
    }
    function inserttoken(){
        $token = randomkeys();
        global $m;
        $m->query("INSERT INTO `".DB_PREFIX."ixlab_adminer` (`id`, `token`, `expire_time`) VALUES (NULL, '{$token}', '".(time()+600)."');");
        return $token;
    }
    setcookie("adminer_token", inserttoken(), time()+600, "/");
    header("Location:./plugins/ixlab_adminer/?server=".DB_HOST."&username=".DB_USER."&db=".DB_NAME);
}
?>