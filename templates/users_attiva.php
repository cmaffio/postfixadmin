<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); 

db_connect();
$result = db_query ("SELECT TIMESTAMPDIFF(DAY,datainvio, NOW()) FROM postfixuba WHERE BINARY codattivazione = '".$_GET['codice']."'");

$data = 9999;
if ($result['rows'] == 1) {
	$row = db_row ($result['result']);
        $data = $row[0];
}
?>
<div id="main_menu">
<table border=0>
<?php
if ($data < 14) { ?>

	<form id="attiva" method="POST" >
	<input type="hidden" name="codice" value="<?php echo $_GET['codice'] ?>">
	<tr>
		<td colspan=3 align="left">
			BLA BLA BLA BLA<br>
			Ancora BLA BLA BLA
		</td>
	</tr>

	<tr>
		<td align="left">indirizzo di posta</td>
		<td>&nbsp;</td>
		<td><input type="text" name="valore" size="15">@utenti.esseweb.eu</td>
	</tr>
	<tr>
		<td align="left">password</td>
		<td>&nbsp;</td>
		<td><input type="text" name="pwd1" size="30"></td>
	</tr>
	<tr>
		<td align="left">verifica</td>
		<td>&nbsp;</td>
		<td><input type="text" name="pwd2" size="30"></td>
	</tr>
	<tr>
		<td align="left">Codice fiscale o partita iva</td>
		<td>&nbsp;</td>
		<td><input type="text" name="verifica" size="20"></td>
	</tr>




	</form>


<?php
} else { ?>
	<tr>
		<td colspan=3>
			Codice non trovato o scaduto
		</td>
	</tr>
<?php
} ?>

</table>
</div>
