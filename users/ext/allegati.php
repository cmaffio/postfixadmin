<?php
require_once('../../common.php');
include '../procrypt.php';
authentication_require_role('user');

/* $decrypt = openssl_decrypt($_SESSION['sessid'][forgetdata], "AES-256-CBC", "25c6c7ff35b9h79b151f2136cd13b0ff"); */
$crypt = new proCrypt;
$decrypt_all=$crypt->decrypt($_SESSION['sessid'][forgetdata]);
$decrypt = substr($decrypt_all,0, $_SESSION['sessid'][lenpass]);

// utente : $_SESSION['sessid'][username]
// pwd : $_SESSION['sessid'][forgetdata] -> $decrypt

?>
<body>
<form method="post" id="loginform" name="login" action="https://allegati.esseweb.eu/index.php">
<input type="hidden" name="fUsername" value="<?php echo $_SESSION['sessid'][username]?>" />
<input type="hidden" name="fPassword" value="<?php echo $decrypt ?>" />
</form>
<script>document.forms["login"].submit();</script>
<body/>
