<?php
require_once('admin/common.php');
authentication_require_role('user');

include ("templates/header.php");
include ("templates/users_menu.php");
?>
<div id="main_menu">
<table>

   <tr>
      <td nowrap><a href="https://cloud.esseweb.eu/public.php?service=files&t=0fb2e9c461cff8377a269a7ab9065584&download&path=//Webmail.pdf">Webmail</a></td>
      <td>Semplice guida sull'utilizzo della WebMail</td>
   </tr>
   <tr>
      <td nowrap><a href="https://cloud.esseweb.eu/public.php?service=files&t=0fb2e9c461cff8377a269a7ab9065584&download&path=//Owncloud.pdf">OwnCloud</a></td>
      <td>Documentazione Cloud.</td>
   </tr>
   <tr>
      <td nowrap><a href="https://cloud.esseweb.eu/public.php?service=files&t=0fb2e9c461cff8377a269a7ab9065584&download&path=//ExportContactSquirrelmail.pdf">Trasferimento rubrica</a></td>
      <td>Documentazione su come effettuare lo spostamento della propria rubrica dalla vecchia webmail (squirrelmail) al nuovo sistema cloud</td>
   </tr>
   <tr>
      <td nowrap><a href="https://cloud.esseweb.eu/public.php?service=files&t=0fb2e9c461cff8377a269a7ab9065584&download&path=//Sincronizzazione%20dispositivi.pdf">Sincronizzazione dispositivi</a></td>
      <td>Veloce guida per configurare i propri dispositivi (PC, tablet, smatphone) in modo da mantenere sincronizzati rubrica e agenda con il cloud</td>
   </tr>

</table>
</div>

<?php
include ("templates/footer.php");
?>
