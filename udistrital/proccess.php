<? session_start() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>.:: UDistrital ::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="JavaScript:document.form.submit();">


Procesando informacion.....
<form  name="form" action="https://www.abcpagos.com/PSE5/faces/index.xhtml" method="post">
    <input type='hidden' name='ticket' value="<? echo $_SESSION["ticket"]; ?>">
    <input type='hidden' name='amount' value="<? echo $_SESSION["total"]; ?>">
    <input type='hidden' name='vatAmount' value="<? echo $_SESSION["iva"]; ?>">
    <input type="hidden" name="cod_empresa" value="<? echo $_SESSION["empresa"]; ?>">
    <input type='hidden' name='serviceCode' value="25">
    <input type='hidden' name='nit' value="8999992307">
    <input type='hidden' name='razonSocial' value="Universidad Distrital Francisco Jose de Caldas">
    <input type="hidden" name="url" value="http://www.udistrital.edu.co/">
    <input type="hidden" name="sitio" value="UDistrtital">
    <input type='hidden' name='paymentDescription' value="<? echo $_SESSION["concepto"]; ?>">
    <input type='hidden' name='reference' value="<? echo $_SESSION['referencia']; ?>">
    <input type='hidden' name='reference1' value="<? echo $_SERVER['REMOTE_ADDR']; ?>">
    <input type='hidden' name='reference2' value="<? echo $_SESSION["tipo_documento"]; ?>">
    <input type='hidden' name='reference3' value="<? echo $_SESSION["identificacion"]; ?>">
    <input type='hidden' name='nombre' value="<? echo $_SESSION["nombre"]; ?>">
    <input type='hidden' name="ficha" value="<?=$_SESSION['ficha'];?>" />
</form>
</body>
</html>
