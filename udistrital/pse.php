
<? session_start();

require_once('funciones/conexion.php');
include_once('funciones/funciones.php');

$ip = get_user_ip();

	$referencia = $_POST["referencia"];
	$identificacion = $_POST["documento"];
  $tipo_documento = $_POST["tipo_documento"];
  $nombres = $_SESSION["nombre"]=$_POST["nombre"];
  $valor = $_POST["valor"];
  $cod_empresa = $_SESSION["cod_empresa"] ?? '0106';
  $serviceCode = $_SESSION["serviceCode"] = $_POST["codigo_servicio"];
  $iva = $_POST["iva"];

  // datos adicionales
  $mod = 0;
  $_fecha = new DateTime();
  $ticket = $serviceCode . $_fecha->getTimestamp();
  $nit = '8999992307';
  $razon_social = 'Universidad Distrital Francisco Jose de Caldas';
  $url = 'http://www.udistrital.edu.co/';
  $sitio = 'UDistrtital';
  $url_retorno = '-';

	if(!empty($_POST["ano_referencia"]))
		$ref_anyo = $_POST["ano_referencia"];
	else
		$ref_anyo = date("Y");

	if($_POST["concepto"]=='' || $_POST["concepto"]==NULL)
		$concepto = "Pago en Linea";
	else
		$concepto = $_POST["concepto"];

$ref_pse = getCeros(10,$referencia);
$ref_pse = $ref_anyo.$ref_pse;

$ficha = getFicha(str_replace('.00','',$valor),$ref_pse);
$complemento_ficha = get_ficha_credibanco(str_replace('.00','',$valor), $ref_pse);

