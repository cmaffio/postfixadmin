<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<?php 

print "<form name=\"\" method=\"post\">\n";
print "<table id=\"admin_table\">\n";

if ($num > 0) {
	print "   <tr class=\"header\">\n";
	print "      <td colspan=\"7\">Liste Mail</td>\n";
	print "   </tr>\n";
	print "   <tr class=\"header\">\n";
	print "      <td width=\"5%\">&nbsp;</td>\n";
	print "      <td width=\"25%\" align=left>Indirizzo e-mail</td>\n";
	print "      <td width=\"20%\" align=left>Nome</td>\n";
	print "      <td width=\"20%\">Data creazione</td>\n";
	print "      <td width=\"20%\">Ultima modifica</td>\n";
	print "      <td width=\"5%\">Errori</td>\n";
	print "      <td width=\"5%\">Stato</td>\n";
	print "   </tr>\n";

	while ($rows = mysqli_fetch_assoc ($result)) {
		print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
		print "      <td width=\"5%\">&nbsp;</td>\n";
		print "      <td width=\"25%\" align=left><a href=\"list-mm-mail.php?idm=".$rows['id']."&idl=$idl\">".$rows['indirizzo']."</a></td>\n";
		print "      <td width=\"20%\" align=left>".$rows['nome']."</td>\n";
		print "      <td width=\"20%\">".$rows['creato']."</td>\n";
		print "      <td width=\"20%\">".$rows['modificato']."</td>\n";
		print "      <td width=\"5%\">".$rows['errori']."</td>\n";
		print "      <td width=\"5%\">".$rows['stato']."</td>\n";
		print "   </tr>\n";
	}

}
print "</table>\n";
print "</form>\n";


?>
