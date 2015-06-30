<?php
require_once('../admin/common.php');
include '../admin/procrypt.php';
authentication_require_role('user');

$crypt = new proCrypt;
$decrypt_all=$crypt->decrypt($_SESSION['sessid'][forgetdata]);
$decrypt = substr($decrypt_all,0, $_SESSION['sessid'][lenpass]);
?>
<body>
<form method="post" id="loginform" name="login" action="http://av.esseweb.eu/xlogin.php">
<input type="hidden" name="super" value="">
<input type="hidden" name="charset" value="ISO-8859-1">
<input type="hidden" name="address" value="<?php echo $_SESSION['sessid'][username]?>" />
<input type="hidden" name="pwd" value="<?php echo $decrypt ?>" />
</form>
<script>document.forms["login"].submit();</script>
<body/>

