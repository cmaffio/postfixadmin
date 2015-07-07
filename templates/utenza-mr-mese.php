<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<?php 
if ($num_mr == 1) {
	print "<table id=\"admin_table\">\n";
	print "   <tr class=\"header\">\n";
	print "      <td>Account</td>\n";
	print "      <td>Data attivazione</td>\n";
	print "      <td>Scadenza</td>\n";
	print "      <td>Rimanenza</td>\n";
	print "      <td>Ultimo invio</td>\n";
	print "      <td>Inviate/Disponibili</td>\n";
	print "      <td>% Invio </td>\n";
	print "      <td>Scaduto</td>\n";
	print "      <td colspan=\"2\">&nbsp;</td>\n";
	print "   </tr>\n";

	$rows = mysqli_fetch_assoc ($result);

	$datetime1 = new DateTime("now");
	$datetime2 = DateTime::createFromFormat('d.m.Y', $rows['data_fine']);

	$interval = $datetime1->diff($datetime2);
	$diff = $interval->format('%r%a') +0;
	if ($diff < 0)
		$diff = 0;

	if ($datetime1 > $datetime2 || $rows['invio_totale_corrente'] >= $rows['limiteinvio']) {
		$scaduto = 'SI';
	} else {	
		$scaduto = 'NO';
	}
	$percentuale = round ($rows['invio_totale_corrente'] / $rows['limiteinvio'] * 100, 1);

	print "<tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
	print "<td><a href=\"user-mr.php?account=".$rows['email']."\">".$rows['email']."</a></td>";
	print "<td>".$rows['data_inizio']."</td>";
	print "<td>".$rows['data_fine']."</td>";
	print "<td>$diff giorni</td>";
	print "<td>".$rows['data_agg']."</td>";
	print "<td>".$rows['invio_totale_corrente']." / ".$rows['limiteinvio']."</td>";
	print "<td>$percentuale%</td>";
	print "<td>$scaduto</td>";
	print "</tr>\n";

	print "<tr><td colspan=\"7\">&nbsp;</td>\n";
	print "<tr><td colspan=\"7\">&nbsp;</td>\n";
	print "</table>\n";
	$acc_user = $rows['email'];
}

	$tot_invii = 0;

if ($num_mr_month > 0) {
	print "<table id=\"admin_table\">\n";
	print "   <tr class=\"header\">\n";
	print "      <td>Giorno</td>\n";
	print "      <td>Mail Inviate</td>\n";
	print "   </tr>\n";

	while ($rows = mysqli_fetch_assoc ($result_month)) {
		$tot_invii += $rows['invii'];
		print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
		print "      <td>".$rows['giorno']."</td>\n";
		print "      <td>".$rows['invii']."</td>\n";
		print "   </tr>\n";
	}
	print "	  <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
	print "      <td>Totale</td>\n";
	print "      <td>$tot_invii</td>\n";
	print "   </tr>\n";
	print "</table>\n";

}

/* vim: set ft=php expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
