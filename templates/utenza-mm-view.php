<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>

<?php
$rows = mysqli_fetch_assoc ($result_sch);

?>

<div id="edit_form">
<form name="" method="post">
<table>
    <tr>
        <td colspan="3"><h3>Testo temporaneo!!!!!!</h3></td>
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
	$myCalendar = new tc_calendar("datainvio", true, false);
	$myCalendar->setPath("calendar/");
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setDate(date('d'), date('m'), date('Y'));
	$myCalendar->startMonday(true);
	$myCalendar->setAlignment("left", "bottom");
	$myCalendar->setYearInterval(2011, 2030);
	$myCalendar->writeScript();
?>
	<select name="invio_ora">
<?php	for ($i=0;$i<24;$i++) { ?>
		<option value=<?php print $i ?>><?php print $i ?></option>
<?php	} ?>
	</select>
	<select name="invio_min">
<?php	for ($i=0;$i<60;$i+=5) { ?>
		<option value=<?php print $i ?>><?php print $i ?></option>
<?php	} ?>
	</select>
        <td>&nbsp;</td>
	</td>
    </tr>
    <tr>
        <td nowrap>Lista di invio:&nbsp;</td>
	<td>
	<select name="invio_ora">
<?php	while ($rows = mysqli_fetch_assoc ($result_lis)) { ?>
		<option value=<?php print $rows['id'] ?>><?php print $rows['nome'] ?></option>
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
            <input class="button" type="submit" name="fAway" value="<?php print $PALANG['pUsersVacation_button_away']; ?>" />
            <input class="button" type="submit" name="fBack" value="<?php print $PALANG['pUsersVacation_button_back']; ?>" />
            <input class="button" type="submit" name="fCancel" value="<?php print $PALANG['exit']; ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="3" class="standout"><?php print $tMessage; ?></td>
    </tr>
</table>
</form>
</div>
