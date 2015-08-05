<?php 
if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); 

$rows = mysqli_fetch_assoc ($result); 
?>

<div id="edit_form">
<form name="" method="post">
<input type="hidden" name="fId" value="<?php print $scheduler_id ?>">
<input type="hidden" name="fType" value="<?php print $scheduler_type ?>">
<table>
    <tr>
        <td colspan="3"><h3>Schedulazione invio mail</h3></td>
    </tr>
    <tr>
        <td nowrap>Oggetto:&nbsp;</td>
        <td><?php print pack ("H*", $rows['oggetto']) ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td nowrap>Arrivo:&nbsp;</td>
        <td><?php print $rows['arrivata'] ?></td>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td nowrap>Data Invio:&nbsp;</td>
	<td>
<?php
	$myCalendar = new tc_calendar("fDataInvio", true, false);
	$myCalendar->setPath("calendar/");
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setDate($rows['inizio_d'], $rows['inizio_m'], $rows['inizio_y']);
	$myCalendar->startMonday(true);
	$myCalendar->setAlignment("left", "bottom");
	$myCalendar->setYearInterval(2011, 2030);
	$myCalendar->writeScript();
?>
	<select name="fInvio_Ora">
<?php	for ($i=0;$i<24;$i++) { ?>
		<option value=<?php print $i ?> <?php if ($i == $rows['inizio_k']) { print "selected"; } ?>><?php print $i ?></option>
<?php	} ?>
	</select>
	<select name="fInvio_Min">
<?php	for ($i=0;$i<60;$i+=5) { ?>
		<option value=<?php print $i ?> <?php if ($i == $rows['inizio_i']) { print "selected"; } ?>><?php print $i ?></option>
<?php	} ?>
	</select>
        <td>&nbsp;</td>
	</td>
    </tr>
    <tr>
        <td nowrap>Lista di invio:&nbsp;</td>
	<td>
	<select name="fInvio_Lista">
<?php	while ($rows_list = mysqli_fetch_assoc ($result_lis)) { ?>
		<option value="<?php print $rows_list['id'] ?>" <?php if ($rows['idlista'] == $rows_list['id']) { print "selected"; } ?> ><?php print $rows_list['nome'] ?></option>
<?php	} ?>
	</select>
        <td>&nbsp;</td>
	</td>
    </tr>

    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="3" class="hlp_center">
            <input class="button" type="submit" name="fSchedula" value="<?php print "Modifica" ?>" />
            <input class="button" type="submit" name="fSchedula" value="<?php print "Azzera" ?>" />
            <input class="button" type="submit" name="fSchedula" value="<?php print "Elimina" ?>" />
            <input class="button" type="submit" name="fSchedula" value="<?php print "Annulla" ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="3" class="standout"><?php print $tMessage; ?></td>
    </tr>
</table>
</form>
</div>
