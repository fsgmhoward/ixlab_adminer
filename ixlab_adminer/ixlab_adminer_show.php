<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }
if (ROLE != "admin") { die('Insufficient Permissions'); }
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