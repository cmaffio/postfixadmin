<?php

require_once('admin/common.php');
authentication_require_role('user');
$USERID_USERNAME = authentication_get_username();

include ("templates/header.php");
include ("templates/users_nuovo.php");
include ("templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
