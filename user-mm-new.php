<?php

require_once("common.php");
require_once("$incpath/calendar/tc_calendar.php");

authentication_require_role ('mm');

if (function_exists ("mysqli_connect")) {
	$link_mm = mysqli_connect ($MM['database_host'], $MM['database_user'], $MM['database_password']) or $error_text .= ("<p />DEBUG INFORMATION:<br />Connect: " .  mysqli_connect_error () . "$DEBUG_TEXT");
	if ($link_mm) {
		mysqli_query($link_mm,"SET CHARACTER SET utf8");
		mysqli_query($link_mm,"SET COLLATION_CONNECTION='utf8_general_ci'");
		$success = mysqli_select_db ($link_mm, $MM['database_name']) or $error_text .= ("<p />DEBUG INFORMATION:<br />MySQLi Select Database: " .  mysqli_error ($link_mm) . "$DEBUG_TEXT");
	}
} else {
	$error_text .= "<p />DEBUG INFORMATION:<br />MySQL 4.1 functions not available! (php5-mysqli installed?)<br />";
}
print "$error_text";

if ($_SERVER['REQUEST_METHOD'] == "GET") {

	$scheduler_id = safeget ('id');

	$query_sch = "	SELECT  
				ricezioni.oggetto AS oggetto,
				ricezioni.corpo AS corpo,
				DATE_FORMAT(ricezioni.arrivata, '%d.%m.%Y %T') AS arrivata
			FROM
				scheduler
			JOIN
				utenze ON utenze.id = scheduler.id_utenze
			JOIN
				ricezioni ON ricezioni.id = scheduler.id_ricezioni
			WHERE
				scheduler.id = $scheduler_id
			AND
				utenze.mail = '".authentication_get_username()."'
			AND
				scheduler.stato = 0
	";

	$query_lis = "	SELECT
				liste.id AS id,
				liste.nome AS nome
			FROM
				liste
			JOIN 
				utenze ON liste.id_utenze = utenze.id
			WHERE
				utenze.mail = '".authentication_get_username()."'
			ORDER BY
				liste.nome
	";


	$result_sch = mysqli_query ($link_mm, $query_sch);
	$num_mm_sch = mysqli_num_rows ($result_sch);

	$result_lis = mysqli_query ($link_mm, $query_lis);
	$num_mm_lis = mysqli_num_rows ($result_lis);



}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['fCancel'])) {
        header("Location: main.php");
        exit(0);
    }

    if (isset ($_POST['fSubject'])) $fSubject = $_POST['fSubject'];
    if (isset ($_POST['fBody']))    $fBody    = $_POST['fBody'];
    if (isset ($_POST['fAway'])) $fAway = escape_string ($_POST['fAway']);
    if (isset ($_POST['fBack'])) $fBack = escape_string ($_POST['fBack']);
    $datastart  = safepost('datainizio');
    $datastop = safepost ('datafine');


    //set a default, reset fields for coming back selection
    if ($tSubject == '') { $tSubject = html_entity_decode($PALANG['pUsersVacation_subject_text'], ENT_QUOTES, 'UTF-8'); }
    if ($tBody == '') { $tBody = html_entity_decode($PALANG['pUsersVacation_body_text'], ENT_QUOTES, 'UTF-8'); }

    // if they've set themselves away OR back, delete any record of vacation emails.

    // the user is going away - set the goto alias and vacation table as necessary.
    if (!empty ($fAway))
    {
        if(!$vh->set_away($fSubject, $fBody, $datastart, $datastop)) {
            $error = 1;
            $tMessage = $PALANG['pUsersVacation_result_error'];
        }
        flash_info($PALANG['pVacation_result_added']);
        header ("Location: main.php");
        exit;
    }

    if (!empty ($fBack)) {
        $vh->remove();
        $tMessage = $PALANG['pUsersVacation_result_success'];
        flash_info($tMessage);
        header ("Location: main.php");
        exit;
    }
}

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/utenza-mm-view.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */
?>
