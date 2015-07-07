<?php

require_once('common.php');
//authentication_require_role('user');
//$USERID_USERNAME = authentication_get_username();

include ("$incpath/templates/header.php");

if (!empty($_GET)) {
	include ("$incpath/templates/users_attiva.php");
} elseif (!empty($_POST)) {

} else { ?>
<meta http-equiv="refresh" content="0; url=http://www.esseweb.eu/" />	
<?php
}

include ("$incpath/templates/footer.php");


/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
