<?php
require_once('common.php');
authentication_require_role('admin');

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");

?>
<div id="main_menu">
<table>
   <tr>
      <td nowrap><a target="_top" href="list-virtual.php">Utenze di posta</a></td>
      <td>Gestione utenze domini di posta</td>
   </tr>
   <tr>
      <td nowrap><a target="_top" href="list-domain.php">Domini di posta</a></td>
      <td>Gestione dei domini di posta attivi sul sistema</td>
   </tr>

<?php if (authentication_get_usertype () == "global-admin") { ?>
   <tr>
      <td nowrap><a target="_top" href="list-admin.php">Amministratori di posta</a></td>
      <td>Gestione degli amministratori dei domini di posta presenti sul sistema</td>
   </tr>
<?php } ?>

</table>
</div>

<?php
include ("$incpath/templates/footer.php");
?>
