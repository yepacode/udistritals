<?
session_start();
include_once("../../funciones/conexion.php");
include_once("../../funciones/funciones.php");
$msg="";

if($_REQUEST["descargar"]==1){
   header('Content-Description: File Transfer');
   header("Content-type: application/vnd.ms-excel");
   header("Content-Disposition: attachment; filename=informe_pagos.xls");
   header("Pragma: no-cache");
   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
   header("Expires: 0");
   header('Pragma: public');
}else{
	?>
	<a href="pages/reporte.php?generar=1&fechaini=<?=$_REQUEST["fechaini"]?>&fechafin=<?=$_REQUEST["fechafin"]?>&descargar=1" >Descargar Tabla Excel</a><br />
	<?
}
if($_REQUEST['generar'] && $_REQUEST['fechaini'] && $_REQUEST['fechafin']){
$pse=getPagosPse($_REQUEST['fechaini'], $_REQUEST['fechafin']);
//print_r($pse);
?>
<table border="1" align="center" cellPadding="1" cellSpacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="18">&nbsp;</th>
    <th>Banco</th>
	<th>Cus</th>
	<th>Descripcion</th>
	<th>Estado</th>
	<th>Fecha Inicio </th>
	<th>Fecha Fin </th>
    <th>Identificacion</th>
	<th>Referencia</th>
    <th>Valor</th>
    <th>Sucursal</th>
    <th>Ciclo</th>
  </tr>
<?
	for($i=0;$i<count($pse);$i++){
		$detalle=getDatosComun($pse[$i]['referencia']);
?>
  <tr>
    <td align="center" valign="middle"><?=$i+1;?></td>
    <td><?=$pse[$i]['banco']?></td>
    <td><?=$pse[$i]['cus']?></td>
    <td><?=$pse[$i]['descripcion']?></td>
	<td><?=$pse[$i]['estado']?></td>
	<td><?=substr($pse[$i]['fecha_inicio'],0,-2)?></td>
	<td><?=substr($pse[$i]['fecha_fin'],0,-2)?></td>
	<td><?=$detalle['no_documento']?></td>
    <td><?=$pse[$i]['referencia']?></td>
	<td align="right">$<?=number_format($pse[$i]['valor'],0,',',',')?></td>
    <td>0</td>
    <td><?=$pse[$i]['ciclo']?></td>
  </tr>
<? } ?>
</table>
 <tr>
   <td height="6" align="center">&nbsp;<?=$msg?></td>
</tr>

<?
} else {
echo "Escoja el rango de fechas para el informe...";
}
?>