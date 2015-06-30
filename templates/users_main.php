<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div id="main_menu">
<table>
<?php if (authentication_get_usertype () == "admin" || authentication_get_usertype () == "global-admin") { ?>
   <tr>
      <td nowrap><a target="_top" href="admin.php">Admin</a></td>
      <td>Attività ad uso dell'Amministratore del Sistema.</td>
   </tr>
<? } ?>

   <tr>
      <td nowrap><a target="_top" href="gestposta.php">Gestione casella di posta</a></td>
      <td>Modifiche all'utenza di posta e sistema di protezione da Virus e Spam</td>
   </tr>
   <tr>
      <td nowrap><a target="_webmail" href="ext/webmail.php">WebMail</a></td>
      <td>Nuova versione della webmail da cui si potranno allineare i contatti con rubrica e agenda sul Cloud<br>( <a href="https://cloud.esseweb.eu/public.php?service=files&t=0fb2e9c461cff8377a269a7ab9065584&download&path=//Webmail.pdf">Documentazione</a>&nbsp;&nbsp;).</td>
   </tr>
   <tr>
      <td nowrap><a target="_top" href="esterni.php">Servizi</a></td>
      <td>Accesso a Grandi Allegati e Cloud</td>
   </tr>
   <tr>
      <td nowrap><a target="_top" href="documentazione.php">Manualistica</a></td>
      <td>Semplici guide per la configurazione ed utilizzo dei servizi</td>
   </tr>

   <tr>
      <td nowrap><a target="_top" href="logout.php"><?php print $PALANG['pMenu_logout']; ?></a></td>
      <td><?php print $PALANG['pMain_logout']; ?></td>
   </tr>
</table>
</div>
