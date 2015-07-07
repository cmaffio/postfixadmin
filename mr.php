<?php
require_once('common.php');
authentication_require_role('admin');

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");

if (authentication_get_usertype () == "global-admin") {
	$dest = "stato-mr.php";
} else {
	$dest = "user-mr.php?account=".authentication_get_username();
}
?>
<div id="main_menu">
<table>
   <tr>
      <td nowrap><a target="_top" href="<?php print $dest ?>">Stato servizo</a></td>
      <td>Riporta le informazioni inerenti allo stato del servizio</td>
   </tr>
</table>
</div>

<?php
include ("$incpath/templates/footer.php");
?>
