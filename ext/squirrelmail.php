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
<form action="https://webmail.bmm.it/old/src/redirect.php" method="post" name="login_form"  >
<input type="hidden" name="login_username" value="<?php echo $_SESSION['sessid'][username]?>" />
<input type="hidden" name="secretkey" value="<?php echo $decrypt ?>" />
<input type="hidden" name="js_autodetect_results" value="0" />
<input type="hidden" name="just_logged_in" value="1" />
</form>
<script>document.forms["login_form"].submit();</script>
<body/>

