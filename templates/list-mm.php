<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<?php 

print "<table id=\"admin_table\">\n";
print "   <tr>\n";
print "   <form name=\"\" method=\"post\">\n";
print "      <td width=\"5%\">&nbsp;</td>\n";
print "      <td width=\"20%\"><input type=\"text\" name=\"fName\"></td>\n";
print "      <td width=\"25%\" align=left><input class=\"button\" type=\"submit\" name=\"fSchedula\" value=\"Crea una nuova lista\"></td>\n";
print "      <td width=\"55%\">&nbsp;</td>\n";
print "   </form>\n";
print "   <tr><td colspan=\"4\">&nbsp;</td></tr>\n";
print "   </tr>\n";

if ($num > 0) {
	print "   <tr class=\"header\">\n";
	print "      <td colspan=\"4\">Liste Mail</td>\n";
	print "   </tr>\n";
	print "   <tr class=\"header\">\n";
	print "      <td width=\"5%\">&nbsp;</td>\n";
	print "      <td width=\"20%\" align=left>Nome lista</td>\n";
	print "      <td width=\"25%\">Dimensione</td>\n";
	print "      <td width=\"55%\" align=left>Ultima modifica</td>\n";
	print "   </tr>\n";

	while ($rows = mysqli_fetch_assoc ($result)) {
		print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
		print "      <td width=\"5%\">&nbsp;</td>\n";
		print "      <td align=left><a href=\"list-mm-dett.php?idl=".$rows['id']."\">".$rows['nome']."</a></td>\n";
		print "      <td>".$rows['quanti']."</td>\n";
		print "      <td align=left>".$rows['modifica']."</td>\n";
		print "   </tr>\n";
	}

}
print "</table>\n";


?>
