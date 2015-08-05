<?php 
if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); 

$rows = mysqli_fetch_assoc ($result); 

$tab_stato = 	array(
			-2	=>	'Errore permanente',
			-1	=>	'Errore temporaneo',
			0	=>	'In attesa',
			1	=>	'Consegnata',
			2	=>	'Letta'
		);
?>

<div id="list_table">
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
    <tr><td colspan="3">&nbsp;</td></tr>
</table>

<table>
	<tr class="header">
		<td colspan="10">Mail con stato "<?php print $tab_stato[$stato]?>"</td>
	</tr>
	<tr>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
		<td width="10%">&nbsp;</td>
	</tr>
<?php while ($rows = mysqli_fetch_assoc ($result_det)) { ?>
	<tr>
		<td colspan=2><b>Nome:&nbsp;</b></td>
		<td colspan=8><?php print $rows['nome']?></td>
	</tr>
	<tr>
		<td colspan=2><b>Mail:&nbsp;</b></td>
		<td colspan=8><?php print $rows['indirizzo']?></td>
	</tr>
	<tr>
		<td colspan=3 align=center><b>Data invio</b></td>
		<td colspan=4 align=center><b>Data reply</b></td>
		<td colspan=3 align=center><b>Stato</b></td>
	</tr>
	<tr>
		<td colspan=3 align=center><?php print $rows['inviata']?></td>
		<td colspan=4 align=center><?php print $rows['data_reply']?></td>
		<td colspan=3 align=center><?php print $rows['action']." ".$rows['status']?></td>
	</tr>
	<tr>
        	<td colspan=10><?php print $rows['dc']?></td>
	</tr>
    	<tr><td colspan="10">&nbsp;</td></tr>
<?php } ?>
</table>

<table id="admin_table">
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr>
        <td colspan="3" class="hlp_center">
            <input class="button" type="submit" name="fSchedula" value="<?php print "Torna" ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="3" class="standout"><?php print $tMessage; ?></td>
    </tr>
</table>
</form>
</div>
