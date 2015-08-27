<?php 
if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); 

$rows = mysqli_fetch_assoc ($result); 
?>

<div id="edit_form">
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
        <td nowrap>Inizio invio effettivo:&nbsp;</td>
        <td><?php print $rows['inizio'] ?></td>
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
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" class="hlp_center">
            <input class="button" type="submit" name="fSchedula" value="<?php print "Interrompi" ?>" />
            <input class="button" type="submit" name="fSchedula" value="<?php print "Annulla" ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="3" class="standout"><?php print $tMessage; ?></td>
    </tr>
</table>
</form>
</div>
