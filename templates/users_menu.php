<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div id="menu">
<ul>
   <li><a target="_top" href="<?php print $CONF['user_footer_link']; ?>"><?php print $PALANG['pMenu_main']; ?></a></li>
   <?php if ($CONF['vacation'] == "AAAA") { ?>
   <li><a target="_top" href="vacation.php"><?php print $PALANG['pUsersMenu_vacation']; ?></a></li>
   <?php } ?>
   <li><a target="_top" href="gestposta.php">Gestione casella di posta</a></li>
   <li><a target="_top" href="webmail.php">WebMail</a></li>
   <li><a target="_top" href="esterni.php">Servizi</a></li>
   <li><a target="_top" href="documentazione.php">Manualistica</a></li>
<?php if (authentication_get_usertype () == "admin" || authentication_get_usertype () == "global-admin") { ?>
   <li><a target="_top" href="admin.php">Admin</a></li>
<?php } ?>
<?php if (authentication_has_role ('mr')) { ?>
   <li><a target="_top" href="mr.php">Invio Massivo</a></li>
<?php } ?>
   <li><a target="_top" href="logout.php"><?php print $PALANG['pMenu_logout']; ?></a></li>
</ul>
</div>

<br clear='all' /><br>

<?php 
if (file_exists (realpath ("../motd-users.txt"))) 
{
   print "<div id=\"motd\">\n";
   include ("../motd-users.txt");
   print "</div>";
}
?>
