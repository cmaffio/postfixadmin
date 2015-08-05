<?php
require_once('common.php');

authentication_require_role ('mm');

$error_text = "";
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

$query_new = "	SELECT 
			ricezioni.oggetto AS oggetto, 
			DATE_FORMAT(ricezioni.arrivata, '%d.%m.%Y %T') AS arrivata, 
			scheduler.id AS id
		FROM 
			scheduler 
		JOIN 
			utenze ON utenze.id = scheduler.id_utenze
		JOIN
			ricezioni ON ricezioni.id = scheduler.id_ricezioni
		WHERE
			utenze.mail = '".authentication_get_username()."'
		AND
			scheduler.stato = 0
		ORDER BY 
			ricezioni.arrivata
		";

$query_sch = "	SELECT 
			ricezioni.oggetto AS oggetto, 
			DATE_FORMAT(scheduler.data_invio, '%d.%m.%Y %T') AS partenza, 
			scheduler.id AS id,
			liste.nome as lista,
			liste.id as lista_id,
			scheduler.numero as blocchi
		FROM 
			scheduler 
		JOIN 
			utenze ON utenze.id = scheduler.id_utenze
		JOIN
			ricezioni ON ricezioni.id = scheduler.id_ricezioni
		JOIN
			liste ON liste.id = scheduler.id_liste
		WHERE
			utenze.mail = '".authentication_get_username()."'
		AND
			scheduler.stato = 1
		ORDER BY 
			scheduler.data_invio
		";

$query_run = "	SELECT 
			ricezioni.oggetto AS oggetto, 
			DATE_FORMAT(scheduler.data_invio, '%d.%m.%Y %T') AS partenza, 
			DATE_FORMAT(scheduler.data_inizio, '%d.%m.%Y %T') AS iniziata, 
			scheduler.id AS id,
			scheduler.inviate AS inviate,
			liste.nome as lista,
			liste.id as lista_id,
			scheduler.numero as blocchi
		FROM 
			scheduler 
		JOIN 
			utenze ON utenze.id = scheduler.id_utenze
		JOIN
			ricezioni ON ricezioni.id = scheduler.id_ricezioni
		JOIN
			liste ON liste.id = scheduler.id_liste
		WHERE
			utenze.mail = '".authentication_get_username()."'
		AND
			scheduler.stato = 2
		ORDER BY 
			ricezioni.arrivata
		";

$query_end = "	SELECT 
			ricezioni.oggetto AS oggetto, 
			DATE_FORMAT(scheduler.data_invio, '%d.%m.%Y %T') AS partenza, 
			DATE_FORMAT(scheduler.data_inizio, '%d.%m.%Y %T') AS iniziata, 
			DATE_FORMAT(scheduler.data_termine, '%d.%m.%Y %T') AS termine, 
			scheduler.id AS id,
			scheduler.inviate AS inviate,
			liste.nome as lista,
			liste.id as lista_id,
			scheduler.numero as blocchi
		FROM 
			scheduler 
		JOIN 
			utenze ON utenze.id = scheduler.id_utenze
		JOIN
			ricezioni ON ricezioni.id = scheduler.id_ricezioni
		JOIN
			liste ON liste.id = scheduler.id_liste
		WHERE
			utenze.mail = '".authentication_get_username()."'
		AND
			scheduler.stato >= 10
		ORDER BY 
			ricezioni.arrivata
		";

$result_new = mysqli_query ($link_mm, $query_new);
$num_mm_new = mysqli_num_rows ($result_new);

$result_sch = mysqli_query ($link_mm, $query_sch);
$num_mm_sch = mysqli_num_rows ($result_sch);

$result_run = mysqli_query ($link_mm, $query_run);
$num_mm_run = mysqli_num_rows ($result_run);

$result_end = mysqli_query ($link_mm, $query_end);
$num_mm_end = mysqli_num_rows ($result_end);

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/utenza-mm.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
