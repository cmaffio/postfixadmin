<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<?php 

$rows = mysqli_fetch_assoc ($result);

if ( $rows['stato']) {
	$testo = "Disattiva";
}else {
	$testo = "Attiva";
}

print "<form name=\"\" method=\"post\">\n";
print "<input type=\"hidden\" name=\"idl\" value=\"$idl\">\n";
print "<input type=\"hidden\" name=\"idm\" value=\"$idm\">\n";
print "<table id=\"admin_table\">\n";

print "   <tr class=\"header\">\n";
print "      <td colspan=\"7\">Dettaglio Mail</td>\n";
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

print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
print "      <td width=\"5%\">&nbsp;</td>\n";
print "      <td width=\"25%\" align=left><input type=\"text\" name=\"fMail\" value=\"".$rows['indirizzo']."\"></td>\n";
print "      <td width=\"20%\" align=left><input type=\"text\" name=\"fNome\" value=\"".$rows['nome']."\"></td>\n";
print "      <td width=\"20%\">".$rows['creato']."</td>\n";
print "      <td width=\"20%\">".$rows['modificato']."</td>\n";
print "      <td width=\"5%\">".$rows['errori']."</td>\n";
print "      <td width=\"5%\">".$rows['stato']."</td>\n";
print "   </tr>\n";

print "   <tr><td colspan=\"7\">&nbsp;</td></tr>\n";
print "   <tr><td colspan=\"7\">\n";
print "       <input class=\"button\" type=\"submit\" name=\"fSchedula\" value=\"$testo\">\n";
print "       <input class=\"button\" type=\"button\" value=\"Torna\" onclick=\"history.go(-1);\" />\n";
print "       <input class=\"button\" type=\"submit\" name=\"fSchedula\" value=\"Aggiorna\">\n";
print "   </td></tr>\n";
print "   <tr><td colspan=\"7\">&nbsp;</td></tr>\n";
print "</table>\n";
print "</form>\n";

print "<table id=\"list_table\">\n";
while ($rows = mysqli_fetch_assoc ($result_m)) {

	if ($rows['stato'] < 0) {
		$status = "<b>".$rows['action']." ".$rows['status']."</b>";
	} else {
		$status = $rows['action']." ".$rows['status'];
	}

	print "   <tr class=\"header\">\n";
	print "      <td width=\"5%\">&nbsp;</td>\n";
	print "      <td width=\"55%\" align=\"left\">Oggetto</td>\n";
	print "      <td width=\"15%\" align=\"left\">Data invio</td>\n";
	print "      <td width=\"15%\" align=\"left\">Data risposta</td>\n";
	print "      <td width=\"10%\" align=\"left\">Stato</td>\n";
	print "   </tr>\n";
	print "   <tr>\n";
	print "      <td width=\"5%\">&nbsp;</td>\n";
	print "      <td width=\"55%\" align=\"left\">".pack ("H*", $rows['oggetto'])."</td>\n";
	print "      <td width=\"15%\" align=\"left\">".$rows['data']."</td>\n";
	print "      <td width=\"15%\" align=\"left\">".$rows['data_reply']."</td>\n";
	print "      <td width=\"10%\" align=\"left\">$status</td>\n";
	print "   </tr>\n";
	print "   <tr>\n";
	print "      <td width=\"5%\">&nbsp;</td>\n";
	print "      <td colspan=4 align=\"left\">".$rows['dc']."</td>\n";
	print "   </tr>\n";
	print "   <tr>\n";
	print "      <td colspan=5>&nbsp;</td>\n";
	print "   </tr>\n";
}
print "</table>\n";
?>
