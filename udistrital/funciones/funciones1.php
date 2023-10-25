<?
//ini_set("display_errors","off");
#############################################################################
function validarUsuarioAdmim($user, $clave){
	$sql="Select * from tbl_usuario where identificacion = '$user'";
	$query=pg_query($sql);
	$result=pg_fetch_array($query);
	if($result['clave'] == $clave){
		return $result;
	}
	return false;
}
#############################################################################
function getDatosUsuarioId($user){
	$sql="Select * from tbl_usuario where identificacion = '$user'";
	//echo $sql;
	$query=pg_query($sql);
	$result=pg_fetch_array($query);
	if($result)
		return $result;
}
#############################################################################
function cambiarClaveAdmin($actual,$nueva,$usuario){
	$sql="select clave from tbl_usuario where identificacion='$usuario'";
	//echo $sql;
	$query = pg_query($sql);
	$result=pg_fetch_array($query);
	if($result['clave'] == $actual){
		$sql="Update tbl_usuario Set clave='$nueva' where identificacion='$usuario'";
		//echo '<br>'.$sql;
		$querty=pg_query($sql);
		if($querty)
			return true;
	}
	else
		return false;
}
#############################################################################
function ingresarDatos($referencia, $identificacion, $tipo_documento, $nombres, $valor, $iva, $concepto, $serviceCode){
	$sql="insert into tbl_recaudo_matriculas (referencia, no_documento, tipo_documento, nombre, valor, iva, descripcion, codigo_servicio) values ('$referencia', '$identificacion', '$tipo_documento', '$nombres', '$valor', '$iva', '$concepto', '$serviceCode');";
	//echo $sql;
	if (pg_query($sql)) {
        return true;
    }
    return false;
}
#############################################################################
function referenciaPagada($referencia) {
    $sql = "select * from tbl_recaudo_matriculas where referencia='$referencia' and estado='2'";
    //echo $sql;
    $query = pg_query($sql);
    if ($query && $array = pg_fetch_assoc($query)) {
        return true;
    }
    return false;
}
#############################################################################
function updatePagos($referencia){
  $sql="update tbl_recaudo_matriculas set estado='2', fecha_pago=now() where referencia='$referencia' ";
  //echo $sql;
  $query=pg_query($sql);
}
#############################################################################
function getDatosComun($referencia){
	$sql="select * from tbl_recaudo_matriculas where referencia='$referencia';";
	//echo $sql;
	$query=pg_query($sql);
	$result=pg_fetch_array($query);
	if($result)
		return $result;
}
##############################################################################
function pagoEnProceso($referencia){
	pg_close();
	include("conexion_pse.php");
	$sql="select * from tbl_transacciones where fecha_inicio > current_timestamp - INTERVAL '15' day and cod_empresa='0106' and referencia='$referencia' and estado='PENDING'";
	//echo $sql;
	$q=pg_query($sql);
	if($q){
		$datos=pg_fetch_assoc($q);
	}
	pg_close();
	include("conexion.php");
	return $datos;
}
#############################################################################
function getPagosPse($fechaini, $fechafin){
	pg_close();
	include("conexion_pse.php");
	$sql="select * from tbl_transacciones where cod_empresa='0106' and estado='OK' and fecha_fin BETWEEN CAST('$fechaini' AS TIMESTAMP) and CAST('$fechafin' AS TIMESTAMP) + CAST('1 days' AS INTERVAL) order by fecha_fin desc";
	//echo '<br>generados: '.$sql;
	$query = pg_query($sql);
	while($array=pg_fetch_array($query))
		$datos[]=$array;
	pg_close();
	include("conexion.php");
	return $datos;
}
#############################################################################

?>
