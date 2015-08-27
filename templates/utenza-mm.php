<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<?php 

if ($num_mm_new > 0) {
	print "<table id=\"admin_table\">\n";
	print "   <tr class=\"header\">\n";
	print "      <td colspan=\"4\">Mail in attesa di schedulazione</td>\n";
	print "   </tr>\n";
	print "   <tr class=\"header\">\n";
	print "      <td width=\"5%\">ID</td>\n";
	print "      <td width=\"20%\" align=left>Oggetto</td>\n";
	print "      <td width=\"15%\">Data arrivo</td>\n";
	print "      <td width=\"60%\">&nbsp;</td>\n";
	print "   </tr>\n";

	while ($rows = mysqli_fetch_assoc ($result_new)) {
		print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
		print "      <td><a href=\"user-mm-new.php?type=new&id=".$rows['id']."\">".$rows['id']."</a></td>\n";
		print "      <td align=left>".pack ("H*", $rows['oggetto'])."</td>\n";
		print "      <td nowrap>".$rows['arrivata']."</td>\n";
		print "      <td>&nbsp;</td>\n";
		print "   </tr>\n";
	}
	print "   <tr><td colspan=\"3\">&nbsp;</td></tr>\n";
	print "</table>\n";
}

if ($num_mm_sch > 0) {
	print "<table id=\"admin_table\">\n";
	print "   <tr class=\"header\">\n";
	print "      <td colspan=\"6\">Mail schedulate</td>\n";
	print "   </tr>\n";
	print "   <tr class=\"header\">\n";
	print "      <td width=\"5%\">ID</td>\n";
	print "      <td width=\"20%\" align=left>Oggetto</td>\n";
	print "      <td width=\"15%\">Data invio</td>\n";
	print "      <td>Lista invio</td>\n";
	print "      <td>Destinatari</td>\n";
	print "      <td>Dim. blocco</td>\n";
	print "   </tr>\n";

	while ($rows = mysqli_fetch_assoc ($result_sch)) {
		$query_dim = "SELECT COUNT(id) AS dim FROM destinatari WHERE stato = 1 AND id_liste = ".$rows['lista_id'];
		$result_dim = mysqli_query ($link_mm, $query_dim);
		$dim = mysqli_fetch_assoc ($result_dim);

		print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
		print "      <td><a href=\"user-mm-new.php?type=sch&id=".$rows['id']."\">".$rows['id']."</a></td>\n";
		print "      <td align=left>".pack ("H*", $rows['oggetto'])."</td>\n";
		print "      <td>".$rows['partenza']."</td>\n";
		print "      <td>".$rows['lista']."</td>\n";
		print "      <td>".$dim['dim']."</td>\n";
		print "      <td>".$rows['blocchi']."</td>\n";
		print "   </tr>\n";
	}
	print "   <tr><td colspan=\"3\">&nbsp;</td></tr>\n";
	print "</table>\n";
}

if ($num_mm_run > 0) {
	print "<table id=\"admin_table\">\n";
	print "   <tr class=\"header\">\n";
	print "      <td colspan=\"7\">Mail in elaborazione</td>\n";
	print "   </tr>\n";
	print "   <tr class=\"header\">\n";
	print "      <td width=\"5%\">ID</td>\n";
	print "      <td width=\"20%\" align=left>Oggetto</td>\n";
	print "      <td width=\"15%\">Data invio</td>\n";
	print "      <td>Data inizio</td>\n";
	print "      <td>Lista invio</td>\n";
	print "      <td>Inviate</td>\n";
	print "      <td>Dim. blocco</td>\n";
	print "   </tr>\n";

	while ($rows = mysqli_fetch_assoc ($result_run)) {
		$query_dim = "SELECT COUNT(id) AS dim FROM destinatari WHERE stato = 1 AND id_liste = ".$rows['lista_id'];
		$result_dim = mysqli_query ($link_mm, $query_dim);
		$dim = mysqli_fetch_assoc ($result_dim);

		print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
		print "      <td><a href=\"user-mm-new.php?type=ela&id=".$rows['id']."\">".$rows['id']."</a></td>\n";
		print "      <td align=left>".pack ("H*", $rows['oggetto'])."</td>\n";
		print "      <td>".$rows['partenza']."</td>\n";
		print "      <td>".$rows['iniziata']."</td>\n";
		print "      <td>".$rows['lista']."</td>\n";
		print "      <td>".$rows['inviate']." / ".$dim['dim']."</td>\n";
		print "      <td>".$rows['blocchi']."</td>\n";
		print "   </tr>\n";
	}
	print "   <tr><td colspan=\"3\">&nbsp;</td></tr>\n";
	print "</table>\n";
}


if ($num_mm_end > 0) {
	print "<table id=\"admin_table\">\n";
	print "   <tr class=\"header\">\n";
	print "      <td colspan=\"8\">Mail Inviate</td>\n";
	print "   </tr>\n";
	print "   <tr class=\"header\">\n";
	print "      <td width=\"5%\">ID</td>\n";
	print "      <td width=\"20%\" align=left>Oggetto</td>\n";
	print "      <td width=\"15%\">Data invio</td>\n";
	print "      <td>Data inizio</td>\n";
	print "      <td>Data termine</td>\n";
	print "      <td>Lista invio</td>\n";
	print "      <td>Inviate</td>\n";
	print "      <td>Dim. blocco</td>\n";
	print "   </tr>\n";

	while ($rows = mysqli_fetch_assoc ($result_end)) {
		$query_dim = "SELECT COUNT(id) AS dim FROM destinatari WHERE stato = 1 AND id_liste = ".$rows['lista_id'];
		$result_dim = mysqli_query ($link_mm, $query_dim);
		$dim = mysqli_fetch_assoc ($result_dim);

		if (is_null ($rows['termine'])) {
			$rows['termine'] = "Interrotto";
		}

		print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
		print "      <td><a href=\"user-mm-new.php?type=inv&id=".$rows['id']."\">".$rows['id']."</a></td>\n";
		print "      <td align=left>".pack ("H*", $rows['oggetto'])."</td>\n";
		print "      <td>".$rows['partenza']."</td>\n";
		print "      <td>".$rows['iniziata']."</td>\n";
		print "      <td>".$rows['termine']."</td>\n";
		print "      <td>".$rows['lista']."</td>\n";
		print "      <td>".$rows['inviate']." / ".$dim['dim']."</td>\n";
		print "      <td>".$rows['blocchi']."</td>\n";
		print "   </tr>\n";
	}
	print "   <tr><td colspan=\"3\">&nbsp;</td></tr>\n";
	print "</table>\n";
}

/* vim: set ft=php expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
