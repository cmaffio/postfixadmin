<?php

require_once('admin/common.php');
//authentication_require_role('user');
//$USERID_USERNAME = authentication_get_username();

include ("templates/header.php");

if (!empty($_GET)) {
	include ("templates/users_attiva.php");
} elseif (!empty($_POST)) {

} else { ?>
<meta http-equiv="refresh" content="0; url=http://www.esseweb.eu/" />	
<?php
}

include ("templates/footer.php");


/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
