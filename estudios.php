<?php require_once('admin00921/conexion/conecta.php'); ?>
<?php
header('Content-Type: text/html; charset=UTF-8'); 
die("Estamos en proceso de revisión, mantente al tanto en las fechas publicadas.");
if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) {
//die("Estamos en proceso de revisión, pronto volveremos.");
}
/*
si es 1 existe en la BD
si es 2 es nuevo
*/
//if (!isset($_SERVER['HTTP_REFERER'])){ die("-5"); }

$cod = explode("?", $_SERVER['REQUEST_URI']);
$variables = base64_decode($cod[1]);
parse_str($variables);
//$arr = get_defined_vars();
//var_dump($arr);
//echo $variables;

if(!isset($i)) die("-1");

$becatipo = $b;
$existerut = $k;

$query = "SELECT * FROM listar_postulaciones_estudios WHERE IDPOSTULACION = ".revisaSQL($i, "int");

$result = $db->query($query);

//echo $query;

if($result->num_rows == "0"){
	die("-2");
}

if($result){
    while ($row = $result->fetch_object()){
        $g[] = $row;
    }
     $result->close();
     $db->next_result();
}else die($db->error);
$db->close();

//print_r($g);


if($g[0]->IDESTADOBECA==1){

$_SESSION['nombre'] = $g[0]->NOMBRE_TRABAJADOR." ".$g[0]->PATERNO_TRABAJADOR;
$_SESSION['email'] = $g[0]->CORREO_TRABAJADOR;
$_SESSION['rut'] = $r;
$_SESSION['dv'] = $dv;
$_SESSION['fono'] = $g[0]->FONO_TRABAJADOR;

?>
<link href="css/style.default.css" rel="stylesheet" type="text/css" />
<link href="css/tooltipster.css" rel="stylesheet" type="text/css" />
<link href="css/themes/tooltipster-punk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="js/jquery.smartWizard.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script src="js/jquery.numeric.js" type="text/javascript"></script>
<script src="js/jquery.tooltipster.min.js" type="text/javascript"></script>
<script src="js/jquery.bestupper.min.js" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<link href="css/animations.css" rel="stylesheet" type="text/css" />
<script>

var activadopostular = false;


function calcular_edad(fecha) {
var fechaActual = new Date()
var diaActual = fechaActual.getDate();
var mmActual = fechaActual.getMonth() + 1;
var yyyyActual = fechaActual.getFullYear();

var diaActual = 16;
var mmActual = 6;
var yyyyActual = 2016;

//console.log(fechaActual);

FechaNac = fecha.split("/");
var diaCumple = FechaNac[0];
var mmCumple = FechaNac[1];
var yyyyCumple = FechaNac[2];
//retiramos el primer cero de la izquierda
if (mmCumple.substr(0,1) == 0) {
mmCumple= mmCumple.substring(1, 2);
}
//retiramos el primer cero de la izquierda
if (diaCumple.substr(0, 1) == 0) {
diaCumple = diaCumple.substring(1, 2);
}
var edad = yyyyActual - yyyyCumple;

//validamos si el mes de cumpleaños es menor al actual
//o si el mes de cumpleaños es igual al actual
//y el dia actual es menor al del nacimiento
//De ser asi, se resta un año
if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
edad--;
}
return edad;
};


	function postulacionfinal(){
			//alert('postular_final');
			window.parent.fnCierraFormulario(<?php echo $i; ?>,2);
	}

function dv(T) {
            var M = 0, S = 1; for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11; return S ? S - 1 : 'K';
}

