<?php
require_once('../common.php');
include '$incpath/admin/procrypt.php';
authentication_require_role('user');

$crypt = new proCrypt;
$decrypt_all=$crypt->decrypt($_SESSION['sessid'][forgetdata]);
$decrypt = substr($decrypt_all,0, $_SESSION['sessid'][lenpass]);

?>
<body>
<form name="roundcubelogin" action="https://utenti.esseweb.eu/rc/" method="post">
<input type="hidden" name="_autologin" value="1" />
<input type="hidden" name="_task" value="login">
<input type="hidden" name="_action" value="login">
<input type="hidden" name="_timezone" id="rcmlogintz" value="_default_">
<input type="hidden" name="_url" id="rcmloginurl" value="">
<input type="hidden" name="_user" value="<?php echo $_SESSION['sessid'][username]?>" />
<input type="hidden" name="_pass" value="<?php echo $decrypt ?>" />
</form>
<script>document.forms["roundcubelogin"].submit();</script>
<body/>
