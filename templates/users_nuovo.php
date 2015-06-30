<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div id="main_menu">
<table border=0>
	<tr>
		<td colspan=2>
		Gentile cliente <b>benvenuto nel nuovo servizio webmail</b>.<br>
		Tante novita' per agevolarti nella quotidianita', con l'utilizzo di servizi Cloud.
		</td>
	</tr>

	<tr>
		<td nowrap colspan=2>
		- <b>Rubrica</b>, <b>Agenda</b>, e <b>Attivita'</b> sincronizzabili con  PC e dispositivi mobili;<br>
		- Comodita' nell'accedere ai servizi di Spazio Web tramite un <b>unico punto di accesso</b>;<br>
		- <b>File</b> e <b>documenti</b> sempre disponibili;<br>
		- <b>Allegati</b>: sistema per la gestione dei file, soprattutto se di grandi dimensioni, da allegare alle proprie mail.<br>
		</td>
	</tr>

<?php	if ($_SESSION['sessid']['nuovo'] == 'nuovo') { ?>
	<tr><td nowrap colspan=2><br></td></tr>

	<tr>
		<td nowrap colspan=2>
		<u><b>Prima di proseguire e' necessario accedere al sistema cloud</u></b> in modo da prepararlo ad ospitare i vostri dati.<br>
		<b>Se non si effettua' questa operazione non sara' possibile utilizzare la rubrica e il calendario.</b><br>
		<b>L'operazione durera' solo pochi secondi e non sara' necessario ripeterla.</b><br>
		</td>
	</tr>

	<tr>
		<td nowrap colspan=2><br></td>
	</tr>

	<tr>
		<td nowrap><a style="font-size: 17px; color: #0089c3" target="_cloud" href="ext/cloud.php"><b>Cloud</b></a></td>
		<td>Effettuare l'accesso al servizio; dopo alcuni secondi di attesa si aprira' una nuova pagina all'interno del cloud, operazione necessaria all'attivazione.
		<br>Una volta entrato potrai decidere se cominciare subito ad usare il nuovo servizio caricando documenti, oppure chiuderlo (in alto a destra dove compare il tuo indirizzo di posta) e accedere al pannello servizi selezionando il tasto prosegui che comparira' in seguito.</td>
	</tr>
<?	} ?>

<?php	if ($_SESSION['sessid']['nuovo'] == 'attivo') { ?>
	<tr><td nowrap colspan=2><br></td></tr>
	<tr>
		<td nowrap><a style="font-size: 17px; color: #0089c3" target="_top" href="main.php">Prosegui</a></td>
		<td>Accedi ai nuovi servizi dopo l'attivazione del servizio cloud</td>
	</tr>
<?	} ?>
</table>
</div>