function base64_encode(data) {
  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = '',
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data = unescape(encodeURIComponent(data));

  do {
    // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
}

function guardaArchivo(blob,nombre,viene) {

 var vivienda = $("#idvivienda").val();

  var reader = new FileReader();
  reader.onload = function(event){
    var fd = {};
    fd["fname"] = nombre;
	fd["forigen"] = viene;
	fd["fvivienda"] = vivienda;
    fd["data"] = event.target.result;
	
	//console.log(fd["data"]);
    $.ajax({
      type: 'POST',
      url: 'pages/guarda_archivoestudios.php',
      data: fd,
      dataType: 'text'
      }).done(function(data) {
	
	
        console.log("---->"+data);
		$("#cuadro_guardar").hide();
		$("#"+viene).next().remove();
		if(data == "-1"){
			mataFile(viene);
			alert("Lo sentimos, el archivo no pudo ser almacenado correctamente. Le recomendamos intentar bajar su tamaño o cambiar el formato por uno compatible.");
		}else{
		$("#"+viene).after("<span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f="+viene+"' target='_blank' >Archivo Guardado</a><a href='#' onclick=\"mataFile('"+viene+"');\"><img src='img/icon_cancel.gif' /></a></span>");
		}
    });
  };
  
  reader.readAsDataURL(blob);
}

function mataFile(data){
$("#"+data).show();
$("#"+data).next().remove();
}

function guarda_formulario(paso){

var flag = false;
var llave = $("#llave").val();
var vivienda = $("#idvivienda").val();
$(".guardar").html("<br>Estamos Guardando Automáticamente su Información.<br><img src='img/load.gif'>");
$("#cuadro_guardar").show();
  
if(paso==4 || paso==3)
{
	  $("#fechanacimientopost").prop('disabled', false);
	  //alert($("#paso"+paso).serialize()+"&i="+llave+"&v="+vivienda);
	     	  $("#rutbene").prop('disabled', false);
	  $("#dvbene").prop('disabled', false);
  var dataString = base64_encode($("#paso"+paso).serialize()+"&i="+llave+"&v="+vivienda);
    $("#fechanacimientopost").prop('disabled', true);
	   	  $("#rutbene").prop('disabled', true);
	  $("#dvbene").prop('disabled', true);
	
  if (window.console) console.log('--->pages/guarda_estudios.php?'+$("#paso"+paso).serialize()+"&i="+llave+"&v="+vivienda);
  $.when(
  $.ajax({
		type: "GET",
		url: "pages/guarda_estudios.php",
		data: dataString,
		async: false,
		success: function (data) {
			if (window.console) console.log('--->DEBUG guarda_estudios PASO 4 o 3: '+data);
			if (data == "2") {
				flag = true;
			}	
					
		},
		error: function (objeto, quepaso, otroobj) {
		   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estudios.php --> '+objeto.responseText);
		}
	})
	
	);
}

if(paso==1 || paso==2)
{
  $("#fechanacimiento").prop('disabled', false);
  var dataString = base64_encode($("#paso"+paso).serialize()+"&i="+llave);
  $("#fechanacimiento").prop('disabled', true);

  if (window.console) console.log('--->pages/guarda_estudios.php?'+$("#paso"+paso).serialize()+"&i="+llave);
  $.when(
  $.ajax({
		type: "GET",
		url: "pages/guarda_estudios.php",
		data: dataString,
		async: false,
		success: function (data) {
			if (window.console) console.log('--->DEBUG guarda_estudios: '+data);
			if (data == "2") {
				flag = true;
			}		

		},
		error: function (objeto, quepaso, otroobj) {
		   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estudios.php --> '+objeto.responseText);
		}
	})
	
	);
	
}

if(paso==5 || paso==6)
{
	flag = true;
}

if(!flag){
 $(".guardar").html("Lamentablemente, No se pudo Guardar <br> Favor tomar contacto a nuestro 600.");
}

setTimeout(ocultaMensaje,1000);

//flag = true;	

return flag;

}

/*** VALIDA POSTULACION ***/

function valida_postulacion(paso){
var flag = true;

$('*').filter(function() {
    return $(this).data('tooltipsterNs');
}).tooltipster('hide');

if(paso==5)
{
	var fileName = $("#contratoempresa").next('span').length;
	if(fileName == 0){
		$("#contratoempresa").tooltipster('content', "Debe Subir Contrato de Trabajo o Certificado de Empresa");
		$("#contratoempresa").tooltipster("show");
		return false;
	}
	var fileName = $("#liquidaciones1").next('span').length;
	if(fileName == 0){
		$("#liquidaciones1").tooltipster('content', "Debe Subir la Liquidacion de Sueldo");
		$("#liquidaciones1").tooltipster("show");
		return false;
	}
	/*var fileName = $("#liquidaciones2").next('span').length;
	if(fileName == 0){
		$("#contratoempresa").tooltipster('content', "Debe Subir el Archivo");
		$("#contratoempresa").tooltipster("show");
		return false;
	}
	var fileName = $("#liquidaciones3").next('span').length;
	if(fileName == 0){
		$("#contratoempresa").tooltipster('content', "Debe Subir el Archivo");
		$("#contratoempresa").tooltipster("show");
		return false;
	}*/
	var fileName = $("#declaracion").next('span').length;
	if(fileName == 0){
		$("#declaracion").tooltipster('content', "Debe Subir la Declaracion Empresa Contratista");
		$("#declaracion").tooltipster("show");
		return false;
	}
	
	var fileName = $("#certnotas").next('span').length;
	if(fileName == 0){
		$("#certnotas").tooltipster('content', "Debe Subir el Certificado de Notas");
		$("#certnotas").tooltipster("show");
		return false;
	}
	
	var fileName = $("#regular").next('span').length;
	if(fileName == 0){
		$("#regular").tooltipster('content', "Debe Subir el Certificado de Alumno Regular");
		$("#regular").tooltipster("show");
		return false;
	}
	
	var destinofondo = $("#destino").val();	
    
	if(destinofondo=="HIJO"){
		var fileName = $("#certnac").next('span').length;
		if(fileName == 0){
			$("#certnac").tooltipster('content', "Debe Subir Certificado de Nacimiento");
			$("#certnac").tooltipster("show");
			return false;
		}
	}
	
	if(destinofondo=="CONYUGUE"){
		var fileName = $("#certmatri").next('span').length;
		if(fileName == 0){
			$("#certmatri").tooltipster('content', "Debe Subir Certificado Matrimonio");
			$("#certmatri").tooltipster("show");
			return false;
		}
	}

	if(destinofondo=="CONVIVIENTE"){
		var fileName = $("#decljurada").next('span').length;
		if(fileName == 0){
			$("#decljurada").tooltipster('content', "Debe Subir Declaracion Jurada y Seguro Complementario Salud");
			$("#decljurada").tooltipster("show");
			return false;
		}
	}
}

if(paso==4)
{

 if(!$("#condiciones").is(':checked')) 
 {
 	$("#condiciones").tooltipster('content', "Debe aceptar términos");
	$("#condiciones").tooltipster("show");
	return false;
 }


  var llave = $("#llave").val();
   var vivienda = $("#idvivienda").val();
  $(".guardar").html("<br>Estamos Guardando Automáticamete su Información.<br><img src='img/load.gif'>");
  $("#cuadro_guardar").show();

  var dataString = base64_encode($("#paso"+paso).serialize()+"&i="+llave+"&v="+vivienda);

  if (window.console) console.log('--->pages/guarda_estudios.php?'+$("#paso"+paso).serialize());
	
  $.when(
  
  $.ajax({
		type: "GET",
		url: "pages/guarda_estudios.php",
		data: dataString,
		async: false,
		success: function (data) {
			if (window.console) console.log('--->DEBUG guarda_estudios: '+data);
			if (data == "2") {
				flag = true;
			}		
			flag = true;	
		},
		error: function (objeto, quepaso, otroobj) {
		   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estudios.php --> '+objeto.responseText);
		}
	})
	
	);

}

if(paso==3)
{

    /*var nheduca = $("#hijoseducados").val();
	if(nheduca == "")
	{
		$("#hijoseducados").tooltipster('content', "Ingrese el Numero de hijos en Educacion Superior.");
		$("#hijoseducados").tooltipster("show");
		return false; 	
	}*/
	
		
	var destinofondo = $("#destino").val();	
	if( destinofondo == 0)
	{
		$("#destino").tooltipster('content', "Seleccione Fondo Destino");
		$("#destino").tooltipster("show");
		return false; 		
	}
	
	var fecha1 = $("#fechanacimientopost").val();
	
	if(fecha1.length < 3 ||  fecha1 == ""){
		$("#fechanacimientopost").tooltipster('content', "Completa Fecha del Postulante.");
		$("#fechanacimientopost").tooltipster("show");
		
		return false; 		
	}
	
	if( destinofondo == "HIJO")
	{
		var fecha = $("#fechanacimientopost").val();
		//alert(calcular_edad(fecha));
		if(calcular_edad(fecha) < 0){
			$("#destino").tooltipster('content', "Que tenga una edad menor a 24 años, al 16 de Junio del año 2016 (fecha de nacimiento igual o posterior al 16 de Junio de 1992). Ver requisitos de postulación en Reglamento Becas 2016.");
			$("#destino").tooltipster("show");
			return false; 		
		}
	}
	
	var rutE = $("#rutbene").val();						 
	if(rutE==""){
		if(rutE.length < 7){ 	
			$("#rutbene").tooltipster('content', "Rut Beneficiario");
			$("#rutbene").tooltipster("show");	
			return false;
		}
	}
	
	var dvE = $("#dvbene").val();
	if(dvE.length<1 || dvE.length>1){	
		$("#dvbene").tooltipster('content', "Digito Verificador Incorrecto");
		$("#dvbene").tooltipster("show");
		return false;
	}
	var res = dv(rutE);	
	if (res != dvE) {
		$("#dvbene").tooltipster('content', "Digito Verificador Incorrecto");
		$("#dvbene").tooltipster("show");
		return false;	
	}
	
	var prom = $("#promediobene").val();
	if (parseFloat(prom) > 7 || prom == "" || parseFloat(prom) < 1) {
		$("#promediobene").tooltipster('content', "Promedio de Notas Incorrecto (utilice puntos)");
		$("#promediobene").tooltipster("show");
		return false;	
	}
	if (parseFloat(prom) < parseFloat(4.0)) {
		$("#promediobene").tooltipster('content', "Promedio de Notas Inferior a las Bases");
		$("#promediobene").tooltipster("show");
		//return false;	
	}
	
	var nbene = $("#nombrebene").val();
		if(nbene == "")
		{
		$("#nombrebene").tooltipster('content', "Ingresa el Nombre de Beneficiario");
		$("#nombrebene").tooltipster("show");
		return false;	
		}
		
	    var npater = $("#paternobene").val();
		if(npater == "")
		{
		$("#paternobene").tooltipster('content', "Ingresa el Apellido Paterno");
		$("#paternobene").tooltipster("show");
		return false;	
		}
		
	    var nmater = $("#maternobene").val();
		if(nmater == "")
		{
		//$("#maternobene").tooltipster('content', "Ingresa el Apellido Materno");
		//$("#maternobene").tooltipster("show");
		//return false;		
		}
		
		var data1 = $("#ensenanzabene_select").val();	
		if( data1 == 0)
		{
		$("#ensenanzabene_select").tooltipster('content', "Completa la Enseñanza");
		$("#ensenanzabene_select").tooltipster("show");
		return false;	
		}
		
		var data2 = $("#anteriorbene_select").val();	
		if( data2 == 0)
		{
		$("#anteriorbene_select").tooltipster('content', "Completa la Enseñanza Anterior");
		$("#anteriorbene_select").tooltipster("show");
		return false;		
		}
		
		var data3 = $("#establecibene").val();
		if(data3 == "")
		{
		$("#establecibene").tooltipster('content', "Completa el Establecimiento");
		$("#establecibene").tooltipster("show");
		return false;	
		}
		
		var data4 = $("#carrerabene").val();
		if(data4 == "")
		{
		$("#carrerabene").tooltipster('content', "Completa la Carrera");
		$("#carrerabene").tooltipster("show");
		return false;	
		}
	
		$("#promediobene").tooltipster("hide");
		$("#fechanacimientopost").tooltipster("hide");

    
	
   var llave = $("#llave").val();
   var vivienda = $("#idvivienda").val();
  $(".guardar").html("<br>Estamos Guardando Automáticamete su Información.<br><img src='img/load.gif'>");
  $("#cuadro_guardar").show();
  
  //alert(vivienda);
   $("#fechanacimientopost").prop('disabled', false);
   	  $("#rutbene").prop('disabled', false);
	  $("#dvbene").prop('disabled', false);
	var dataString = base64_encode($("#paso"+paso).serialize()+"&i="+llave+"&v="+vivienda);
    $("#fechanacimientopost").prop('disabled', true);
		  $("#rutbene").prop('disabled', true);
	  $("#dvbene").prop('disabled', true);

  

  if (window.console) console.log('--->pages/guarda_estudios.php?'+dataString);
	
  $.when(
  
  $.ajax({
		type: "GET",
		url: "pages/guarda_estudios.php",
		data: dataString,
		async: false,
		success: function (data) {
			if (window.console) console.log('--->DEBUG guarda_estudios: '+data);
			if (data == "2") {
				flag = true;
			}	
			flag = true;		
		},
		error: function (objeto, quepaso, otroobj) {
		   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estudios.php --> '+objeto.responseText);
		}
	})
	
	);

	
}

if(paso==2){

var rutE = $("#rutempresa").val();						 
if(rutE==""){
	if(rutE.length < 7){ 	
		$("#rutempresa").tooltipster('content', "Rut Empresa");
		$("#rutempresa").tooltipster("show");	
		return false;
	}
	var dvE = $("#dvempresa").val();
	if(dvE.length<1 || dvE.length>1){	
		$("#dvempresa").tooltipster('content', "Digito Verificador Incorrecto");
		$("#dvempresa").tooltipster("show");
		return false;
	}
	var res = dv(rutE);	
	if (res != dvE) {
		$("#dvempresa").tooltipster('content', "Digito Verificador Incorrecto");
		$("#dvempresa").tooltipster("show");
		return false;	
	}
}

		




var tipoempresa = $("#tipoempresa").val();
if(tipoempresa == "0")
{
	$("#tipoempresa").tooltipster('content', "Seleccione Tipo Empresa");
	$("#tipoempresa").tooltipster("show");
	return false;  
}

var razonE = $("#razon").val();
if(razonE == "" || razonE.length < 4)
{
	$("#razon").tooltipster('content', "Ingrese Razón Social Empresa" );
	$("#razon").tooltipster("show");
	return false;  	
}

var fechaterminoE = $("#fechancontrato").val();
if(fechaterminoE=="" ){ 
	$("#fechancontrato").tooltipster('content', "Seleccione Fecha");
	$("#fechancontrato").tooltipster("show");
	return false;
} 



var divisionE = $("#division").val();
if(divisionE == "0")
{
	$("#division").tooltipster('content', "Division Incorrecta");
	$("#division").tooltipster("show");
	return false;  
}

/*
var filterE = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
var correoempresa = $("#correoempresa").val();
if(correoempresa != ""){
if (!filterE.test($("#correoempresa").val().trim())) {
	$("#correoempresa").tooltipster('content', "Correo Incorrecto");
	$("#correoempresa").tooltipster("show");
	return false;        
}
}

var pfijoE = $("#prefijoempresa").val();
if(pfijoE == "0")
{
	var fijoE = $("#fonoempresa").val();
	if(fijoE != "")
	{
		$("#prefijoempresa").tooltipster('content', "Prefijo Incorrecto");
		$("#prefijoempresa").tooltipster("show");
		return false;  
	}
}else{

	var fijoE = $("#fonoempresa").val();
	if(fijoE == "" || fijoE.length < 7 || fijoE.length > 8)
	{
		$("#fonoempresa").tooltipster('content', "Telefono Incorrecto");
		$("#fonoempresa").tooltipster("show");
		return false;  
	}

}
*/

  var llave = $("#llave").val();
  $(".guardar").html("<br>Estamos Guardando Automáticamete su Información.<br><img src='img/load.gif'>");
  $("#cuadro_guardar").show();

  var dataString = base64_encode($("#paso"+paso).serialize()+"&i="+llave);

  if (window.console) console.log('--->pages/guarda_estudios.php?'+$("#paso"+paso).serialize());
	
  $.when(
  
  $.ajax({
		type: "GET",
		url: "pages/guarda_estudios.php",
		data: dataString,
		async: false,
		success: function (data) {
			if (window.console) console.log('--->DEBUG guarda_estudios: '+data);
			if (data == "2") {
				flag = true;
			}		
			flag = true;	
		},
		error: function (objeto, quepaso, otroobj) {
		   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estudios.php --> '+objeto.responseText);
		}
	})
	
	);

}

if(paso==1){

flag = false;

var nombres = $("#nombres").val();
if(nombres=="" || nombres.length < 3){ 
	$("#nombres").tooltipster('content', "Complete su Nombre");
	$("#nombres").tooltipster("show");
	return false;
}
var paterno = $("#paterno").val();
if(paterno=="" || paterno.length < 3){ 
	$("#paterno").tooltipster('content', "Complete su Apellido Paterno");
	$("#paterno").tooltipster("show");
	return false;
} 
var materno = $("#materno").val();
if(materno=="" || materno.length < 3){ 
	//$("#materno").tooltipster('content', "Complete su Apellido Materno");
	//$("#materno").tooltipster("show");
	//return false;
}

var fechanacimiento = $("#fechanacimiento").val();
if(fechanacimiento=="" ){ 
	$("#fechanacimiento").tooltipster('content', "Seleccione Fecha");
	$("#fechanacimiento").tooltipster("show");
	return false;
}

var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
var correo = $("#correo").val();
if (!filter.test($("#correo").val().trim())) {
	$("#correo").tooltipster('content', "Correo Incorrecto");
	$("#correo").tooltipster("show");
	return false;        
}

var auxcorreo = $("#correoaux").val();
if(auxcorreo != correo){
if($("#repite").val() != $("#correo").val() )
{
	$("#repite").tooltipster('content', "Correos no Coinciden");
	$("#repite").tooltipster("show");
	return false
}
}


var prefijoTrabajador = $("#prefijofijo").val();
if(prefijoTrabajador == "0")
{

var fijoTrabajador = $("#fonofijo").val();
if(fijoTrabajador != "")
{
	$("#prefijofijo").tooltipster('content', "Prefijo Incorrecto");
	$("#prefijofijo").tooltipster("show");
	return false;  
}


}else{

var fijoTrabajador = $("#fonofijo").val();
if(fijoTrabajador == "" || fijoTrabajador.length < 7 || fijoTrabajador.length > 8)
{
	$("#fonofijo").tooltipster('content', "Telefono Incorrecto");
	$("#fonofijo").tooltipster("show");
	return false;  
}


}




var prefijoT = $("#prefijocelu").val();
if(prefijoT == "0")
{
	$("#prefijocelu").tooltipster('content', "Prefijo Incorrecto");
	$("#prefijocelu").tooltipster("show");
	return false;  
}

var celularTrabajador = $("#celular").val();
if(celularTrabajador == "" || celularTrabajador.length != 8)
{
	$("#celular").tooltipster('content', "Celular Incorrecto");
	$("#celular").tooltipster("show");
	return false;  
}

var regionT = $("#region").val();
if(regionT == "0")
{
	$("#region").tooltipster('content', "Seleccione Region");
	$("#region").tooltipster("show");
	return false;  
}

var comunaT = $("#comuna").val();
if(comunaT == "0")
{
	$("#comuna").tooltipster('content', "Seleccione Comuna");
	$("#comuna").tooltipster("show");
	return false;  
}

var direccionT = $("#direccion").val();  
if(direccionT == "" || direccionT.length < 5)
{
	$("#direccion").tooltipster('content', "Ingrese Dirección");
	$("#direccion").tooltipster("show");
	return false;  
}

var numeroT = $("#numero").val();  
if(numeroT == "")
{
	$("#numero").tooltipster('content', "Ingrese Dirección");
	$("#numero").tooltipster("show");
	return false;  
}

/*
var villaT = $("#villa").val();
if(villaT == ""  || villaT.length < 4)
{
	$("#villa").tooltipster('content', "Ingrese Villa ó Población");
	$("#villa").tooltipster("show");
	return false;  	
}
*/

var integrantesT = $("#integrantes").val();
if(integrantesT == ""  || integrantesT.length > 3 )
{
	$("#integrantes").tooltipster('content', "Ingrese Cantidad");
	$("#integrantes").tooltipster("show");
	return false;  	
}

var rentaT = $("#renta").val();
if(rentaT == "" || rentaT.length < 3)
{
	$("#renta").tooltipster('content', "Ingrese Renta");
	$("#renta").tooltipster("show");
	return false;  	
}else{

	if(rentaT >= 1600000)
	{
		$("#renta").tooltipster('content', "Renta Supera tope Máximo");
		$("#renta").tooltipster("show");
		//return false;  	
	}

}


var estadoCivilT = $("#estadocivil").val();
if(estadoCivilT == "0")
{
	$("#estadocivil").tooltipster('content', "Estado Civil Incorrecto");
	$("#estadocivil").tooltipster("show");
	return false;  
}

var sexoT = $("#sexo").val();
if(sexoT == "0")
{
	$("#sexo").tooltipster('content', "Sexo Incorrecto");
	$("#sexo").tooltipster("show");
	return false;  
}

var nheduca = $("#hijoseducados").val();
if(nheduca == "" || nheduca == "0")
{
	$("#heduca_aux").tooltipster('content', "Ingrese el Numero de hijos en Educacion Superior");
	$("#heduca_aux").tooltipster("show");
	return false;  
}

$("#renta").tooltipster("hide");

  var llave = $("#llave").val();
  $(".guardar").html("<br>Estamos Guardando Automáticamete su Información.<br><img src='img/load.gif'>");
  $("#cuadro_guardar").show();
  
  $("#fechanacimiento").prop('disabled', false);
  var dataString = base64_encode($("#paso"+paso).serialize()+"&i="+llave);
  $("#fechanacimiento").prop('disabled', true);

  if (window.console) console.log('--->pages/guarda_estudios.php?'+$("#paso"+paso).serialize());
	
  $.when(
  
  $.ajax({
		type: "GET",
		url: "pages/guarda_estudios.php",
		data: dataString,
		async: false,
		success: function (data) {
			if (window.console) console.log('--->DEBUG guarda_estudios: '+data);
			if (data == "2") {
				flag = true;
			}	
			flag = true;		
		},
		error: function (objeto, quepaso, otroobj) {
		   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estudios.php --> '+objeto.responseText);
		}
	})
	
	);
	
	



}


if(!flag){
 $(".guardar").html("Lamentablemente, No se pudo Guardar <br> Favor tomar contacto al 600 XX XX ");
}

setTimeout(ocultaMensaje,1000);

return flag;

}

/**** FIN VALIDA POSTULA ***/

/*** CUENTA ERRORES POSTULACION ***/

function valida_postulacion_contador(paso){



if(paso==5)
{
	var fileName = $("#contratoempresa").next('span').length;
	if(fileName == 0) return 1;
	var fileName = $("#liquidaciones1").next('span').length;
	if(fileName == 0) return 1;
	/*var fileName = $("#liquidaciones2").next('span').length;
	if(fileName == 0) return 1;
	var fileName = $("#liquidaciones3").next('span').length;
	if(fileName == 0) return 1;
	*/
	var fileName = $("#declaracion").next('span').length;
	if(fileName == 0) return 1;
	
	var fileName = $("#certnotas").next('span').length;
	if(fileName == 0){
		return 1;
	}
	
	var fileName = $("#regular").next('span').length;
	if(fileName == 0){
		return 1;
	}
	
	var destinofondo = $("#destino").val();	
    
	if(destinofondo=="HIJO"){
		var fileName = $("#certnac").next('span').length;
		if(fileName == 0) return 1;
	}
	
	if(destinofondo=="CONYUGUE"){
		var fileName = $("#certmatri").next('span').length;
		if(fileName == 0) return 1;
	}

	if(destinofondo=="CONVIVIENTE"){
		var fileName = $("#decljurada").next('span').length;
		if(fileName == 0) return 1;
	}
}

if(paso==4)
{
 if(!$("#condiciones").is(':checked')) 
 {
	return 1;
 }
}

if(paso==3)
{

    var fecha1 = $("#fechanacimientopost").val();
	if(fecha1.length < 3 ||  fecha1 == ""){
		return 1; 	
	}


	var destinofondo = $("#destino").val();	
	if( destinofondo == 0)
	{
		return 1; 		
	}else{
			if( destinofondo == "HIJO")
			{
				var fecha = $("#fechanacimientopost").val();
				//alert(calcular_edad(fecha));
				if(calcular_edad(fecha) < 0){
					return 1; 	
				}
			}
	}
	
	var rutE = $("#rutbene").val();						 
		if(rutE==""){
		if(rutE.length < 7){ 	
			return 1; 
		}
		
	}
	
	var dvE = $("#dvbene").val();
		if(dvE.length<1 || dvE.length>1){	
			return 1; 
		}
		var res = dv(rutE);	
		if (res != dvE) {
			return 1; 
		}
		
		var prom = $("#promediobene").val();
		if (parseFloat(prom) > 7 || prom == "" || parseFloat(prom) < 1) {
			//return 1; 	
		}
		if (parseFloat(prom) < parseFloat(4.0)) {
			//return 1; 	
		}


	
	    var nbene = $("#nombrebene").val();
		if(nbene == "")
		{
				return 1; 	
		}
		
	    var npater = $("#paternobene").val();
		if(npater == "")
		{
				return 1; 	
		}
		
	    var nmater = $("#maternobene").val();
		if(nmater == "")
		{
				//return 1; 	
		}
		
		var data1 = $("#ensenanzabene_select").val();	
		if( data1 == 0)
		{
			return 1; 		
		}
		
		var data2 = $("#anteriorbene_select").val();	
		if( data2 == 0)
		{
			return 1; 		
		}
		
		var data3 = $("#establecibene").val();
		if(data3 == "")
		{
				return 1; 	
		}
		
		var data4 = $("#carrerabene").val();
		if(data4 == "")
		{
				return 1; 	
		}
		
		
		
		
    
	


	
 
}

if(paso==2){



var rutE = $("#rutempresa").val();						 
if(rutE==""){
	if(rutE.length < 7){ 	
		return 1; 	
	}
	var dvE = $("#dvempresa").val();
	if(dvE.length<1 || dvE.length>1){	
		return 1; 	
	}
	var res = dv(rutE);	
	if (res != dvE) {
		return 1; 	
	}
}

var tipoempresa = $("#tipoempresa").val();
if(tipoempresa == "0")
{
		return 1; 	
}

var razonE = $("#razon").val();
if(razonE == "" || razonE.length < 4)
{
		return 1; 	 	
}

/*
var fechaterminoE = $("#fechancontrato").val();
if(fechaterminoE=="" ){ 
		return 1; 	
} */



var divisionE = $("#division").val();
if(divisionE == "0")
{
		return 1; 	
}


var filterE = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
var correoempresa = $("#correoempresa").val();
if(correoempresa != ""){
if (!filterE.test($("#correoempresa").val().trim())) {
		//return 1; 	       
}
}

var pfijoE = $("#prefijoempresa").val();
if(pfijoE == "0")
{
	var fijoE = $("#fonoempresa").val();
	if(fijoE != "")
	{
		//return 1; 	
	}
}else{

	var fijoE = $("#fonoempresa").val();
	if(fijoE == "" || fijoE.length < 7 || fijoE.length > 8)
	{
		//return 1; 	
	}

}



}

if(paso==1){

flag = false;

var nombres = $("#nombres").val();
if(nombres=="" || nombres.length < 3){ 
		return 1; 	
}
var paterno = $("#paterno").val();
if(paterno=="" || paterno.length < 3){ 
		return 1; 	
} 
var materno = $("#materno").val();
if(materno=="" || materno.length < 3){ 
		//return 1; 	
}

var fechanacimiento = $("#fechanacimiento").val();
if(fechanacimiento=="" ){ 
		return 1; 	
} 

var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
var correo = $("#correo").val();
if (!filter.test($("#correo").val().trim())) {
		return 1; 	    
}

var auxcorreo = $("#correoaux").val();
if(auxcorreo != correo){
if($("#repite").val() != $("#correo").val() )
{
		return 1; 	
}
}


var prefijoTrabajador = $("#prefijofijo").val();
if(prefijoTrabajador == "0")
{

var fijoTrabajador = $("#fonofijo").val();
if(fijoTrabajador != "")
{
		return 1; 	
}


}else{

var fijoTrabajador = $("#fonofijo").val();
if(fijoTrabajador == "" || fijoTrabajador.length < 7 || fijoTrabajador.length > 8)
{
		return 1; 	
}


}




var prefijoT = $("#prefijocelu").val();
if(prefijoT == "0")
{
		return 1; 	
}

var celularTrabajador = $("#celular").val();
if(celularTrabajador == "" || celularTrabajador.length != 8)
{
		return 1; 	
}

var regionT = $("#region").val();
if(regionT == "0")
{
		return 1; 	
}

var comunaT = $("#comuna").val();
if(comunaT == "0")
{
		return 1; 	
}

var direccionT = $("#direccion").val();  
if(direccionT == "" || direccionT.length < 5)
{
		return 1; 	
}

var numeroT = $("#numero").val();  
if(numeroT == "")
{
		return 1; 	
}

/*
var villaT = $("#villa").val();
if(villaT == ""  || villaT.length < 4)
{
		return 1; 	
}
*/

var integrantesT = $("#integrantes").val();
if(integrantesT == ""  || integrantesT.length > 3 )
{
		return 1; 		
}

var rentaT = $("#renta").val();
if(rentaT == "" || rentaT.length < 3)
{
		return 1; 		
}else{

	if(rentaT > 1600000)
	{
		//return 1;
	}

}


var estadoCivilT = $("#estadocivil").val();
if(estadoCivilT == "0")
{
		return 1; 	
}


var sexoT = $("#sexo").val();
if(sexoT == "0")
{
		return 1; 	
}

var nheduca = $("#hijoseducados").val();
if(nheduca == "" || nheduca == "0")
{
		return 1; 	
}



}


return 0;

}

/**** FIN VALIDA POSTULA ***/

function onFinishCallback(){
        //alert('Finish Clicked');
		window.parent.fnCierraFormulario();
} 

function ocultaMensaje() {
    $("#cuadro_guardar").hide();
}

function leaveAStepCallback(obj, context){
		var step_num= obj.attr('rel');	
		if(activadopostular) return valida_postulacion(step_num);
		if(!activadopostular) return guarda_formulario(step_num);
}


 $(window).load(function() {
		$("#wizard").fadeIn("slow");
});

$(document).ready(function() {

	$("input:file").change(function (){
	   var s = this.files[0].size;
	   console.log("peso>>"+s);
	   if(s > 15728640 || s == 0){
	   	$(this).tooltipster('content', "Archivo Supera los 15 Megas o esta vacio");
		$(this).tooltipster("show");	
		return false;
	   }
	   var ext = $(this).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg','jpeg','doc','docx','pdf','tif']) == -1) {
			$(this).tooltipster('content', "La Extension no corresponde (jpg,doc,docx,pdf) ");
			$(this).tooltipster("show");	
			return false;
		}
	   
	   var x = $(this).attr('id');
	   $(this).after("<img src='img/load.gif' />");
	   $(this).hide();

	    $(".guardar").html("Estamos Subiendo su archivo a nuestro servidor, un momento por favor.<br><img src='img/load.gif'>");
       $("#cuadro_guardar").show();
	   
   
	   guardaArchivo($(this)[0].files[0],this.files[0].name,x);
	   
	   
     });

	 $("#renta").on("keypress keyup blur",function (event) {
			console.log(event.which);
			$(this).val($(this).val().replace(/[^0-9]/g,''));
            if ((event.which < 48 || event.which > 57) ) {
                event.preventDefault();
            }
    });

    
 
	$("#region").load('pages/listar_regiones.php?f=<?php echo $g[0]->REGION_TRABAJADOR; ?>');
	//$("#fondo_region").load('pages/listar_regiones.php?f=<?php echo ""; ?>'); /* cambiar a region destino */ 
	
	$("#region").live("change", function(){
		var data =  $("#region option:selected").val();
		$("#comuna").load('pages/listar_comunas.php?f='+data);
	});	
	
	$("#heduca_aux").live("change", function(){
		var data =  $("#heduca_aux option:selected").val();
		$("#hijoseducados").val(data);
	});	
	
	
	
	$("#ensenanzabene").hide();
	$("#anteriorbene").hide();
	
	$("#ensenanzabene_select").live("change", function(){
		var data =  $("#ensenanzabene_select option:selected").val();
		$("#ensenanzabene").val(data);
	});	
	
	$("#anteriorbene_select").live("change", function(){
		var data =  $("#anteriorbene_select option:selected").val();
		$("#anteriorbene").val(data);
	});	
	
	$("#fondo_region").live("change", function(){
		var data =  $("#fondo_region option:selected").val();
		$("#fondo_comuna").load('pages/listar_comunas.php?f='+data);
	});	
	
	<?php if($g[0]->COMUNA_TRABAJADOR > 0){ ?>
		$("#comuna").load('pages/listar_comunas.php?f=<?php echo $g[0]->REGION_TRABAJADOR; ?>', function() {
  				$("#comuna").val(<?php echo $g[0]->COMUNA_TRABAJADOR; ?>);
		});
	<?php } ?>
	
	
	<?php if($g[0]->TIPO_POSTULANTE != "0"){ ?>
		$("#destino").change();
	<?php } ?>
	
	

	 $(function() {
     
 //Array para dar formato en español
  $.datepicker.regional['es'] = 
  {
  closeText: 'Cerrar', 
  prevText: 'Previo', 
  nextText: 'Próximo',
   
  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
  monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
  'Jul','Ago','Sep','Oct','Nov','Dic'],
  monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
  dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
  dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
  dateFormat: 'dd/mm/yy', firstDay: 0, 
  initStatus: 'Selecciona la fecha', isRTL: false};
 $.datepicker.setDefaults($.datepicker.regional['es']);
  
 //miDate: fecha de comienzo D=días | M=mes | Y=año
 //maxDate: fecha tope D=días | M=mes | Y=año
 
      $( "#fechanacimiento" ).datepicker({ defaultDate : new Date(), showOn: "button", changeMonth: true, changeYear: true, yearRange: '1900:2015' });
	  //$( "#fechancontrato" ).datepicker({ defaultDate : new Date(), showOn: "button", changeMonth: true, changeYear: true,yearRange: "-5:+15" });
	  $( "#fechanacimientopost" ).datepicker({ defaultDate : new Date(), showOn: "button", changeMonth: true, changeYear: true, yearRange: '1900:2015' });
	  
  });
  
	

	$.fn.tooltipster('setDefaults', {
		  position: 'top',
		  trigger: 'custom',
		  theme: 'tooltipster-punk',
		  multiple: true,
		  autoClose: false
	});
	
	$(":input").tooltipster();
	$(':input')
    .focus(function(){
        $(this).tooltipster('hide');
    })
    .blur(function(){
        $(this).tooltipster('hide');
    });
	
	

	//$('.tooltip').tooltipster();
    
	<?php if($k=="1"){ ?>
	//enableAllSteps: true
	jQuery('#wizard').smartWizard({ enableAllSteps: true, includeFinishButton : false, keyNavigation: false, onLeaveStep:leaveAStepCallback, onFinish: onFinishCallback, labelNext:'Siguiente', labelPrevious:'Anterior', labelFinish:'Guardar', enableFinishButton: false });
	
	<?php }else{ ?>
	
	jQuery('#wizard').smartWizard({onLeaveStep:leaveAStepCallback, keyNavigation: false, onFinish: onFinishCallback, labelNext:'Siguiente', labelPrevious:'Anterior', labelFinish:'Postular', enableFinishButton: false  });
	
	<?php } ?>
	
	
	
	//jQuery('#wizard').smartWizard('showMessage','Please correct the errors in step3 and click next.');
	//jQuery('#wizard').smartWizard('setError',{stepnum:3,iserror:true});
	//$(".actionBar").append('<a href="#" class="chat" style="float: left;">Chat</a>');
	$(".actionBar").append('<a href="files/INSTRUCCIONES PASO A PASO BES VP.pdf" target="_blank" class="pasoapaso" style="float: left;">PDF Paso a Paso</a>');
	$(".actionBar").append('<a href="#" class="videopaso" style="float: left;">Video Paso a Paso</a>');
	/*
	$('#dialog-link').on("click", function(e) {
    e.preventDefault();

            // Set video url
    var videoSourceLink = 'http://www.youtube.com/embed/7Lmxmh9zDEk';

            // Attach video link
    $('#video').attr('src', videoSourceLink);

    $('#dialog').dialog({
        modal: true,
        width:658,
        height:404,
        resizable: false,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#video').removeAttr('src');  
                $('<don't remember what this select is').dialog('close');                
            });
        }                   
    });
}); 
	*/
	//$(".actionBar").append('<a href="#" class="postular_final" style="float: left; margin-left: 180px;">POSTULAR AL FONDO</a>');
	$(".buttonFinish").hide();
	
	$(".eshijo").hide();
	$(".esconyugue").hide();
	$(".esconviviente").hide();
	
	
	
	 <?php if($g[0]->TIPO_POSTULANTE=="HIJO"){ ?>
	 	$(".elegidodestino").html("Has seleccionado destinar los fondos para: HIJO");
	 	$(".eshijo").show();
 	 <?php } ?>
	 <?php if($g[0]->TIPO_POSTULANTE=="CONYUGUE"){ ?>
	 	$(".elegidodestino").html("Has seleccionado destinar los fondos para: CONYUGUE");
	 	$(".esconyugue").show();
 	 <?php } ?>
	 <?php if($g[0]->TIPO_POSTULANTE=="CONVIVIENTE"){ ?>
	 	$(".elegidodestino").html("Has seleccionado destinar los fondos para: CONVIVIENTE");
	 	$(".esconviviente").show();
 	 <?php } ?>
	 <?php if($g[0]->TIPO_POSTULANTE=="TRABAJADOR"){ ?>
	 	$(".elegidodestino").html("Has seleccionado destinar los fondos para: TRABAJADOR");
 	 <?php } ?>
	

	
	
	$(".chat").click(function(){
		//$(document).addClass("zoomOut");
		var nombres = $("#nombres").val();
		if(nombres == ""){
			alert("Completa tu nombre")
			return false;
		}
		var paterno = $("#paterno").val();
		var materno = $("#materno").val();
		var rut = $("#rut").val();
		var dv = $("#dv").val();
		var correo = $("#correo").val();
		var fono = $("#prefijofijo").val() +"-"+ $("#fonofijo").val();
		var data = "r="+rut+"&d="+dv+"&n="+nombres+"&e="+correo+"&f="+fono;
		 $.when(
		$.ajax({
		  type: "GET",
		  async: false,
		  url: 'pages/session_chat.php',
		  data: data,
		}).done(function(data) {
			console.log("pages/session_chat.php-->"+data);
		})
		);
		
		window.parent.fnAbreChat(data);
	})
	

	$(".videopaso").click(function(){
		var iframe = $('<iframe frameborder="0" src="http://www.youtube.com/embed/Ithq63YaATI" marginwidth="0" marginheight="0" height="480px" width="640px" allowfullscreen></iframe>');
		var dialog = $("<div></div>").append(iframe).appendTo("body").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width: "auto",
			height: "auto",
			close: function () {
				iframe.attr("src", "");
			}
		});
		//dialog.closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
		$(".ui-dialog-title").hide();
		var title = "VIDEO PASO A PASO";
		dialog.dialog("option", "title", title).dialog("open");
	})
	
	

	
	
	
	
	
	$(".botonenviarpostulacion").click(function(){
		
		//jQuery('#wizard').smartWizard('setError',{stepnum:3,iserror:true});
		//jQuery('#wizard').smartWizard('showMessage','Hello! World');
		//jQuery('#wizard').smartWizard('goToStep',1);
		//jQuery('#wizard').smartWizard({ enableAllSteps: false });
		activadopostular = true;
		//$("a[href*='#wiz3step1']").click();
		$(".alerta").remove();
		//$(".disabled").remove();
		//$(".done").remove();
		
		if(valida_postulacion_contador(1)){ $("a[href*='#wiz3step1']").attr('class', '').addClass("done").after("<div class='alerta'></div>"); }else{  $("a[href*='#wiz3step1']").attr('class', '').addClass("disabled"); }
		if(valida_postulacion_contador(2)){ $("a[href*='#wiz3step2']").attr('class', '').addClass("done").after("<div class='alerta'></div>"); }else{  $("a[href*='#wiz3step2']").attr('class', '').addClass("disabled"); }
		if(valida_postulacion_contador(3)){ $("a[href*='#wiz3step3']").attr('class', '').addClass("done").after("<div class='alerta'></div>"); }else{  $("a[href*='#wiz3step3']").attr('class', '').addClass("disabled"); }
		if(valida_postulacion_contador(4)){ $("a[href*='#wiz3step4']").attr('class', '').addClass("done").after("<div class='alerta'></div>"); }else{  $("a[href*='#wiz3step4']").attr('class', '').addClass("disabled"); }
		if(valida_postulacion_contador(5)){ $("a[href*='#wiz3step5']").attr('class', '').addClass("done").after("<div class='alerta'></div>");  }else{  $("a[href*='#wiz3step5']").attr('class', '').addClass("disabled"); }
		
		
		if(valida_postulacion_contador(1)){  
		}else if(valida_postulacion_contador(2)){ 
		}else if(valida_postulacion_contador(3)){ 
		}else if(valida_postulacion_contador(4)){ 
		}else if(valida_postulacion_contador(5)){ 
		}else{ 
			$(".botonenviarpostulacion").hide(); 
			$(".actionBar").append('<a href="#" class="postular_final" onclick="postulacionfinal()" title="Felicitaciones, Ahora puedes postular." style="float: left; margin-left: 180px; background-color: #009933; color: white; ">POSTULAR A LA BECA</a>');
			$(".postular_final").tooltipster({ position: 'top' });
			$(".postular_final").tooltipster('content', "Ahora puedes postular");
		    $(".postular_final").tooltipster("show");
		}
		

		//$("#wiz3step6").click();
		
	})
	
	
	
	
		 
	 
	 
	 
	 
	
	$('#destino').on('change', function() {
		$(".elegidodestino").html("Haz Selecionado destinar los fondos para: "+this.value);
		//$(".filtrovivienda").hide();
		if(this.value == "HIJO"){
			$(".eshijo").show();
			$(".esconyugue").hide();
			$(".esconviviente").hide();
		}
		if(this.value == "CONYUGUE"){
			$(".eshijo").hide();
			$(".esconyugue").show();
			$(".esconviviente").hide();
		}
		if(this.value == "CONVIVIENTE"){
			$(".eshijo").hide();
			$(".esconyugue").hide();
			$(".esconviviente").show();
		}
		if(this.value == "TRABAJADOR"){
			$(".eshijo").hide();
			$(".esconyugue").hide();
			$(".esconviviente").hide();
		}
	});
	
	$(".numeros").numeric();

	//$( "input[name^='dv']" ).numeric("K");
	//$( "input[name^='dvempresa']" ).numeric("K");

	$(".up").bestupper();
	
});




	

