<?php
require_once('../admin/common.php');
include '../admin/procrypt.php';
authentication_require_role('user');

$crypt = new proCrypt;
$decrypt_all=$crypt->decrypt($_SESSION['sessid'][forgetdata]);
$decrypt = substr($decrypt_all,0, $_SESSION['sessid'][lenpass]);

if ($_SESSION['sessid']['nuovo'] == 'nuovo') {
	is_not_new ($_SESSION['sessid'][username]); 
}
?>
<body>
<script language='javascript'>opener.location.reload(true);</script>
<form name="login" method="post" action="https://cloud.esseweb.eu/index.php">
<input type="hidden" name="user" value="<?php echo $_SESSION['sessid'][username]?>" />
<input type="hidden" name="password" value="<?php echo $decrypt ?>" />
</form>
<script language='javascript'>document.forms["login"].submit();</script>
<body/>
