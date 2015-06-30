<?php
require_once('../admin/common.php');
include '../admin/procrypt.php';
authentication_require_role('user');

/* $decrypt = openssl_decrypt($_SESSION['sessid'][forgetdata], "AES-256-CBC", "25c6c7ff35b9h79b151f2136cd13b0ff"); */
$crypt = new proCrypt;
$decrypt_all=$crypt->decrypt($_SESSION['sessid'][forgetdata]);
$decrypt = substr($decrypt_all,0, $_SESSION['sessid'][lenpass]);


// utente : $_SESSION['sessid'][username]
// pwd : $_SESSION['sessid'][forgetdata] -> $decrypt

?>
<body>
<form name="login_form" method="post" action="http://demoegw.esseweb.eu/login.php">

<input type="hidden" name="passwd_type" value="text" />
<input type="hidden" name="account_type" value="u" />

<input type="hidden" name="login" value="<?php echo $_SESSION['sessid'][username]?>" />
<input type="hidden" name="passwd" value="<?php echo $decrypt ?>" />

</form>
<script>document.forms["login_form"].submit();</script>
<body/>
