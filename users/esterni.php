<?php
require_once('../common.php');
authentication_require_role('user');

include ("../templates/header.php");
include ("../templates/users_menu.php");

?>
<div id="main_menu">
<table>
   <tr>
      <td nowrap><a target="_allegati" href="ext/allegati.php">Allegati</a></td>
      <td>Come inviare file di grandi dimensioni od eseguibili senza che siano allegati alla mail.</td>
   </tr>
   <tr>
      <td nowrap><a target="_cloud" href="ext/cloud.php">Cloud</a></td>
      <td>Piattaforma per la sincronizzazione di rubrica, agenda e file (<a href="https://cloud.esseweb.eu/public.php?service=files&t=0fb2e9c461cff8377a269a7ab9065584&download&path=//Owncloud.pdf">Documentazione</a>&nbsp;&nbsp;)</td>
   </tr>

</table>
</div>

<?php
include ("../templates/footer.php");
?>
