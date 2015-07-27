<?php
require_once('common.php');
authentication_require_role(array ('mm', 'mr', 'global-admin'));

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
<?php if (authentication_has_role ('mm')) { ?>
   <tr>
      <td nowrap><a target="_top" href="">Istruzioni Mass Mailing</a></td>
      <td>Infomrazioni sull'utilizzo del servizio di Mass Mailing</td>
   </tr>
   <tr>
      <td nowrap><a target="_top" href="user-mm.php">Gestione invii</a></td>
      <td>Accesso alla gestione ed allo stato degli invii</td>
   </tr>
   <tr>
      <td nowrap><a target="_top" href="">Gestione liste</a></td>
      <td>Gestione delle liste di indirizzi di invio</td>
   </tr>


<?php } ?>
</table>
</div>

<?php
include ("$incpath/templates/footer.php");
?>
