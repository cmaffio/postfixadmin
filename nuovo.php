<?php

require_once('common.php');
authentication_require_role('user');
$USERID_USERNAME = authentication_get_username();

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_nuovo.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
