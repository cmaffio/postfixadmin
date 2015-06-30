<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>

<div id="edit_form">
<form name="vacation" method="post">
<table>
    <tr>
        <td colspan="3"><h3><?php print $PALANG['pUsersVacation_welcome']; ?></h3></td>
    </tr>
    <tr>
        <td><?php print $PALANG['pUsersVacation_subject'] . ":"; ?></td>
        <td><input type="text" name="fSubject" value="<?php print htmlentities($tSubject, ENT_QUOTES, 'UTF-8'); ?>" /></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><?php print $PALANG['pUsersVacation_body'] . ":"; ?></td>
        <td>
		<textarea rows="10" cols="80" name="fBody"><?php echo htmlentities($tBody, ENT_QUOTES, 'UTF-8') ?></textarea>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
	<td colspan=3>
	<table>
        <tr>
        <td>Data inizio</td><td>Data fine</td>
	</tr>
         <td>
         <?php

          	$date5_default = "";
                $myCalendar = new tc_calendar("datainizio", true, false);
		$myCalendar->setPath("calendar/");
                $myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if (strlen($tStartR)!=0){
                                $datastart = strtok($tStartR," ");
                                $anno = strtok($datastart,"-");
                                $mese = strtok("-");
                                $giorno = strtok("-");
                                $myCalendar->setDate($giorno,$mese,$anno);
                }else{
                	$myCalendar->setDate(date('d'), date('m'), date('Y'));
                	$myCalendar->dateAllow(date("Y-m-d"),"",false);
                }
                $myCalendar->setYearInterval(2011, 2020);
                $myCalendar->setAlignment("left", "bottom");
                $myCalendar->setDatePair("datainizio", "datafine", $date5_default);
		$myCalendar->startMonday(true);
                $myCalendar->writeScript();
          ?>
          </td>
          <td>
	  <?php
		$date4_default = "";
                $myCalendar = new tc_calendar("datafine", true, false);
		$myCalendar->setPath("calendar/");
                $myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if (strlen($tStopR)!=0){
                                $datastop = strtok($tStopR," ");
                                $anno = strtok($datastop,"-");
                                $mese = strtok("-");
                                $giorno = strtok("-");
                                $myCalendar->setDate($giorno,$mese,$anno);
                        }else{
                                $myCalendar->setDate(date('d'), date('m'), date('Y'));
                }
		$myCalendar->startMonday(true);
                $myCalendar->setYearInterval(2011, 2020);
                $myCalendar->dateAllow(date("Y-m-d"),"",false);
                $myCalendar->setAlignment("right", "bottom");
                $myCalendar->setDatePair("datainizio", "datafine", $date4_default);
                $myCalendar->writeScript();
          ?>
          </td>
          </tr>
          </table>
          </td>
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
<?php /* vim: set ft=php expandtab softtabstop=4 tabstop=4 shiftwidth=4: */ ?>