</script>

<style>

.alert-box {
		color:#555;
		border-radius:10px;
		font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
		padding:10px 36px;
		margin:10px;
	}
	.alert-box span {
		font-weight:bold;
		text-transform:uppercase;
	}
	.error {
		/*background:#ffecec url('../../images/error.png') no-repeat 10px 50%;*/
		border:1px solid #f5aca6;
	}
	.success {
		/*background:#e9ffd9 url('../../images/success.png') no-repeat 10px 50%;*/
		border:1px solid #a6ca8a;
	}
	.warning {
		/*background:#fff8c4 url('../../images/warning.png') no-repeat 10px 50%;*/
		border:1px solid #f2c779;
	}
	.notice {
		/*background:#e3f7fc url('../../images/notice.png') no-repeat 10px 50%;*/
		border:1px solid #8ed9f6;
	}

.elegidodestino {
font-size: 15px !important;
background-color: #f7a30a;
padding: 10px;
cursor: pointer;
}

.botonenviarpostulacion {
font-family: 'Lato', verdana !important;
font-size: 18px !important;
background-color: #f7a30a;
padding: 10px;
cursor: pointer;
}

.aceptapostular {
font-family: 'Lato', verdana !important;
font-size: 18px !important;
background-color: #009933;
padding: 10px;
cursor: pointer;
}


