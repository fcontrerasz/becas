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

$query = "SELECT * from listar_postulaciones_estudios where IDPOSTULACION = ".revisaSQL($_GET["id"], "int");
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

$phpdate = strtotime($g[0]->FECHA_POSTULACION);
$fechapostulacion = date( 'd/m/Y', $phpdate );

$phpdate2 = strtotime($g[0]->FECHA_NACIMIENTO);
$fechanaci = date( 'd/m/Y', $phpdate2 );

$phpdate3 = strtotime($g[0]->NACIMIENTO_POSTULANTE);
$fechanaci3 = date( 'd/m/Y', $phpdate3 );

$message = file_get_contents('mailestudios.html');
$message = str_replace('[ticket]', '22015'.$g[0]->RUT_TRABAJADOR, $message);
$message = str_replace('[nombre]', $g[0]->NOMBRE_TRABAJADOR.'_'.$g[0]->PATERNO_TRABAJADOR.'_'.$g[0]->MATERNO_TRABAJADOR, $message);
$message = str_replace('[beca]', 'ESTUDIOS', $message);
$message = str_replace('[fecha]', $fechapostulacion, $message);
$message = str_replace('[rut]', $g[0]->RUT_TRABAJADOR.'-'.$g[0]->DV_TRABAJADOR, $message);
$message = str_replace('[nombrecompleto]', $g[0]->NOMBRE_TRABAJADOR.' '.$g[0]->PATERNO_TRABAJADOR.' '.$g[0]->MATERNO_TRABAJADOR, $message);
$message = str_replace('[nacimiento]', $fechanaci, $message);
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

$message = str_replace('[destinofondo]', $g[0]->TIPO_POSTULANTE, $message);

$message = str_replace('[nhijos]', $g[0]->HIJOSEDSUP_TRABAJADOR, $message);
$message = str_replace('[rutbene]', $g[0]->RUT_POSTULANTE.'-'.$g[0]->DV_POSTULANTE, $message);
$message = str_replace('[nombrebene]', $g[0]->NOMBRE_POSTULANTE.' '.$g[0]->PATERNO_POSTULANTE.' '.$g[0]->MATERNO_POSTULANTE, $message);
$message = str_replace('[enactual]', $g[0]->ENSENA_POSTULANTE, $message);
$message = str_replace('[enante]', $g[0]->ANTENSENA_POSTULANTE, $message);
$message = str_replace('[notas]', $g[0]->PROMEDIONOTAS_POSTULANTE, $message);
$message = str_replace('[estable]', $g[0]->ESTABLECIMIENTO_POSTULANTE, $message);
$message = str_replace('[carrera]', $g[0]->CARRERA_POSTULANTE, $message);
$message = str_replace('[benenac]', $fechanaci3, $message);
$message = str_replace('[benesex]', $g[0]->SEXO_POSTULANTE, $message);

$message = str_replace('[acepta]', ($g[0]->ACEPTA_EDUCACION=="1")?"Aceptada":"Rechazada", $message);

$message = str_replace('[cernotas]', (($g[0]->ARCHIVO_CONC_NOTAS === NULL) || ($g[0]->ARCHIVO_CONC_NOTAS == ""))?'--SIN ARCHIVO--':'FUE ADJUNTADO', $message);
$message = str_replace('[cernacim]', (($g[0]->ARCHIVO_CERT_NAC === NULL) || ($g[0]->ARCHIVO_CERT_NAC == ""))?'--SIN ARCHIVO--':'FUE ADJUNTADO', $message);
$message = str_replace('[cerregular]', (($g[0]->ARCHIVO_CERT_ALUMNO === NULL) || ($g[0]->ARCHIVO_CERT_ALUMNO == ""))?'--SIN ARCHIVO--':'FUE ADJUNTADO', $message);


//var_dump($g[0]);

//$message = str_replace('%password%', $password, $message);
$email->IsHTML(true); 
$email->CharSet = 'UTF-8';
$email->From      = 'autonomo@oticdelaconstruccion.cl';
$email->FromName  = 'Becas - Postulacion de Estudios';
$email->Subject   = 'Confirmacion de Postulacion #'.'22015'.$g[0]->RUT_TRABAJADOR;
$email->Body      = $message;
//$email->AddAddress( 'fcontrerasz@gmail.com' );
$email->AddAddress( $g[0]->CORREO_TRABAJADOR );
$email->AddBCC('ayuda@oticdelaconstruccion.cl');
/*
$file_to_attach = 'tmp/demo.txt';
$email->AddAttachment( $file_to_attach , 'demo.txt' );
*/
/*
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

if (!($g[0]->ARCHIVO_CERT_ALUMNO  == "")){
$archivo = $g[0]->ARCHIVO_CERT_ALUMNO;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_CERT_ALUMNO.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_CONC_NOTAS  == "")){
$archivo = $g[0]->ARCHIVO_CONC_NOTAS;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_CONC_NOTAS.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_CERT_NAC  == "")){
$archivo = $g[0]->ARCHIVO_CERT_NAC;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_CERT_NAC.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_CERT_MATRI == "")){
$archivo = $g[0]->ARCHIVO_CERT_MATRI;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_CERT_MATRI.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_DECLARA  == "")){
$archivo = $g[0]->ARCHIVO_DECLARA;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_DECLARA.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}

if (!($g[0]->ARCHIVO_SEGUROCOMP == "")){
$archivo = $g[0]->ARCHIVO_SEGUROCOMP;
$data = substr($archivo, strpos($archivo, ",") + 1);
$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
$filename="ARCHIVO_SEGUROCOMP.".ex($tipoarchivo);
$encoding = "base64"; 
$type = $tipoarchivo;
	if(ex($tipoarchivo) != "txt"){
		$email->AddStringAttachment(base64_decode($data), $filename, $encoding, $type);
	}
}
*/

if(!$email->send()) {
    echo '|Mensaje Error: ' . $email->ErrorInfo;
} else {
    echo '|Mensaje Enviado|#22015'.$g[0]->RUT_TRABAJADOR;
}
/*
$msg = "First line of text\nSecond line of text";
$msg = wordwrap($msg,70);
mail("fcontrerasz@gmail.com","Bienvenido",$msg);
*/

?>