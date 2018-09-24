<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php
require 'phpmailer/PHPMailerAutoload.php';

function ex($tipo){
$extension = "";
switch($tipo)
{
    case 'image/gif'    : $extension = 'gif';   break;
    case 'image/png'    : $extension = 'png';   break;
    case 'image/jpeg'   : $extension = 'jpg';   break;
    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   : $extension = 'docx';   break;
    case 'application/msword'    : $extension = 'doc';   break;
    case 'image/tiff'    : $extension = 'tif';   break;
    case 'application/pdf'   : $extension = 'pdf';   break;
    default : $extension = 'txt'; break;
}
return $extension;
}

$query = "SELECT * from listar_postulaciones_vivienda where IDPOSTULACION = ".revisaSQL($_GET["id"], "int");
$result = $db->query($query);

if($result->num_rows == "0"){
	die("-1");
}
//echo $result->num_rows;

if($result->num_rows>0){
	$row = $result->fetch_object();
	$g[] = $row;
}else{ echo "|0"; }
$result->close();
$db->next_result();
$db->close();

$email = new PHPMailer();
//$mail->SMTPDebug = 3;   

$message = file_get_contents('mailvivienda.html');
$message = str_replace('[ticket]', '12015'.$g[0]->RUT_TRABAJADOR, $message);
$message = str_replace('[nombre]', $g[0]->NOMBRE_TRABAJADOR.'_'.$g[0]->PATERNO_TRABAJADOR.'_'.$g[0]->MATERNO_TRABAJADOR, $message);
$message = str_replace('[beca]', 'ESTUDIOS', $message);
$message = str_replace('[fecha]', $g[0]->FECHA_POSTULACION, $message);
$message = str_replace('[rut]', $g[0]->RUT_TRABAJADOR.'-'.$g[0]->DV_TRABAJADOR, $message);
$message = str_replace('[nombrecompleto]', $g[0]->NOMBRE_TRABAJADOR.' '.$g[0]->PATERNO_TRABAJADOR.' '.$g[0]->MATERNO_TRABAJADOR, $message);
$message = str_replace('[nacimiento]', $g[0]->FECHA_NACIMIENTO, $message);
$message = str_replace('[correo]', $g[0]->CORREO_TRABAJADOR, $message);
$message = str_replace('[sexo]', $g[0]->SEXO, $message);
$message = str_replace('[fonofijo]', $g[0]->FONO_TRABAJADOR, $message);
$message = str_replace('[celular]', $g[0]->CELU_TRABAJADOR, $message);
$message = str_replace('[region]', $g[0]->REGION_NOMBRE, $message);
$message = str_replace('[comuna]', $g[0]->COMUNA_NOMBRE, $message);
$message = str_replace('[direccion]', $g[0]->DIRECCION.' #'.$g[0]->NUM_DIRECCION.' '.$g[0]->DEPTO_DIRECCION.' ('.$g[0]->VILLA_DIRECCION.')', $message);
$message = str_replace('[integrantes]', $g[0]->INTEGRANTES, $message);
$renta = number_format($g[0]->RENTA_TRABAJADOR,0,',','.');
$message = str_replace('[renta]','$'.$renta , $message);
$message = str_replace('[estadocivil]', $g[0]->ESTADO_CIVIL, $message);

$message = str_replace('[rutempresa]', $g[0]->RUT_EMPRESA.'-'.$g[0]->DV_EMPRESA, $message);
$message = str_replace('[tipoempresa]', $g[0]->TIPO_EMPRESA, $message);
$message = str_replace('[razon]', $g[0]->RAZONSOCIAL, $message);
$message = str_replace('[contrato]', $g[0]->CONTRATO, $message);
$message = str_replace('[fechatermino]', $g[0]->FECHA_CONTRATO, $message);
$message = str_replace('[division]', $g[0]->DIVISION, $message);
$message = str_replace('[correoempresa]', $g[0]->CORREO_EMPRESA, $message);
$message = str_replace('[fonoempresa]', $g[0]->FONO_EMPRESA, $message);

$message = str_replace('[destino]', $g[0]->DESTINO_FONDO, $message);