#division {
    text-transform:uppercase;
}

input[type="text"], textarea {

  background-color:#F3F3F3; 

}
textarea
{
    border:1px solid #999999;
    width:100%;
    margin:5px 0;
    padding:3px;
	height:300px;
}
.wizard .tabbedmenu {
list-style: none;
background: #f7a30a;
padding: 10px;
padding-bottom: 0;
height: 61px;
margin: 0px !important;
}
.lema{
font-size: 12px;

}
.stepContainer{
height: 430px !important;
border: none;
}
.tabbedwizard .stepContainer {
padding: 2px !important;
background: #fff;
}
.actionBar {
padding: 15px;
position: relative;
overflow: hidden;
clear: both;
border: 2px solid #f7a30a;
/* border-top: 1px solid #0866c6; */
background: #fff;
}
.actionBar a {
float: right;
display: inline-block;
padding: 5px 15px;
background: #fff;
color: #0866c6;
margin-left: 5px;
border: 2px solid #f7a30a;
}
.actionBar a.buttonDisabled {
background: #fff;
border: 2px solid #ab7038;
color: #333;
opacity: 0.5;
}
a:hover {
outline: none;
color: #333;
text-decoration: none;
background: #ab7038 !important;

}
.wizard .tabbedmenu li a {
padding: 12.3px 8px !important;
background: rgba(255,255,255,0.3);
}
.label {
font-size: 12px !important;
}
.dv{
width: 30px;
}

