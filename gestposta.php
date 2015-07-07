<?php
require_once('common.php');
authentication_require_role('user');

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
?>
<div id="main_menu">
<table>
   <?php if ($CONF['vacation'] == 'YES') { ?>
   <tr>
      <td nowrap><a target="_top" href="vacation.php"><?php print $PALANG['pUsersMenu_vacation']; ?></a></td>
      <td>Autorisponditore per comunicare i periodi di assenza. Da inserire area di testo e date inizio/fine</td>
   </tr>
   <?php } ?>
   <tr>
      <td nowrap><a target="_top" href="edit-alias.php"><?php print $PALANG['pUsersMenu_edit_alias']; ?></a></td>
      <td><?php print $PALANG['pUsersMain_edit_alias']; ?></td>
   </tr>
   <tr>
      <td nowrap><a target="_top" href="password.php"><?php print $PALANG['pUsersMenu_password']; ?></a></td>
      <td><?php print $PALANG['pUsersMain_password']; ?></td>
   </tr>
   <tr>
      <td nowrap><a target="_mailguard" href="ext/maia.php">Spazio Web Mailguard</a></td>
      <td>Accesso al sistema di gestione Virus o Spam. Potrai inserire o confermare lo stato della mail, inserire in Black List indirizzi da cui non si intende più ricevere invii o in White List ciò che deve passare senza alcun filtro. Il sistema “impara” e quindi puoi ottimizzare la tua casella.</td>
   </tr>
</table>
</div>

<?php
include ("$incpath/templates/footer.php");
?>