if($identificacion){ // valida que la identificacion no se encuentre vacia
if (referenciaPagada($ref_pse)){
	$cus=pagoEnProceso($ref_pse);
?>
<table width="500" height="156" border="0" align="center" cellpadding="0" cellspacing="3"  class="tablaPrincipal cuadro_plano">
  <tr>
    <td height="127" colspan="2" align="center">PAGO EN LINEA</td>
  </tr>
  <tr>
    <td height="20" colspan="2" valign="top" align="center">En este momento su <?=$ref_pse?>
    ha finalizado su proceso de pago y cuya transacci&oacute;n se encuentra APROBADA en su
    entidad finaciera. Si desea mayor informacion sobre el estado de su operaci&oacute;n puede
   comunicase a nuestra l&iacute;nea de atenci&oacute;n al cliente 57-1-3904070 o envir un correo
   electronico a soporte@realtechltda.com y preguntar por el estado de la transacci&oacute;n:
   <?=$cus["cus"]?></td>
  </tr>
</table>
<? }else if(pagoEnProceso($ref_pse)){
	$cus=pagoEnProceso($ref_pse);?>
<table width="500" height="152" border="0" align="center" cellpadding="0" cellspacing="3"  class="tablaPrincipal cuadro_plano">
  <tr>
    <td height="123" colspan="2" align="center">PAGO EN LINEA</td>
  </tr>
  <tr>
    <td height="20" colspan="2" valign="top" align="justify">
    En este momento la referencia <?=$ref_pse?> presenta un proceso de pago cuya transacci&oacute;n se encuentra PENDIENTE de recibir confirmaci&oacute;n por parte de su entidad financiera, por favor espere unos minutos y vuelva a consultar mas tarde para verificar si su pago fue confirmado de forma exitosa.

Si desea mayor informaci&oacute;n sobre el estado actual de su operaci&oacute;n puede comunicarse a nuestras l&iacute;neas de atenci&oacute;n al cliente al tel&eacute;fono 57-1-3904070 o enviar sus inquietudes al correo soporte@realtechltda.com y pregunte por el estado de la transacci&oacute;n: con el codigo <?=$cus["cus"]?></td>
  </tr>
</table>
 <? }else{ ?>
<table width="400"  border="1" align="center" cellpadding="1" cellspacing="0" class="tablaContenido cuadro_plano" style="">
  <tr>
    <td colspan="2" align="center" style="background-color:#23B0BE">PAGO EN LINEA</td>
  </tr>
  <tr>
    <td width="206" align="left">REFERENCIA PAGO </td>
    <td width="180" align="left"><?=$ref_pse?></td>
  </tr>
  <tr>
    <td align="left" nowrap="nowrap">NOMBRE O RAZON SOCIAL </td>
    <td align="left"><?=$nombre?></td>
  </tr>
  <tr>
    <td align="left">NIT &oacute; C.C</td>
    <td align="left"><?=$identificacion?></td>
  </tr>
  <tr>
    <td align="left">CONCEPTO</td>
    <td align="left"><? echo $concepto;?></td>
  </tr>
  <tr>
    <td align="left">IVA</td>
    <td align="left"><?=number_format($iva,2,',','.')?></td>
  </tr>
  <tr>
    <td align="left">TOTAL A PAGAR </td>
    <td align="left"><?=number_format($valor,2,',','.')?></td>
  </tr>
  <?
   // if(count($recibo)<1)
	$valida = ingresarDatos($referencia, $ref_anyo, $identificacion, $tipo_documento, $nombres, $valor, $iva, $concepto, $serviceCode, $ref_pse);
	?>
  <? if(!referenciaPagada($ref_pse) && $valida){?>
  <tr>
    <td colspan="2" align="center" height="100">

    <form id="frm_transaccion" method="post" action="https://www.abcpagos.com/PSE/paymentProcessor">
      <input type="hidden" name="mod"					value="<?php echo $mod; ?>" />
      <input type="hidden" name="ref"					value="<?php echo $ref_pse; ?>"/>
      <input type="hidden" name="referencia"			value="<?php echo $ref_pse; ?>" />
      <input type='hidden' name='ticket'				value="<?php echo $ticket; ?>">
      <input type='hidden' name='amount'				value="<?php echo str_replace('.00','',$valor); ?>" />
      <input type='hidden' name='vatAmount'			value="<?php echo $iva; ?>" />
      <input type='hidden' name='cod_empresa'			value="<?php echo $cod_empresa; ?>" />
      <input type='hidden' name='nit'					value="<?php echo $nit; ?>" />
      <input type='hidden' name='razonSocial'			value="<?php echo $razon_social; ?>">
      <input type='hidden' name='serviceCode'			value="<?php echo $serviceCode; ?>" />
      <input type="hidden" name="url"					value="<?php echo $url; ?>">
      <input type="hidden" name="sitio"				value="<?php echo $sitio; ?>">
      <input type='hidden' name='paymentDescription'  value="<?php echo $concepto; ?>">
      <input type="hidden" name="reference" 		   	value="<?php echo $ref_pse; ?>" />
      <input type='hidden' name='reference1' 		   	value="<?php echo $ip; ?>" />
      <input type='hidden' name='reference2' 		   	value="<?php echo $tipo_documento; ?>" />
      <input type='hidden' name='reference3' 		   	value="<?php echo $identificacion; ?>" />
      <input type='hidden' name='url_retorno' 	   	value="<?php echo $url_retorno; ?>" />
      <input type='hidden' name='ficha' 			  	value="<?php echo $ficha; ?>" />
      <input type='hidden' name="complemento_ficha" 	value="<?php echo $complemento_ficha; ?>" />
      <input type='hidden' name="nombre"  			value="<?php echo $nombres; ?>" />
      <input type='hidden' name="franquicia" id="franquicia" value="0">
      <input type='hidden' name="cuenta" 				value="C">
    </form>
	<img src="./imagenes/BotonPSE.jpg" width="89" height="81" style="cursor:pointer;" onClick="btn_pse();" /><div class="pse">!Pagar Ahora!</div></td>
  <script>
    function btn_pse()
    {
      document.getElementById("frm_transaccion").action = "https://www.abcpagos.com/PSE/paymentProcessor";
      document.getElementById("frm_transaccion").submit();
    }
  </script>
  </tr>
  <? } ?>
  </table>
<? }
} else {?>
<table width="500" height="156" border="0" align="center" cellpadding="0" cellspacing="3"  class="tablaPrincipal cuadro_plano">
  <tr>
    <td align="center">No se puede realizar el pago ya que falta el numero de identificacion.</td>
  </tr>
</table>
<? } ?>

<br /><br />
<table align="center">
  <tr><td colspan="2" align="center" height="35">&nbsp;<input name="Volver" value="Volver" type="button" onclick="history.back(1)" class="boton" /></td></tr>
</table>