.stdform label {
float: left;
width: 100px;
text-align: right;
/* padding: 5px 20px 0 0; */
}

.stdform label.files {
width: 300px;
}

.stdform label.files2 {
width: 80px;
}

.stdform span.field, .stdform div.field {
margin-left: 120px;
display: block;
position: relative;
}

.input-tiny{width:40px;}
.input-mini{width:60px;}
.input-small{width:90px;}
.input-medium{width:150px;}
.input-large{width:210px;}
.input-xlarge{width:270px;}
.input-xxlarge{width:530px;}

.wizard .tabbedmenu li a.selected, .wizard .tabbedmenu li a.done {
color: #333 !important;
}
.wizard .tabbedmenu li {

}
.conobsv{
background: url('img/observa-small.png') no-repeat top right !important;
position: absolute;
top: 0;
right:0;
width: 25px;
height: 25px;
}
.exitoso{
background: url('img/ok.png') no-repeat top right !important;
position: absolute;
top: 0;
right:0;
width: 25px;
height: 25px;
}
.alerta{
background: url('img/icon_alert.png') no-repeat top right !important;
position: absolute;
top: 0;
right:0;
width: 25px;
height: 25px;
}
.guardar{
padding: 10px;
width: 350px;
height:80px;
background-color: #f7f7f3;
display: block;
position: absolute;
top: 200;
left: 350;
z-index:90;
text-align: center;
padding-top: 20px;

}
.overlay{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 10;
  background-color: rgba(0,0,0,0.4); /*dim the background*/
}
#cuadro_guardar{
display: none;
}
</style>
<div id="cuadro_guardar" >
<div class="overlay"></div>
<div class="guardar">Guardando</div>
</div>