$message = str_replace('[viviendadireccion]', $g[0]->VIVIENDA_DIRECCION." #".$g[0]->VIVIENDA_NUMERO.",".$g[0]->VIVIENDA_DEPTO." ".$g[0]->VIVIENDA_VILLA, $message);
$message = str_replace('[viviendaregion]', $g[0]->REGION_NOMBRE, $message);
$message = str_replace('[viviendacomuna]', $g[0]->COMUNA_NOMBRE, $message);

$message = str_replace('[acepta]', ($g[0]->ACEPTA_VIVIENDA=="1")?"Aceptada":"Rechazada", $message);

$message = str_replace('[archivocontrato]', (($g[0]->ARCHIVO_CONTRATO === NULL))?'--SIN ARCHIVO--':'ADJUNTO', $message);
$message = str_replace('[archivoliq1]', (($g[0]->ARCHIVO_LIQ1 === NULL) || ($g[0]->ARCHIVO_LIQ1 == ""))?'--SIN ARCHIVO--':'ADJUNTO', $message);
$message = str_replace('[archivoliq2]', (($g[0]->ARCHIVO_LIQ2 === NULL) || ($g[0]->ARCHIVO_LIQ2 == ""))?'--SIN ARCHIVO--':'ADJUNTO', $message);
$message = str_replace('[archivoliq3]', (($g[0]->ARCHIVO_LIQ3 === NULL) || ($g[0]->ARCHIVO_LIQ3 == ""))?'--SIN ARCHIVO--':'ADJUNTO', $message);
$message = str_replace('[declaracion]', (($g[0]->ARCHIVO_DECLARACION === NULL) || ($g[0]->ARCHIVO_DECLARACION == ""))?'--SIN ARCHIVO--':'ADJUNTO', $message);

$message = str_replace('[compraventa]', (($g[0]->ARCHIVO_PROMESA === NULL) || ($g[0]->ARCHIVO_PROMESA == ""))?'--SIN ARCHIVO--':'ADJUNTO', $message);
$message = str_replace('[certvigente]', (($g[0]->ARCHIVO_PROPIEDAD === NULL) || ($g[0]->ARCHIVO_PROPIEDAD == ""))?'--SIN ARCHIVO--':'ADJUNTO', $message);
$message = str_replace('[certdeuda]', (($g[0]->ARCHIVO_DEUDA === NULL) || ($g[0]->ARCHIVO_DEUDA == ""))?'--SIN ARCHIVO--':'ADJUNTO', $message);


//var_dump($g[0]);

//$message = str_replace('%password%', $password, $message);
$email->IsHTML(true); 
$email->CharSet = 'UTF-8';
$email->From      = 'soporte@studianet.cl';
$email->FromName  = 'Becas Codelco - Postulacion de Vivienda';
$email->Subject   = 'Confirmacion de Postulacion #'.'12015'.$g[0]->RUT_TRABAJADOR;
$email->Body      = $message;
//$email->AddAddress( 'fcontrerasz@gmail.com' );
$email->AddAddress( $g[0]->CORREO_TRABAJADOR );
/*
$file_to_attach = 'tmp/demo.txt';
$email->AddAttachment( $file_to_attach , 'demo.txt' );
*/

if (!($g[0]->ARCHIVO_CONTRATO  == "")){
$archivo = $g[0]->ARCHIVO_CONTRATO;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_CONTRATO.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_LIQ1  == "")){
$archivo = $g[0]->ARCHIVO_LIQ1;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_LIQ1.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_LIQ2  == "")){
$archivo = $g[0]->ARCHIVO_LIQ2;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_LIQ2.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_LIQ3  == "")){
$archivo = $g[0]->ARCHIVO_LIQ3;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_LIQ3.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_PROMESA  == "")){
$archivo = $g[0]->ARCHIVO_PROMESA;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_PROMESA.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_PROPIEDAD  == "")){
$archivo = $g[0]->ARCHIVO_PROPIEDAD;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_PROPIEDAD.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_DEUDA  == "")){
$archivo = $g[0]->ARCHIVO_DEUDA;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_DEUDA.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_DECLARACION  == "")){
$archivo = $g[0]->ARCHIVO_DECLARACION;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_DECLARACION.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}


if(!$email->send()) {
    echo '|Mensaje Error: ' . $email->ErrorInfo;
} else {
    echo '|Mensaje Enviado';
}
/*
$msg = "First line of text\nSecond line of text";
$msg = wordwrap($msg,70);
mail("fcontrerasz@gmail.com","Bienvenido",$msg);
*/

?>