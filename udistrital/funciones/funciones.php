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
function ingresarDatos($referencia, $ref_anyo, $identificacion, $tipo_documento, $nombres, $valor, $iva, $concepto, $serviceCode, $ref_pse){
	$sql="insert into tbl_recaudo_matriculas (referencia, ref_anyo, no_documento, tipo_documento, nombre, valor, iva, descripcion, codigo_servicio, ref_pse) values ('$referencia', '$ref_anyo', '$identificacion', '$tipo_documento', '$nombres', '$valor', '$iva', '$concepto', '$serviceCode', '$ref_pse');";
	//echo $sql;
	if (pg_query($sql)) {
        return true;
    }
    return false;
}
#############################################################################
function referenciaPagada($ref_pse) {
    $sql = "select *, extract(year from fecha_pago) AS anyo from tbl_recaudo_matriculas where ref_pse='$ref_pse' and estado='2'";
    //echo $sql;
    $query = pg_query($sql);
    if ($query) {
        $datos = pg_fetch_assoc($query);
    }
	if($datos["anyo"] == date("Y")){
		return true;
	}
    return false;
}
#############################################################################
function updatePagos($referencia){
  $sql="update tbl_recaudo_matriculas set estado='2', fecha_pago=now() where ref_pse='$referencia' ";
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
function pagoEnProceso($ref_pse){
	pg_close();
	include("conexion_pse.php");
	$sql="select * from tbl_transacciones where fecha_inicio > current_timestamp - INTERVAL '15' day and cod_empresa='0106' and referencia='$ref_pse' and estado='PENDING'";
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
##############################################################################
function getCeros($longitud,$valor){
	$numero = '';
	for($i=0;$i<$longitud-strlen($valor);$i++){
		$numero.="0";
	}
	return $numero.$valor;
}
#############################################################################
function getFicha($valor, $referencia) {
    $semilla = hash("md5", "realtech" . date("Ymd"));

	$data = $valor . $referencia . $semilla;
	$ficha_pse = hash("sha256", $data);

	return $ficha_pse;
}

#####################################################################
function get_ficha_credibanco($valor, $referencia)
{
	$data = $valor . $referencia . hash("sha256", "R3*t5-4N.Gtx9!D" . date("Ymd"));

	$ficha_credibanco = hash("sha512", $data);
	return $ficha_credibanco;
}
##################################################################################

function get_user_ip()
{
	$array = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
	foreach ($array as $key) {
		if (array_key_exists($key, $_SERVER)) {
			foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
				return $ip;
			}
		}
	}
	return '?';
}
#####################################################################
?>