<div id="wizard" class="wizard tabbedwizard" style="display:none;">
                    	<input type="hidden" id="llave" value="<?php echo $i; ?>" />
                        <input type="hidden" id="idvivienda" value="<?php echo $g[0]->IDEDUCACION; ?>" />
                        <ul class="tabbedmenu anchor">
                            <li>
                            	<a href="#wiz3step1" class="selected" isdone="1" rel="1"  >
									<!--<?php if($k=="1"){ ?><div class="exitoso"></div><?php } ?>-->
                                	<span class="h2">PASO 1</span>
                                    <span class="label">Antecedentes del Trabajador</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz3step2" class="disabled"  isdone="0" rel="2">
									<!--<?php if($k=="1"){ ?><div class="conobsv"></div><?php } ?>-->
                                	<span class="h2">PASO 2</span>
                                    <span class="label">Antecedentes Empleador</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz3step3" class="disabled" isdone="0" rel="3" >
                                	<span class="h2">PASO 3</span>
                                    <span class="label">Datos del Postulante</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz3step4" class="disabled" isdone="0" rel="4" >
                                	<span class="h2">PASO 4</span>
                                    <span class="label">Declaracion Jurada</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz3step5" class="disabled" isdone="0" rel="5" >
                                	<span class="h2">PASO 5</span>
                                    <span class="label">Documentación</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz3step6" class="selected" isdone="1" rel="6"  >
                                	<span class="h2">FINALIZAR</span>
                                    <span class="label">Enviar la Postulación</span>
                                </a>
                            </li>
                        </ul>
                        
                        	
                       
                    <div class="stepContainer" style="height: 500px;">
					<div id="wiz3step1" class="formwiz content" style="display: block;">
                    <form id="paso1" class="stdform">
                    		<input type="hidden" name="p" value="1" />
                        	<h4>Paso 1: Antecedentes del Trabajador</h4>
                        	
                                <p>
                                    <label>Rut</label>
                                    <span class="field"><input type="text" title="" name="rut" id="rut" maxlength="10" disabled="disabled" class="input-small numeros" value="<?php echo $r; ?>"> <input type="text" name="dv" disabled="disabled" maxlength="1" class="dv up" value="<?php echo $dv; ?>"></span>
                                </p>
                                
                                <p>
								
								
								<div style="float:left">
                                    <label>Nombres</label>
                                    <span class="field"><input type="text" id="nombres" name="nombres" class="input-medium up" value="<?php echo $k=="2"?"":$g[0]->NOMBRE_TRABAJADOR; ?>"></span>
								</div>
								
								<div style="float:left">
									<label> Apellido Paterno</label>
                                    <span class="field"><input type="text" name="paterno" id="paterno" class="input-medium up" value="<?php echo $k=="2"?"":$g[0]->PATERNO_TRABAJADOR; ?>"></span>
								</div>

								<div style="float:left">
									<label> Apellido Materno</label>
                                    <span class="field"><input type="text" name="materno" id="materno" class="input-medium up" value="<?php echo $k=="2"?"":$g[0]->MATERNO_TRABAJADOR; ?>"></span>
								</div>
								<div style="clear:both"></div>
                                </p>
								<p>
									<div style="float:left">
                                    <?PHP
									$phpdate = strtotime($g[0]->FECHA_NACIMIENTO);
									$fechanac = date( 'd/m/Y', $phpdate );
									
									if(isset($c)){
									 $caux = explode("-",$c);
									 $c = $caux[2]."/".$caux[1]."/".$caux[0];
                                    }
									
									?>
                                    	<label>Fecha Nacimiento</label>
										<span class="field"><input type="text" id="fechanacimiento" disabled="disabled" name="fechanacimiento" class="input-small" placeholder="mes/dia/año" value="<?php echo $k=="2"?$c:$fechanac; ?>"></span>
									</div>
                                   <div style="float:left">
                                    <label>Correo</label>
                                    <input type="hidden" id="correoaux" value="<?php echo $k=="2"?$m:$g[0]->CORREO_TRABAJADOR; ?>" >
                                    <span class="field"><input type="text" id="correo" name="correo" value="<?php echo $k=="2"?$m:$g[0]->CORREO_TRABAJADOR; ?>" class="input-large up"></span>
									</div>
                                    <div style="float:left">
                                    <label>Confirma Correo</label>
                                    <span class="field"><input type="text" id="repite"  name="repite"  value="" class="input-large up">
                                    <br><i style="font-size:11px;">Si quieres actualizar tu correo, debes rellenar este campo de confirmación.</i></span>
									</div>
                                   
                                   
									<div style="clear:both"></div>
                                </p>
								<p>
                                <div style="float:left">
                                    <label>Sexo</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select name="sexo" id="sexo" class="uniformselect" style="opacity: 9;width: 60px;">
                                        <option value="0">-</option>
                                        <option value="M" <?php echo $g[0]->SEXO=="M"?"selected='selected'":""; ?> >M</option>
                                        <option value="F" <?php echo $g[0]->SEXO=="F"?"selected='selected'":""; ?> >F</option>
                                    </select></div></span>
									</div>
                                <div style="float:left">
                                	<?PHP
									if($g[0]->FONO_TRABAJADOR != ""){
                                    	$prefijof = explode("-", $g[0]->FONO_TRABAJADOR);
									}else $prefijof = explode("-", "0-");
									?>
                                    <label>Teléfono Fijo</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select id="prefijofijo" name="prefijofijo" class="uniformselect" style="opacity: 9;width: 60px;">
                                        <option value="0">-</option>
                                        <option value="022" <?php echo $prefijof[0]=="022"?"selected='selected'":""; ?> >022</option>
                                      
                                        <option value="058" <?php echo $prefijof[0]=="058"?"selected='selected'":""; ?> >058</option>
                                        <option value="057" <?php echo $prefijof[0]=="057"?"selected='selected'":""; ?> >057</option>
                                        <option value="055" <?php echo $prefijof[0]=="055"?"selected='selected'":""; ?> >055</option>
                                        <option value="051" <?php echo $prefijof[0]=="051"?"selected='selected'":""; ?> >051</option>
                                        <option value="052" <?php echo $prefijof[0]=="052"?"selected='selected'":""; ?> >052</option>
                                        <option value="053" <?php echo $prefijof[0]=="053"?"selected='selected'":""; ?> >053</option>
                                        <option value="032" <?php echo $prefijof[0]=="032"?"selected='selected'":""; ?> >032</option>
                                        <option value="033" <?php echo $prefijof[0]=="033"?"selected='selected'":""; ?> >033</option>
                                        <option value="034" <?php echo $prefijof[0]=="034"?"selected='selected'":""; ?> >034</option>
                                        <option value="039" <?php echo $prefijof[0]=="039"?"selected='selected'":""; ?> >039</option>
                                        
                                        <option value="072" <?php echo $prefijof[0]=="072"?"selected='selected'":""; ?> >072</option>
                                        <option value="071" <?php echo $prefijof[0]=="071"?"selected='selected'":""; ?> >071</option>
                                        <option value="073" <?php echo $prefijof[0]=="073"?"selected='selected'":""; ?> >073</option>
                                        <option value="075" <?php echo $prefijof[0]=="075"?"selected='selected'":""; ?> >075</option>
                                        <option value="041" <?php echo $prefijof[0]=="041"?"selected='selected'":""; ?> >041</option>
                                        <option value="042" <?php echo $prefijof[0]=="042"?"selected='selected'":""; ?> >042</option>
                                        <option value="043" <?php echo $prefijof[0]=="043"?"selected='selected'":""; ?> >043</option>
                                        <option value="045" <?php echo $prefijof[0]=="045"?"selected='selected'":""; ?> >045</option>
                                        
                                        <option value="063" <?php echo $prefijof[0]=="063"?"selected='selected'":""; ?> >063</option>
                                        <option value="064" <?php echo $prefijof[0]=="064"?"selected='selected'":""; ?> >064</option>
                                        <option value="065" <?php echo $prefijof[0]=="065"?"selected='selected'":""; ?> >065</option>
                                        <option value="067" <?php echo $prefijof[0]=="067"?"selected='selected'":""; ?> >067</option>
                                        
                                        <option value="068" <?php echo $prefijof[0]=="068"?"selected='selected'":""; ?> >068</option>
                                        <option value="061" <?php echo $prefijof[0]=="061"?"selected='selected'":""; ?> >061</option>

                                    </select><input type="text" maxlength="7" id="fonofijo" name="fonofijo" value="<?php echo $k=="2"?"":$prefijof[1]; ?>" class="input-small numeros"></div></span>
									</div>
                                <div style="float:left">
                                    <?PHP
                                    $prefijoc = explode("-", $g[0]->CELU_TRABAJADOR);
									?>
                                    <label>Celular</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select id="prefijocelu" name="prefijocelu" class="uniformselect" style="opacity: 9;width: 50px;">
                                        <option value="09">09</option>
                                    </select><input type="text" maxlength="8" id="celular" name="celular" value="<?php echo $k=="2"?$f:$prefijoc[1]; ?>" class="input-small numeros"></div></span>
									</div>
                                   
                                   
									<div style="clear:both"></div>
                                </p>
                                <p>
                                <div style="float:left">
								    <label>Region</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select name="region" id="region" class="uniformselect" style="opacity: 9;"></select></div></span>
									</div>
                                   <div style="float:left">
								    <label>Comuna</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select name="comuna" id="comuna" class="uniformselect" style="opacity: 9;"> <option value="0">Seleccione</option></select></div></span>
									</div>
                                    <div style="clear:both"></div>
                                </p>
								<p>
                                   <div style="float:left">
                                    <label>Dirección</label>
                                    <span class="field"><input type="text" id="direccion" name="direccion" class="input-large up" value="<?php echo $k=="2"?"":$g[0]->DIRECCION; ?>"></span>
									</div>
                                    <div style="float:left">
                                    <label>Número</label>
                                    <span class="field"><input type="text" id="numero" name="numero" class="input-mini numeros" value="<?php echo $k=="2"?"":$g[0]->NUM_DIRECCION; ?>"></span>
									</div>
                                    <div style="float:left">
                                    <label>Dpto</label>
                                    <span class="field"><input type="text" id="depto" name="depto" class="input-mini up" value="<?php echo $k=="2"?"":$g[0]->DEPTO_DIRECCION; ?>"></span>
									</div>
									<div style="float:left">
                                    <label>Villa o Población</label>
                                    <span class="field"><input type="text" id="villa" name="villa" class="input-medium up" value="<?php echo $k=="2"?"":$g[0]->VILLA_DIRECCION; ?>"></span>
									</div>
									
                                   

									<div style="clear:both"></div>
                                </p>

								<p>
                                   <div style="float:left;width: 350px; display:none;">
                                    <label style="width: 200px;">Nº de Integrantes Grupo Familiar</label>
                                    <span class="field"><input type="text" maxlength="2" id="integrantes" name="integrantes" class="input-small numeros" value="0<?php //echo $k=="2"?"":$g[0]->INTEGRANTES; ?>"></span>
									</div>
                                    
                                   <div style="float:left; width: 350px;">
                                    <label style="width: 140px;">Sueldo Base Bruto Mensual</label>
                                    <span class="field"><input type="text" maxlength="8" id="renta" name="renta" class="input-medium" value="<?php echo $k=="2"?"":$g[0]->RENTA_TRABAJADOR; ?>">
                                     <br><i style="font-size:11px;">Con un tope máximo de $1.600.000</i>
                                    </span>
									</div>
                                    <div style="float:left">
								    <label>Estado Civil</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select id="estadocivil" name="estadocivil" class="uniformselect" style="opacity: 9;">
                                        <option value="0">Seleccione</option>
                                        <option value="SOLTERO" <?php echo $g[0]->ESTADO_CIVIL=="SOLTERO"?"selected='selected'":""; ?>>SOLTERO</option>
                                        <option value="CASADO" <?php echo $g[0]->ESTADO_CIVIL=="CASADO"?"selected='selected'":""; ?>>CASADO</option>
                                        <option value="VIUDO" <?php echo $g[0]->ESTADO_CIVIL=="VIUDO"?"selected='selected'":""; ?>>VIUDO</option>
                                        <option value="SEPARADO/DIVORCIADO" <?php echo $g[0]->ESTADO_CIVIL=="SEPARADO/DIVORCIADO"?"selected='selected'":""; ?>>SEPARADO/DIVORCIADO</option>
                                    </select></div></span>
									</div>
                                    <div style="float:left;width: 450px;">
                                    <label style="width: 120px;">Nº de Hijos en Educacion Superior</label>
                                    <span class="field">
                                    
                                    <div class="selector" id="uniform-undefined"><select id="heduca_aux" name="heduca_aux" class="uniformselect" style="opacity: 9;">
                                        <option value="0">Seleccione</option>
                                        <option value="1" <?php echo $g[0]->HIJOSEDSUP_TRABAJADOR=="1"?"selected='selected'":""; ?>>1</option>
                                        <option value="2" <?php echo $g[0]->HIJOSEDSUP_TRABAJADOR=="2"?"selected='selected'":""; ?>>2</option>
                                        <option value="3" <?php echo $g[0]->HIJOSEDSUP_TRABAJADOR=="3"?"selected='selected'":""; ?>>3</option>
                                        <option value="4" <?php echo $g[0]->HIJOSEDSUP_TRABAJADOR=="4"?"selected='selected'":""; ?>>4</option>
                                        <option value="5" <?php echo $g[0]->HIJOSEDSUP_TRABAJADOR=="5"?"selected='selected'":""; ?>>5 o mas</option>
                                    </select></div>
                                    </span>
									</div>
									<div style="clear:both"></div>
                                </p>
                               
                        	
                            </form>
                        </div>
						<div id="wiz3step2" class="formwiz content" style="display: block;">
                        <form id="paso2" class="stdform">
                            <input type="hidden" name="p" value="2" />
                        	<h4>Paso 2: Antecedentes Empleador</h4>
                        	
                                <p>
                                	<div style="float:left">
                                    <label>Rut Empresa</label>
                                    <span class="field"><input type="text" id="rutempresa" name="rutempresa" maxlength="8" class="input-small numeros" value="<?php echo $k=="2"?"":$g[0]->RUT_EMPRESA; ?>"> <input type="text" id="dvempresa" name="dvempresa" maxlength="1" class="dv up"  value="<?php echo $k=="2"?"":$g[0]->DV_EMPRESA; ?>"></span>
                                    </div>
                                    
                                    <div style="clear:both"></div>
                                </p>
                                <p>
                                <div style="float:left">
								    <label>Tipo de Empresa</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select id="tipoempresa" name="tipoempresa" class="uniformselect" style="opacity: 9;">
                                        <option value="0">Seleccione</option>
                                        <option value="CONTRATISTA" <?php echo $g[0]->TIPO_EMPRESA=="CONTRATISTA"?"selected='selected'":""; ?>>CONTRATISTA</option>
                                        <option value="SUBCONTRATISTA" <?php echo $g[0]->TIPO_EMPRESA=="SUBCONTRATISTA"?"selected='selected'":""; ?>>SUBCONTRATISTA</option>
                                    </select></div></span>
									</div>
                                <div style="clear:both"></div>
                                </p>
                                <p>
								
								
								<div style="float:left">
                                    <label>Nombre Empresa</label>
                                    <span class="field"><input type="text"  id="razon" name="razon" class="input-xlarge up" value="<?php echo $k=="2"?"":$g[0]->RAZONSOCIAL; ?>"></span>
								</div>
								
								<div style="float:left;">
									<label>Nº Contrato</label>
                                    <span class="field"><input type="text" maxlength="12" id="contrato" name="contrato" class="input-medium numeros" value="<?php echo $k=="2"?"":$g[0]->CONTRATO; ?>" ><br><i style="font-size:11px;">Dejar vacío en caso de no conocerlo.</i></span>
								</div>
								<div style="clear:both"></div>
								</p>
								
								<p>
								
								<div style="float:left">
                                    <span class="field"><input type="hidden"  id="fechancontrato" disabled="disabled" name="fechatermino" class="input-medium" value="0"></span>
								</div>
                                   <div style="float:left">
                                    <label>Proyecto</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select id="division" name="division" class="uniformselect" style="opacity: 9;">
                                        <option value="0">-</option>
                                        <option value="RT SULFURO" <?php echo $g[0]->DIVISION=="RT SULFURO"?"selected='selected'":""; ?>>RT SULFURO</option>
                                        <option value="TALABRE" <?php echo $g[0]->DIVISION=="TALABRE"?"selected='selected'":""; ?>>TALABRE</option>
                                        <option value="MCHS" <?php echo $g[0]->DIVISION=="MCHS"?"selected='selected'":""; ?>>MCHS</option>
                                        <option value="ANDINA" <?php echo $g[0]->DIVISION=="ANDINA"?"selected='selected'":""; ?>>CARTERA PROYECTO ANDINA</option>
                                        <option value="CAREN" <?php echo $g[0]->DIVISION=="CAREN"?"selected='selected'":""; ?>>CAREN</option>
                                        <option value="NNM" <?php echo $g[0]->DIVISION=="NNM"?"selected='selected'":""; ?>>NNM</option>
                                        <option value="PDA" <?php echo $g[0]->DIVISION=="PDA"?"selected='selected'":""; ?>>PLANTA DE ÁCIDO</option>
                                    </select>
                                    <br><i style="font-size:11px;">Proyecto de Codelco en que presta servicios el trabajador.</i>
                                    </div>
                                    
                                    </span>
									</div>
                                   
									<div style="clear:both"></div>
                                </p>
                                
                                <p>
                                
                                <div style="float:left">
                                    <span class="field"><input type="hidden"  id="correoempresa" name="correoempresa" class="input-large up" value="0">
                                    </span>
									</div>
                                    
									<div style="float:left">
                                    <?PHP
                                    /*
									if($g[0]->FONO_EMPRESA != ""){
                                    	$prefijoemp = explode("-", $g[0]->FONO_EMPRESA);
									}else $prefijoemp = explode("-", "0-");
									*/
									?>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select  id="prefijoempresa" name="prefijoempresa" class="uniformselect" style="opacity: 9;width: 60px; display:none;">
                                        <option value="0">-</option>
                                        <option value="022" <?php echo $prefijoemp[0]=="022"?"selected='selected'":""; ?> >022</option>
                                        <option value="032" <?php echo $prefijoemp[0]=="032"?"selected='selected'":""; ?> >032</option>
                                        <option value="041" <?php echo $prefijoemp[0]=="041"?"selected='selected'":""; ?> >041</option>
                                    </select><input type="hidden" maxlength="7" id="fonoempresa" name="fonoempresa" class="input-small numeros" value="0">
                                    </div></span>
									</div>
                                
                                </p>
								
                                
                        	
                            </form>
                        </div>
						
						<div id="wiz3step3" class="formwiz content" style="display: block;">
                        <form id="paso3" class="stdform">
                        	<input type="hidden" name="p" value="3" />
                            <input type="hidden" maxlength="2" id="hijoseducados" name="hijoseducados" class="input-tiny numeros" value="<?php echo $k=="2"?"":$g[0]->HIJOSEDSUP_TRABAJADOR; ?>">
                        	<h4>Paso 3: Antecedentes del Postulante</h4>
                        	
                                
                                   <p>
                                    <div style="float:left">
                                    <label>Tipo de Postulante</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select name="destino" id="destino" class="uniformselect" style="opacity: 9;">
                                        <option value="0">Seleccione</option>
										<option value="HIJO" <?php echo $g[0]->TIPO_POSTULANTE=="HIJO"?"selected='selected'":""; ?>>HIJO DEL TRABAJADOR</option>
                                       
                                    </select>
                                    <br><i style="font-size:11px;">Debe seleccionar cuál será el beneficiario de la beca de estudios.</i>
                                    </div></span>
                                    </div>
                                    <div style="float:left">
                                    <label>Rut Beneficiario </label>
                                    <span class="field"><input type="text" title="" name="rutbene" id="rutbene" disabled="disabled" maxlength="10" class="input-small numeros" value="<?php echo $k=="2"?$rp:$g[0]->RUT_POSTULANTE; ?>"> <input type="text" id="dvbene" name="dvbene"  maxlength="1" class="dv up" disabled="disabled" value="<?php echo $k=="2"?$dp:$g[0]->DV_POSTULANTE; ?>"></span>
                                	<div style="clear:both"></div>
                                    </div>
                                    
                                    <div style="clear:both"></div>
                                </p>
                                
                                 
								
								<p>
                                
                                   <div style="float:left; width: 400px;">
                                    
                                    <label style="width: 120px;" >Nombre Beneficiario</label>
                                    <span class="field"><input type="text" id="nombrebene" name="nombrebene" class="input-large up" value="<?php echo $k=="2"?"":$g[0]->NOMBRE_POSTULANTE; ?>">
                                    </span>
									</div>
                                    <div style="float:left">
                                    <label>Apellido Paterno</label>
                                    <span class="field"><input type="text" id="paternobene" name="paternobene" class="input-medium up" value="<?php echo $k=="2"?"":$g[0]->PATERNO_POSTULANTE; ?>"></span>
									</div>
                                    <div style="float:left">
                                    <label>Apellido Materno</label>
                                    <span class="field"><input type="text" id="maternobene" name="maternobene" class="input-medium up" value="<?php echo $k=="2"?"":$g[0]->MATERNO_POSTULANTE; ?>"></span>
									</div>
									<div style="clear:both"></div>
                                </p>
                                <p>
                                
                                <div style="float:left">
                                    <label>Enseñanza que Cursa Actualmente</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select id="ensenanzabene_select" name="ensenanzabene_select" class="uniformselect" style="opacity: 9;">
                                        <option value="0">Seleccione</option>
                                        <option value="UNIVERSIDAD" <?php echo $g[0]->ENSENA_POSTULANTE=="UNIVERSIDAD"?"selected='selected'":""; ?>>UNIVERSIDAD</option>
                                        <option value="INSTITUTO PROFESIONAL" <?php echo $g[0]->ENSENA_POSTULANTE=="INSTITUTO PROFESIONAL"?"selected='selected'":""; ?>>INSTITUTO PROFESIONAL</option>
                                        <option value="FUERZAS ARMADAS" <?php echo $g[0]->ENSENA_POSTULANTE=="FUERZAS ARMADAS"?"selected='selected'":""; ?>>FUERZAS ARMADAS</option>
                                        <option value="CFT" <?php echo $g[0]->ENSENA_POSTULANTE=="CFT"?"selected='selected'":""; ?>>CFT</option>
                                    </select></div></span>
                                    <span class="field"><input type="text" id="ensenanzabene" name="ensenanzabene" class="input-large up" value="<?php echo $k=="2"?"":$g[0]->ENSENA_POSTULANTE; ?>"></span>
									</div>
                                    
                                    <div style="float:left">
                                    <label>Enseñanza Periodo Anterior</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select id="anteriorbene_select" name="anteriorbene_select" class="uniformselect" style="opacity: 9;">
                                        <option value="0">Seleccione</option>
                                        <option value="INSTITUTO PROFESIONAL" <?php echo $g[0]->ANTENSENA_POSTULANTE=="INSTITUTO PROFESIONAL"?"selected='selected'":""; ?>>INSTITUTO PROFESIONAL</option>
                                        <option value="FUERZAS ARMADAS" <?php echo $g[0]->ANTENSENA_POSTULANTE=="FUERZAS ARMADAS"?"selected='selected'":""; ?>>FUERZAS ARMADAS</option>
                                        <option value="ENSENANZA MEDIA" <?php echo $g[0]->ANTENSENA_POSTULANTE=="ENSENANZA MEDIA"?"selected='selected'":""; ?>>ENSEÑANZA MEDIA</option>
                                        <option value="UNIVERSIDAD" <?php echo $g[0]->ANTENSENA_POSTULANTE=="UNIVERSIDAD"?"selected='selected'":""; ?>>UNIVERSIDAD</option>
                                        <option value="CFT" <?php echo $g[0]->ANTENSENA_POSTULANTE=="CFT"?"selected='selected'":""; ?>>CFT</option>
                                    </select></div></span>
                                    <span class="field"><input type="text" id="anteriorbene" name="anteriorbene" class="input-large up" value="<?php echo $k=="2"?"":$g[0]->ANTENSENA_POSTULANTE; ?>"></span>
									</div>
                                	<div style="clear:both"></div>
                                </p>
                                
                                <p>
                                   <div style="float:left; width: 250px;">
                                    <label style="width: 110px;">Promedio Concentracion de Notas</label>
                                    <span class="field"><input type="text" id="promediobene" name="promediobene" class="input-small numeros" value="<?php echo $k=="2"?"":$g[0]->PROMEDIONOTAS_POSTULANTE; ?>">
                                    <br><i style="font-size:11px;">Ejemplo: 5.7</i>
                                    </span>
                                    
									</div>
                                    <div style="float:left">
                                    <label>Establecimiento</label>
                                    <span class="field"><input type="text" id="establecibene" name="establecibene" class="input-large up" value="<?php echo $k=="2"?"":$g[0]->ESTABLECIMIENTO_POSTULANTE; ?>"></span>
									</div>
                                    <div style="float:left">
                                    <label>Carrera</label>
                                    <span class="field"><input type="text" id="carrerabene" name="carrerabene" class="input-large up" value="<?php echo $k=="2"?"":$g[0]->CARRERA_POSTULANTE; ?>"></span>
									</div>
									<div style="clear:both"></div>
                                </p>
                                
                                <p>
                                <div style="float:left">
                                	<?PHP
									$fechanacpostula = "";
									if($g[0]->NACIMIENTO_POSTULANTE != ""){
										$phpdate = strtotime($g[0]->NACIMIENTO_POSTULANTE);
										$fechanacpostula = date( 'd/m/Y', $phpdate );
									}
									?>
                                  
										<label>Fecha Nacimiento</label>
										<span class="field"><input type="text" id="fechanacimientopost" disabled="disabled" name="fechanacimientopost" class="input-small" placeholder="mes/dia/año" value="<?php echo $k=="2"?"":$fechanacpostula; ?>"></span>
									</div>
                                    
                                    <div style="float:left">
                                    <label>Sexo</label>
                                    <span class="field"><div class="selector" id="uniform-undefined"><select name="sexo" id="sexo" class="uniformselect" style="opacity: 9;width: 60px;">
                                        <option value="0">-</option>
                                        <option value="M" <?php echo $g[0]->SEXO_POSTULANTE=="M"?"selected='selected'":""; ?> >M</option>
                                        <option value="F" <?php echo $g[0]->SEXO_POSTULANTE=="F"?"selected='selected'":""; ?> >F</option>
                                    </select></div></span>
									</div>
                                    
									<div style="clear:both"></div>
                                
                                </p>
                                
                        	
                            </form>
                        </div>
						<div id="wiz3step4" class="content" style="display: block;">
                        <form id="paso4" class="stdform">
                        	<input type="hidden" name="p" value="4" />
                        	<h4>Paso 4: Declaracion Jurada</h4>
                            <div class="par terms">
                                
                                <textarea>Declaro bajo juramento que todos los antecedentes e información proporcionados en este formulario, así como los documentos que adjunto a éste, son verdaderos y auténticos. &#10;&#10;De igual manera, declaro que –en caso de adjudicarse este beneficio a mi persona o al becario que postulo- los fondos entregados serán utilizados exclusivamente para los fines de educación superior indicados en el respectivo Reglamento. &#10;&#10;En consecuencia, declaro estar en conocimiento que en caso de haber incurrido en falsedad material o intelectual de los datos y/o documentos, así como la mala utilización de los fondos, Codelco podrá iniciar todas las acciones legales pertinentes en contra de quienes resulten responsables.&#10;&#10; Del mismo modo, declaro estar en conocimiento que la detección de irregularidades de este tipo, será causal suficiente para que -por ese sólo hecho- sin más trámite y sin necesidad de demanda o requerimiento judicial, se ponga término anticipado a la postulación anterior, a través de un aviso formal de la ocurrencia de éste.&#10;&#10; Asimismo, declaro estar en conocimiento que en tal circunstancia que se perderá la posibilidad de postular nuevamente a este beneficio. Sin perjuicio de lo anterior, si se detectare irregularidades después de haberse entregado este beneficio, restituiré -debidamente reajustadas- las sumas de dinero que hubiese recibido, yo o el becario que postulo.</textarea>
                                <p><div class="checker" id="uniform-undefined"><span><div class="checker" id="uniform-undefined"><span><input type="checkbox" name="condiciones" id="condiciones" <?php echo $g[0]->ACEPTA_EDUCACION=="1"?"checked":""; ?> style="opacity: 1;"></span></div></span></div> Acepto términos y condiciones.</p>
                            </div>
                            </form>
                        </div>
						<div id="wiz3step5" class="content" style="display: block;">
                        <form id="paso5" class="stdform">
                        	<input type="hidden" name="p" value="5" />
                        	<h4>Paso 5: Documentación</h4>
                            
                            <p>
                                   <div class="alert-box notice"><span>NOTA: </span>El tamaño máximo de subida de los archivos son 15 MB c/u y los archivos permitidos tienen extensión: jpg,jpeg,doc,docx,pdf,tif. </div>
                             </p>
                             <div style="clear:both"></div>
                            <p>
                                   <div style="float:left; display:none;">
                                    <label class="files" style="width:200px;">Contrato de Trabajo o Certificado de Empresa</label>
                                    <span class=""><input type="file" id="contratoempresa" name="contratoempresa" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=contratoempresa' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('contratoempresa');"><img src='img/icon_cancel.gif' /></a></span></span>
									</div>
                                    
                                    
							</p>
                            <p>
                                   <div style="float:left">
                                    <label class="files" style="width:200px;">Concentración de Notas</label>
                                    <span class=""><?php if($g[0]->ARCHIVO_CONC_NOTAS==""){ ?><input type="file" id="certnotas" name="certnotas" class="input-medium" value=""><?php }else{ ?><input type="file" id="certnotas" name="certnotas" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=notas' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('certnotas');"><img src='img/icon_cancel.gif' /></a></span><?php } ?></span>
									</div>
                                    <div style="clear:both"></div>
							</p>
                            <p>
                                   <div style="float:left;  display:none;">
                                    <label class="files" style="width:200px;">Declaracion Empresa Contratista</label>
                                    <span class=""><input type="file" id="declaracion" name="declaracion" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=declaracion' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('declaracion');"><img src='img/icon_cancel.gif' /></a></span></span>
									</div>
							</p>
                            <p>
                                    <div style="float:left">
                                    <label class="files" style="width:200px;">Certificado Alumno Regular</label>
                                    <span class=""><?php if($g[0]->ARCHIVO_CERT_ALUMNO==""){ ?><input type="file" id="regular" name="regular" class="input-medium" value=""><?php }else{ ?><input type="file" id="regular" name="regular" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=regular' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('regular');"><img src='img/icon_cancel.gif' /></a></span><?php } ?></span>
									</div>
                                    
									<div style="clear:both"></div>
                            
                            
                            </p>
                            <hr />
							<p>
									<div style="float:left; display:none;">
                                    <label class="files2">Liquidacion 1</label>
                                    <span class=""><input type="file" id="liquidaciones1" name="liquidaciones1" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=liquidaciones1' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('liquidaciones1');"><img src='img/icon_cancel.gif' /></a></span></span>
									</div>
									
							</p>
                            <p>
									<div style="float:left; display:none;">
                                    <label class="files2">Liquidacion 2</label>
                                    <span class=""><input type="file" id="liquidaciones2" name="liquidaciones2" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=liquidaciones2' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('liquidaciones2');"><img src='img/icon_cancel.gif' /></a></span></span>
									</div>
									
							</p>
                            <p>
									<div style="float:left;  display:none;">
                                    <label class="files2">Liquidacion 3</label>
                                    <span class=""><input type="file" id="liquidaciones3" name="liquidaciones3" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=liquidaciones3' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('liquidaciones3');"><img src='img/icon_cancel.gif' /></a></span></span>
									</div>
									<div style="clear:both"></div>
							</p>
                            <hr />
                            <p>
                                   
									
							</p>
                            <p>
                            <div style="float:left">
                             <div class="elegidodestino"></div>
                            </div>
                            <div style="clear:both"></div>
                            </p>
							<p>
									<div style="float:left" class="eshijo">
                                    <label class="files">Certificado de Nacimiento</label>
                                    <span class=""><?php if($g[0]->ARCHIVO_CERT_NAC==""){ ?><input type="file" id="certnac" name="certnac" class="input-medium" value=""><?php }else{ ?><input type="file" id="certnac" name="certnac" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=certnac' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('certnac');"><img src='img/icon_cancel.gif' /></a></span><?php } ?></span>
									<i class="lema"></i>
									</div>
									<div style="clear:both"></div>
							</p>
							<p>
									<div style="float:left" class="esconyugue">
                                    <label class="files">Certificado de Matrimonio</label>
                                    <span class=""><?php if($g[0]->ARCHIVO_CERT_MATRI==""){ ?><input type="file" id="certmatri" name="certmatri" class="input-medium" value=""><?php }else{ ?><input type="file" id="certmatri" name="certmatri" class="input-xlarge" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=certmatri' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('certmatri');"><img src='img/icon_cancel.gif' /></a></span><?php } ?></span>
									<i class="lema"></i>
									</div>
									<div style="clear:both"></div>
							</p>
							<p>
									<div style="float:left" class="esconviviente">
                                    <label class="files">Declaración Jurada y Seguro Complementario</label>
                                    <span class=""><?php if($g[0]->ARCHIVO_SEGUROCOMP==""){ ?>
                                    <input type="file" id="decljurada" name="decljurada" class="input-xlarge" value=""><?php }else{ ?><input type="file" id="decljurada" name="decljurada" class="input-medium" style="display:none;" value="1"><span><a href='pages/ver_archivoestudios.php?v=<?php echo $g[0]->IDEDUCACION; ?>&f=decljurada' target='_blank' >Archivo Guardado</a><a href='#' onclick="mataFile('decljurada');"><img src='img/icon_cancel.gif' /></a></span><?php } ?></span>
									<i class="lema">Declaración Jurada Notarial para acreditar Convivencia y copia de declaración de beneficiarios del Seguro Complementario de Salud.</i>
									</div>
						  <div style="clear:both"></div>
                                </p>
                                </form>
                        </div>
                        
                        <div id="wiz3step6" class="content" style="display: block;">
                        <form id="paso6" class="stdform">
                        	<input type="hidden" name="p" value="4" />
                        	<h4>Paso 6: Enviar Postulación</h4>
                      <div class="par terms">
                                
                                <p>Una vez completados todos los datos requeridos, ya podrás postular al beneficio. <br><br> Pero antes, se ejecutará un proceso de validación, donde los pasos con problemas serán marcados con un símbolo <img src="img/icon_alert.png" />. Haz clic a continuación para revisar tu postulación.</p>
                                <p><div class="botonenviarpostulacion" style="float: left;">REVISAR TU POSTULACIÓN</div></p>
                                <br><br />
                                <p><div class="aceptapostular" style="float: left; display:none;">ENVIAR MI INFORMACIÓN</div></p>
                            </div>
                            </form>
                        </div>
                        
                        

						
						
						</div></div>
                        
<?php }else if($g[0]->IDESTADOBECA==2){ ?>
<form class="stdform">
                        	<input type="hidden" name="p" value="4" />
                        	<h4>Estado de la Solicitud</h4>
                            <div class="par terms">
                                
                                <p>Tu solicitud ya fue procesada <br><br> Te mantendremos informado a la brevedad.</p>
                                <p></p>
                                <br><br />
                                <p><a href="javascript:window.parent.fnCierraNormal()">Salir de Aqui</a></p>
                            </div>
                            </form>
                        </div>

<?php }else if($g[0]->IDESTADOBECA==8){ ?>
<form class="stdform">
                        	<input type="hidden" name="p" value="4" />
                        	<h4>Estado de la Solicitud</h4>
                            <div class="par terms">
                                
                                <p>Esta postulacion fue desactivada <br><br> Si tienes dudas contactate a nuestro email.</p>
                                <p></p>
                                <br><br />
                                <p><a href="javascript:window.parent.fnCierraNormal()">Salir de Aqui</a></p>
                            </div>
                            </form>
                        </div>
<?php } ?>


					
					