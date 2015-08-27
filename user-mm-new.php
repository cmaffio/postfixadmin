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

	switch ($scheduler_type) {
		case "new":
			$template = "utenza-mm-view-new.php";

			$query	= "	SELECT  
						ricezioni.oggetto AS oggetto,
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
			break;
		case "sch":
			$template = "utenza-mm-view-sch.php";

			$query	= "	SELECT  
						ricezioni.oggetto AS oggetto,
						DATE_FORMAT(ricezioni.arrivata, '%d.%m.%Y %T') AS arrivata,
						DATE_FORMAT(scheduler.data_invio, '%d') AS inizio_d,
						DATE_FORMAT(scheduler.data_invio, '%m') AS inizio_m,
						DATE_FORMAT(scheduler.data_invio, '%Y') AS inizio_y,
						DATE_FORMAT(scheduler.data_invio, '%k') AS inizio_k,
						DATE_FORMAT(scheduler.data_invio, '%i') AS inizio_i,
						liste.id AS idlista
					FROM
						scheduler
					JOIN
						utenze ON utenze.id = scheduler.id_utenze
					JOIN
						ricezioni ON ricezioni.id = scheduler.id_ricezioni
					JOIN
						liste ON scheduler.id_liste = liste.id
					WHERE
						scheduler.id = $scheduler_id
					AND
						utenze.mail = '".authentication_get_username()."'
					AND
						scheduler.stato = 1
			";
			break;
		case "ela":
			$template = "utenza-mm-view-ela.php";

			$query	= "	SELECT  
						ricezioni.oggetto AS oggetto,
						DATE_FORMAT(scheduler.data_invio, '%d.%m.%Y %T') AS invio,
						DATE_FORMAT(scheduler.data_inizio, '%d.%m.%Y %T') AS inizio,
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
						scheduler.stato = 2
			";
			break;
		case "inv":
			$template = "utenza-mm-view-inv.php";
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
			break;
	}
}

//	print $query; exit;


if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset ($_POST['fId'])) $scheduler_id = safepost('fId');
	if (isset ($_POST['fType'])) $scheduler_type = safepost('fType');
	if (isset ($_POST['fSchedula'])) $fSchedula = safepost('fSchedula');

	if ($fSchedula == "Annulla") { 
       		header ("Location: ".$CONF['postfix_admin_url']."/user-mm.php");
		exit(0);
	}

	if (isset ($_POST['fDataInvio'])) $fDataInvio = safepost('fDataInvio');
	if (isset ($_POST['fInvio_Ora'])) $fInvio_Ora = safepost('fInvio_Ora');
	if (isset ($_POST['fInvio_Min'])) $fInvio_Min = safepost('fInvio_Min');
	if (isset ($_POST['fInvio_Lista'])) $fInvio_Lista = safepost('fInvio_Lista');
	if (isset ($_POST['fSchedula'])) $fSchedula = safepost('fSchedula');

	switch ($scheduler_type) {
		case "new":
			if ($fSchedula == "Conferma") {
				$data_invio = "$fDataInvio $fInvio_Ora:$fInvio_Min:00";
				$query = "	UPDATE
							scheduler
						SET
							data_invio	=	'$data_invio',
							id_liste	=	$fInvio_Lista,
							destinatari	=	(SELECT COUNT(id) AS dim FROM destinatari WHERE stato = 1 AND id_liste = $fInvio_Lista),
							stato		=	1
						WHERE
							id		=	$scheduler_id
				";
			} elseif ($fSchedula == "Clona") {
				for ($i = 0, $a = ""; $i<32; $i++) { $a .= mt_rand(0,9); }
				$query = "	INSERT INTO
							scheduler
							(id_utenze, id_ricezioni, stato, messageid, numero)
						SELECT
							id_utenze, id_ricezioni, stato, '$a', numero
						FROM 
							scheduler
						WHERE
							id = $scheduler_id
				";
			} elseif ($fSchedula == "Elimina") {
				$query = "	DELETE FROM
							scheduler
						WHERE
							id = $scheduler_id
				";
			}
			break;
		case "sch":
			if ($fSchedula == "Modifica") {
				$data_invio = "$fDataInvio $fInvio_Ora:$fInvio_Min:00";
				$query = "	UPDATE
							scheduler
						SET
							data_invio	=	'$data_invio',
							id_liste	=	$fInvio_Lista
						WHERE
							id		=	$scheduler_id
				";
			} elseif ($fSchedula == "Azzera") {
				$query = "	UPDATE
							scheduler
						SET
							id_liste	=	NULL,
							data_invio	=	NULL,
							stato		=	0
						WHERE
							id		=	$scheduler_id
				";
			} elseif ($fSchedula == "Elimina") {
				$query = "	DELETE FROM
							scheduler
						WHERE
							id = $scheduler_id
				";
			}
			break;
		case "ela":
			if ($fSchedula == "Interrompi") {
				$query = "	UPDATE
							scheduler
						SET
							stato	=	11
						WHERE
							id	=	$scheduler_id
				";
			}
			break;
		case "inv":
			break;


	}
//	print $query; exit;



	$result = mysqli_query ($link_mm, $query);
       	header ("Location: ".$CONF['postfix_admin_url']."/user-mm.php");
	exit(0);
}

/*
            	$error = 1;
            	$tMessage = $PALANG['pUsersVacation_result_error'];
        
		$tMessage = $PALANG['pUsersVacation_result_success'];
*/




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

	$result = mysqli_query ($link_mm, $query);
	$num_mm = mysqli_num_rows ($result);

	$result_lis = mysqli_query ($link_mm, $query_lis);
	$num_mm_lis = mysqli_num_rows ($result_lis);





include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/$template");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */
?>
