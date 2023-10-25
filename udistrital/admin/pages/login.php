<?
session_start();
session_destroy();
session_start();

if ($_POST["ingresar"] != '') {
    require_once("../../funciones/conexion.php");
    require_once("../../funciones/funciones.php");

    if ($acceso = validarUsuarioAdmim($_POST["usuario"], $_POST["clave"])) {
		$_SESSION["ses_id"] = $acceso["identificacion"];
	    ?>
		<script language="javascript">
		FAjax('pages/contenido.php','contenido','','post');
		</script>
		<?
    } else {
        $msg = "Usuario o clave incorrectos";
    }
}
?><table width="400" border="0" align="center"><tr>
        <td  height="91"  align="center" class="titulo">&nbsp;</td>
    </tr>
    <tr>
        <td  height="198"  align="center" >
            <?=$msg?>
            <table width="360" border="0" align="center" class="cajaGris">
                <tr>
                    <th colspan="2" align="center">ACCESO SEGURO</th>
                </tr>
                <tr>
                    <td width="157" height="34" align="right">Identificaci&oacute;n:</td>
                    <td width="193" valign="bottom"><label>
                            <input type="text" name="usuario" />
                        </label></td>
                </tr>
                <tr>
                    <td height="49" align="right">Contrase&ntilde;a:</td>
                    <td><input type="password" name="clave" /></td>
                </tr>
                <tr>
                    <td height="40" colspan="2" align="right">
                    	<input type="button" name="ingresar" value="INGRESAR" onClick="FAjax('pages/login.php','contenido','','post')" /></td>
                </tr>
            </table></td>
    </tr>
</table>
