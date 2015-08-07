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
	$scheduler_type = safeget ('type');
	$stato = safeget ('stato');

	$query	= "	SELECT  
				ricezioni.oggetto AS oggetto,
				DATE_FORMAT(scheduler.data_invio, '%d.%m.%Y %T') AS invio,
				DATE_FORMAT(scheduler.data_inizio, '%d.%m.%Y %T') AS inizio,
				DATE_FORMAT(scheduler.data_termine, '%d.%m.%Y %T') AS termine,
				scheduler.inviate AS inviate,
				liste.nome AS lista,
				COUNT(destinatari.id) AS destinatari
			FROM
				scheduler
			JOIN
				utenze ON utenze.id = scheduler.id_utenze
			JOIN
				ricezioni ON ricezioni.id = scheduler.id_ricezioni
			JOIN
				liste ON scheduler.id_liste = liste.id
			JOIN
				destinatari ON destinatari.id_liste = scheduler.id_liste
			WHERE
				scheduler.id = $scheduler_id
			AND
				utenze.mail = '".authentication_get_username()."'
			AND
				scheduler.stato >= 10
	";

	$query_det = "	SELECT
				DATE_FORMAT(invii.data, '%d.%m.%Y %T') AS inviata,
				DATE_FORMAT(invii.data_reply, '%d.%m.%Y %T') AS data_reply,
				invii.action AS action,
				invii.status AS status,
				invii.dc AS dc,
				destinatari.indirizzo AS indirizzo,
				destinatari.id AS id,
				destinatari.nome AS nome
			FROM
				invii
			JOIN
				destinatari ON destinatari.id = invii.id_destinatari
			WHERE
				invii.id_scheduler = $scheduler_id
			AND
				invii.stato = $stato
	";

}

//	print $query_det; exit;


if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset ($_POST['fSchedula'])) $fSchedula = safepost('fSchedula');
	if (isset ($_POST['fId'])) $fId = safepost('fId');
	if (isset ($_POST['fType'])) $fType = safepost('fType');

	if ($fSchedula == "Torna") { 
       		header ("Location: ".$CONF['postfix_admin_url']."/user-mm-new.php?type=$fType&id=$fId");
		exit(0);
	}

}



$result_det = mysqli_query ($link_mm, $query_det);
$result = mysqli_query ($link_mm, $query);

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/utenza-mm-view-inv-det.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */
?>
