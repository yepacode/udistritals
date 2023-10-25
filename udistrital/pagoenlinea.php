<?  session_start();
include("./funciones/conexion.php");
require(  "./funciones/funciones.php");


$empresa=$_POST["cod_empresa"];
$fecha = new DateTime();
$_SESSION["ticket"]= $empresa . $fecha->getTimestamp();
$_SESSION["total"]=str_replace('.00','',$_POST["amount"]);
$_SESSION["iva"]=$_POST["vatAmount"];
$_SESSION["concepto"]=str_replace(" ","_",$_POST["paymentDescription"]);
$_SESSION["referencia"]=$_POST["referencia"];
$_SESSION["identificacion"]=$_POST["reference3"];
$_SESSION["referencia1"]=str_replace(" ","_",$_POST["reference1"]);
$_SESSION["empresa"]=$_POST["cod_empresa"];
$_SESSION["tipo_documento"]=$_POST["reference2"];
$_SESSION["ficha"] =  $ficha=getFicha($_SESSION["total"],$_POST["referencia"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/estilos.css" rel="stylesheet" type="text/css">
</head>
<body >
<table border="0" align="left" width="550" height="380" cellspacing="0" cellpadding="0" class="pagoenlinea">
    <tr>
      <td height="8" align="center" valign="top">
        <iframe src="proccess.php" scrolling="auto"  frameborder="0" width="650"  height="1200" ></iframe>
      </td>
    </tr>
</table>
</body>
</html>
