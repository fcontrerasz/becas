<?php include("../conexion/conecta.php"); 

function grab_dump($var)
{
    ob_start();
    var_dump($var);
    return ob_get_clean();
}

?>
<?php
require '../phpmailer/PHPMailerAutoload.php';
$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);

if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest"){ die("-5"); }


$arr = get_defined_vars();
//var_dump($arr);
//echo $variables[1];
//echo $variables[1];

$query = "select IDUSUARIO,IDPERFIL,USUARIO_NOMBRE,USUARIO_LOGIN from  USUARIOS where USUARIO_LOGIN = ".revisaSQL($nombre, "text")." AND USUARIO_CLAVE = ".revisaSQL($clave, "text");
//echo $database_cn_becas."|".$query;

$result = $db->query($query);
if($result->num_rows == "0"){
	die("-1");
}
if($result){
    while ($row = $result->fetch_object()){
		$_SESSION["nombre"] = $row->USUARIO_NOMBRE;
		$_SESSION["usuario"] = $row->USUARIO_LOGIN;
		$_SESSION["idusuario"] = $row->IDUSUARIO;
		$_SESSION["perfil"] = $row->IDPERFIL;
		$_SESSION['start'] = time();
		$_SESSION['clave'] = $clave;
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60 * 60) ;
		if($_SESSION["idusuario"]==75){
			$_SESSION["nombre"] = NULL;
			$_SESSION["usuario"] = NULL;
			$_SESSION["idusuario"] = NULL;
			$_SESSION["perfil"] = NULL;
			$_SESSION['start'] = NULL;
			$_SESSION['expire'] = NULL ;
			die("-2");
		}
		/*if($_SESSION["idusuario"]=="75"){
		$mensaje2 = grab_dump($row);
		$email = new PHPMailer();
		$email->IsHTML(true); 
		$email->CharSet = 'UTF-8';
		$email->From      = 'autonomo@oticdelaconstruccion.cl';
		$email->FromName  = 'Login - Postulacion de Estudios';
		$email->Subject   = 'Te pillamos po compadre';
		$email->Body      = $mensaje2;
		$email->AddAddress( 'fcontrerasz@gmail.com' );
			if(!$email->send()) {
			    echo '<script>console.log("Mensaje Error: ' . $email->ErrorInfo.'");</script>';
			} else {
			    echo '<script>console.log("Mensaje: Enviado");</script>';
			}
		}*/

		/*$data = $mensaje2.PHP_EOL;
		$fp = fopen('logs_ingresos.txt', 'a');
		fwrite($fp, $data);*/

    }
     $result->close();
     $db->next_result();
}
else echo($db->error);
echo "1";
$db->close();

?>