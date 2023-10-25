<? session_start();
require_once("../../funciones/conexion.php");
require_once("../../funciones/funciones.php");
$usuario=getDatosUsuarioId($_SESSION["ses_id"]);

?>
<table border="0" cellspacing="1" cellpadding="1" id="menu">
  <tr>
    <td height="45">Usuario:<br /><strong><?=$usuario["nombre"]?></strong><br />
    </td>
  </tr>
  <tr>
    <td class="item" onClick="FAjax('pages/informe_pag.php','principal','','post')">Informe Pago</td>
  </tr>
  <tr>
    <td class="item" onClick="FAjax('pages/cambiar_clave.php','principal','','post')">Cambiar Contrase&ntilde;a</td>
  </tr>
  <tr>
    <td class="item" onClick="window.location='index.php'">Salir</td>
  </tr>
  <tr>
    <td height="300">&nbsp;</td>
  </tr>
</table>

