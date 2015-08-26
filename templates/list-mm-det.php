<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<?php 

$rows = mysqli_fetch_assoc ($result_n);


print "<table id=\"admin_table\">\n";

print "   <tr class=\"header\">\n";
print "      <td colspan=\"7\">Indirizzi lista ".$rows['nome']."</td>\n";
print "   </tr>\n";

print "<form name=\"\" method=\"post\">\n";
print "<input type=\"hidden\" name=\"idl\" value=\"$idl\">\n";
print "   <tr>\n";
print "      <td>&nbsp;</td>\n";
print "      <td align=left><input type=\"text\" name=\"fName\"></td>\n";
print "      <td colspan=\"5\" align=left><input class=\"button\" type=\"submit\" name=\"fSchedula\" value=\"Rinomina lista\"></td>\n";
print "   </tr>\n";
print "</form>\n";

print "<form name=\"\" method=\"post\" enctype=\"multipart/form-data\">\n";
print "<input type=\"hidden\" name=\"idl\" value=\"$idl\">\n";
print "   <tr>\n";
print "      <td>&nbsp;</td>\n";
print "      <td><input type=\"file\" name=\"fFile\"></td>\n";
print "      <td>\n";

print "      <select name=\"fTipo\">\n";
print "           <option value=\"\">Seleziona formato</option>\n";
print "           <option value=\"Base\">Base</option>\n";
print "           <option value=\"Thunderbird\">Thunderbird</option>\n";
print "      </select>\n";

print "      </td>\n";
print "      <td colspan=\"4\" align=left><input class=\"button\" type=\"submit\" name=\"fSchedula\" value=\"Aggiungi indirizzi\"></td>\n";
print "   </tr>\n";
print "</form>\n";

print "   <tr>\n";
print "      <td colspan=\"7\">&nbsp;</td>\n";
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

print "<form name=\"\" method=\"post\">\n";
print "<input type=\"hidden\" name=\"idl\" value=\"$idl\">\n";
print "   <tr>\n";
print "      <td width=\"5%\">&nbsp;</td>\n";
print "      <td width=\"25%\" align=left><input type=\"text\" name=\"fMail\"></td>\n";
print "      <td width=\"20%\" align=left><input type=\"text\" name=\"fNome\"></td>\n";
print "      <td width=\"20%\"><input class=\"button\" type=\"submit\" name=\"fSchedula\" value=\"Aggiungi\"></td>\n";
print "      <td width=\"30%\" colspan=\"3\">&nbsp;</td>\n";
print "   </tr>\n";
print "</form>\n";

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

print "   <tr>\n";
print "      <td colspan=\"7\">&nbsp;</td>\n";
print "   </tr>\n";

print "<form name=\"\" method=\"post\">\n";
print "<input type=\"hidden\" name=\"idl\" value=\"$idl\">\n";
print "   <tr>\n";
print "      <td colspan=\"7\"><input class=\"button\" type=\"submit\" name=\"fSchedula\" value=\"Torna\"></td>\n";
print "   </tr>\n";
print "</form>\n";

print "</table>\n";


?>
