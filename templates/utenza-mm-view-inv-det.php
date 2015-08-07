<?php 
if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); 

$rows = mysqli_fetch_assoc ($result); 

if (is_null ($rows['termine'])) {
	$rows['termine'] = "Interrotto";
}

$tab_stato = 	array(
			-2	=>	'Errore permanente',
			-1	=>	'Errore temporaneo',
			0	=>	'In attesa',
			1	=>	'Consegnata',
			2	=>	'Letta'
		);
?>

<form name="" method="post">
<input type="hidden" name="fId" value="<?php print $scheduler_id ?>">
<input type="hidden" name="fType" value="<?php print $scheduler_type ?>">
<table id="admin_table">
    <tr class="header">
        <td colspan="3">Schedulazione invio mail</td>
    </tr>
    <tr>
        <td nowrap>Oggetto:&nbsp;</td>
        <td><?php print pack ("H*", $rows['oggetto']) ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td nowrap>Inizio invio previsto:&nbsp;</td>
        <td><?php print $rows['invio'] ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td nowrap>Inizio invio:&nbsp;</td>
        <td><?php print $rows['inizio'] ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td nowrap>Termine invio:&nbsp;</td>
        <td><?php print $rows['termine'] ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td nowrap>Lista di invio:&nbsp;</td>
        <td><?php print $rows['lista'] ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td nowrap>Inviate / Totale:&nbsp;</td>
        <td><?php print $rows['inviate'] ?> / <?php print $rows['destinatari'] ?></td>
        <td>&nbsp;</td>
    </tr>
</table>

<table id="list_table">
	<tr>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
		<td width="5%">&nbsp;</td>
	</tr>
	<tr class="header">
		<td colspan="20">Mail con stato "<?php print $tab_stato[$stato]?>"</td>
	</tr>
    	<tr><td colspan="20">&nbsp;</td></tr>
<?php while ($rows = mysqli_fetch_assoc ($result_det)) { ?>
	<tr class="header">
		<td align=left colspan=5>Indirizzo</td>
		<td align=left colspan=4>Nominativo</td>
		<td align=center colspan=4>Data invio</td>
		<td align=center colspan=4>Data reply</td>
		<td align=center colspan=3>Stato</td>
	</tr>

	<tr>
<?php // list-mm-mail.php?idm=4&idl=1 ?>

		<td align=left colspan=5><a href = "list-mm-mail.php?idm=<?php print $rows['id']?>"><?php print $rows['indirizzo']?></a></td>
		<td align=left colspan=4><?php print $rows['nome']?></td>
		<td align=center colspan=4><?php print $rows['inviata']?></td>
		<td align=center colspan=4><?php print $rows['data_reply']?></td>
		<td align=center colspan=3><?php print $rows['action']." ".$rows['status']?></td>
	</tr>
	<tr>
        	<td colspan=20><?php print $rows['dc']?></td>
	</tr>
    	<tr><td colspan="20">&nbsp;</td></tr>
<?php } ?>
</table>

<table id="list_table">
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr>
        <td colspan="3" class="hlp_center">
	    <input class="button" type="button" value="Torna" onclick="history.go(-1);" />
        </td>
    </tr>
    <tr>
        <td colspan="3" class="standout"><?php print $tMessage; ?></td>
    </tr>
</table>
</form>
