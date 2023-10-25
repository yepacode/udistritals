<?php 
session_start();
include_once("../../funciones/conexion.php");
include_once("../../funciones/funciones.php");
$msg="";
?>
<STYLE> 
.Estilo2 {
	font-size: 24px;
	color:#000055;
}
.Estilo1 {color: #000055}
.titulo{
color: #333333;
font: 15px Arial,Helvetica,sans-serif;
}
.botones {
  background-color: #D1B807;
  border: 1px solid #000055;
  color: #FFFFFF;
  cursor: pointer;
  font-size: 16px;
  margin-bottom: 25px;
  padding: 5px 10px;
}
.cajas{
    border: 1px solid #CCCCCC;
    color: #333333;
    font-size: 14px;
    padding: 5px 10px;
    width: 250px;
}
.title_input{
font-size : 11pt; 
font-family:Arial, Gadget, sans-serif;
font-weight :bold; 
}
.mensaje{
    color: #333333; 
	font: 14px Arial,Helvetica,sans-serif;
	margin: 0 auto;
	padding: 10px 0 0;
	position: relative;
	width: 790px;"	
}
.adorno{
background:#F5F5F5;
border: 1px solid #CCCCCC;
color: #333333;
font-size: 17px;
font-weight: normal;padding: 7px;
text-transform: uppercase;
}
</STYLE>
<table width="500" border="0" cellPadding="0" cellSpacing="0" align="center">
  <tr>
	<td width="450" height="40" align="left" style="font-size:30px;
    font: 40px/44px "Trebuchet MS",Helvetica,Jamrul,sans-serif;
letter-spacing: -1px;margin-bottom: 5px;">Pagos recibidos:    </td>
	<tr>
	<td height="25" align="center">&nbsp;</td>
  </tr>
  </tr>
  <tr bgcolor="#000055">
	<td height="1" align="left"></td>
  </tr>
   <tr>
    <td style="background:#F5F5F5;font-size: 15px;font-weight: normal;padding: 7px;text-transform: uppercase;" height="20" align="left">
    Fechas para el reporte. </td>
  </tr>
  <tr>
     <td>&nbsp;
         
     </td>
  </tr>
      <tr>
	<td height="4" class="title_input" align="left">Fecha Inicio:</td>
  </tr>
    <tr>
      <td height="10" align="left">
	  <input class="cajas" style="width:100px; height:25" name="fechaini" id="fechaini" onFocus='Calendar.setup({inputField:"fechaini",ifFormat:"%Y-%m-%d",button:"calen"});'
 /></td>
    </tr>
      <tr>
	<td height="24" class="title_input" align="left">Fecha Fin:</td>
  </tr>
    <tr>
      <td height="10" align="left">
	  <input class="cajas" style="width:100px; height:25" name="fechafin" id="fechafin" 
	  onFocus='Calendar.setup({inputField:"fechafin",ifFormat:"%Y-%m-%d",button:"calen"});'/>
	  </td>
    </tr>
	<tr>
     <td>&nbsp;
         
     </td>
  <tr>
    <th align="left">
	<input type="button" name="generar" value="Generar"  onClick="FAjax('pages/reporte.php','principal','','POST')">
	</th>
  </tr>
	<tr>
     <td>
     </td>
    </tr>
	 
 </tr></table>