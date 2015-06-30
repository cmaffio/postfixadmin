<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>

<script type="text/javascript">
function newLocation()
{
window.location="<?php print $fCanceltarget; ?>"
}

</script>
<div id="edit_form">

<form name="edit-vacation" method="post" action=''>
<table>
   <tr>
      <td colspan="3"><h3><?php print $PALANG['pUsersVacation_welcome']; ?></h3></td>
   </tr>
   <tr>
      <td><?php print $PALANG['pUsersLogin_username'] . ":"; ?></td>
      <td><?php print $tUseremail; ?></td>
      <td>&nbsp;</td>
   </tr>
   <tr>
      <td><?php print $PALANG['pUsersVacation_subject'] . ":"; ?></td>
      <td><textarea class="flat" cols="60" name="fSubject" ><?php print htmlentities(stripslashes($tSubject), ENT_QUOTES, 'UTF-8'); ?></textarea></td>
      <td>&nbsp;</td>
   </tr>
   <tr>
      <td><?php print $PALANG['pUsersVacation_body'] . ":"; ?></td>
      <td><textarea class="flat" rows="10" cols="60" name="fBody" ><?php print htmlentities(stripslashes($tBody), ENT_QUOTES , 'UTF-8'); ?></textarea></td>
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
			if (strlen ($datastart)!=0) {
				$vacancystart = $datastart;
				$vacancystop = $datastop;
			}
			$date5_default = "";
                        $myCalendar = new tc_calendar("datainizio", true, false);
                        $myCalendar->setPath("calendar/");
                        $myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if (strlen($vacancystart)!=0){
				//$datastart = strtok($vacancystart," ");
				//$anno = strtok($datastart,"-");
				$dataini = strtok($vacancystart," ");
				$anno = strtok($dataini,"-");
				$mese = strtok("-");
				$giorno = strtok("-");
				$myCalendar->setDate($giorno,$mese,$anno);
			}else{
				$myCalendar->setDate(date('d'), date('m'), date('Y'));
                        	$myCalendar->dateAllow(date("Y-m-d"),"",false);
			}
			$myCalendar->startMonday(true);
                        $myCalendar->setYearInterval(2011, 2020);
                        $myCalendar->setAlignment("left", "bottom");
                        $myCalendar->setDatePair("datainizio", "datafine", $date5_default);
                        $myCalendar->writeScript();
                ?>
                </td>
                <td>
                <?php
			$date4_default = "";
                        $myCalendar = new tc_calendar("datafine", true, false);
			$myCalendar->startMonday(true);
                        $myCalendar->setPath("calendar/");
                        $myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if (strlen($vacancystop)!=0){
				$datastop = strtok($vacancystop," ");
				$anno = strtok($datastop,"-");
				$mese = strtok("-");
				$giorno = strtok("-");
				$myCalendar->setDate($giorno,$mese,$anno);
			}else{
				$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
                        $myCalendar->dateAllow(date("Y-m-d"),"",false);
                        $myCalendar->setYearInterval(2011, 2020);
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

      <input class="button" type="submit" name="fChange" value="<?php print $PALANG['pEdit_vacation_set']; ?>" />
      <input class="button" type="submit" name="fBack" value="<?php print $PALANG['pEdit_vacation_remove']; ?>" />
      <input class="button" type="button" name="fCancel" value="<?php print $PALANG['exit']; ?>" onclick="newLocation()" />
      </td>
   </tr>

   <tr>
      <td colspan="3" class="standout"><?php print $tMessage; ?></td>
   </tr>
</table>
</form>
</div>
