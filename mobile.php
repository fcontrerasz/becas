<?PHP
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!DOCTYPE HTML>
<html lang="en" class=" -webkit-">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /> 
<title>Codelco - Fondo de Becas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link href="css/estilomobile.css" rel="stylesheet" media="screen, projection">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>

//$("body").hide();

function dv(T) {
            var M = 0, S = 1; for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11; return S ? S - 1 : 'K';
}

$(window).resize(function() {
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			 
		}else{
		window.location.href = "index.php";
		}
});


$( document ).ready(function() {

	$("#salir").parent().hide();

	$( "a" ).click(function( event ) {
  event.preventDefault();
  
  });
  
    $("#bases").click(function() {
    window.open($(this).attr("href"));
	return false; 
    });
		

  $("#frecuentes").click(function() {
    window.open($(this).attr("href"));
	return false; 
    });
		
  
  	$("#link_buscar").click(function(){
		var cod = $("#rutconsultar").val();
		$(".mensajeestados").hide();
		
		if(cod=="" || cod.length < 8){ 
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("Debes ingresa un codigo valido");
			$("#rutconsultar").focus();
			return false;
		} 
		/*
		var rutA = rut.split("-");
		if(rutA[0].length<6 || rutA[0].length>8){
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("RUT Incorrecto (Recuerda Ingresar Guion)");
			$("#rutconsultar").focus();
			return false;
		}  
		if(rutA[1].length<1 || rutA[1].length>1){
			$(".mensajeestados").show().html("DV Incorrecto");
			$("#rutconsultar").focus();
			return false;
		} 
		
		var resultado = dv(rutA[0]);
		if (resultado != rutA[1]) {
				$(".mensajeestados").show().html("DV Incorrecto");
				$("#rutconsultar").focus();
                return false;
        }
		*/
	
		window.location.href = "estadomobile.php?r="+cod;
	});
  
  	$("#salir").click(function(){
		$(".row0").show();
		$(".col1").show();
		$(".col2").show();
		$(".col3").show();
		$(".row2").show();
		$(this).parent().hide();
		$("#estudios").hide();
		$("#vivienda").hide();
		$("#link_becaestudios").show();
		$("#link_becavivienda").show();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	})

	
	$("#link_becavivienda").click(function(){
		$("#link_becaestudios").hide();
		$(".row0").hide();
		$(".col1").hide();
		$(".col2").hide();
		$(".col3").hide();
		$(".row2").hide();
		$("#salir").parent().show();
		$("#estudios").hide();
		$("#vivienda").show();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	})
	
	$("#link_becaestudios").click(function(){
		$("#link_becavivienda").hide();
		$(".row0").hide();
		$(".col1").hide();
		$(".col2").hide();
		$(".col3").hide();
		$(".row2").hide();
		$("#salir").parent().show();
		$("#estudios").show();
		$("#vivienda").hide();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	})


    var slider = 1;
	var current_slider = -1;
	var num_slide = $(".grupo figure").length;

	function slideme(){
	
	$(".progress-bar").css("width", "0px");
	
	if(current_slider < (num_slide - 1)){
		if(slider == 1){
			current_slider++;
			var avanza = current_slider*1000;
			$("div#slider figure.grupo").animate({ "left": '-'+(avanza)+'%' }, "slow");
		}
	}else{
		current_slider = 0;
		 $( "div#slider figure.grupo" ).fadeOut( "fast", function() {
			$("div#slider figure.grupo").animate({ "left": '0%' }, "fast");
			$( "div#slider figure.grupo" ).fadeIn( "slow");
		});
	}
	
	console.log(current_slider);
	
	$('.progress-bar').animate({ width: '768px' }, 15000, "linear", slideme);
	
    }
	
	slideme();
	
});



</script>

</head>
<body>

<div class="overlay"></div>
<header id="pageHeader" role="banner">
<!--
<nav id="menu" role="navigation">
 <h2>Navegacion</h2>
  <ul>
    <li><a href="galleries.htm" title="Ejemplo" class="">Link 1</a></li>
	<li><a href="galleries.htm" title="Ejemplo" class="">Link 2</a></li>
	<li><a href="galleries.htm" title="Ejemplo" class="">Link 3</a></li>
  </ul>
</nav> -->








<section id="content" role="main">
<div class="rowmenu"></div>


<div class="row0">


<div id="slider">

<figure class="grupo">
	<!--
	<figure>
		
	    <img src="img/bcelu1.jpg">
		
		<figcaption>
				
		<div class="textos">
		<h1>fondo de vivienda concursable</h1>
		<span>Para la primera vivienda de trabajadores Contratistas y Subcontratistas de Codelco.</span>
	-->
				<!-- <p class="bases" id="link_vivienda">Descargar Bases de la Vivienda</p> -->
	<!--
		</div>

		</figcaption>
		
	</figure>
	-->
	<figure>
	    <img src="img/bcelu2.jpg">
		<figcaption>
				
		<div class="textos">
		<h1>becas de educacion superior</h1>
		<span>Entregaremos becas de excelencia acad&eacute;mica de educaci&oacute;n superior, para hijos de trabajadores contratistas y/o subcontratistas.</span>
		</div>
		</figcaption>
		
	</figure>

	
</figure>

<div class="progress-bar"></div>
</div>


</div>
<section class="row1">
<div class="opcionbecas"><div class="limpiar"></div>
<div id="nav">
<ul>
<li><a href="#" id="salir" style="background:#ab7038;">VOLVER</a></li>
<!--<li><a href="#" id="link_becavivienda" style="background:#f7a30a;">Fondo para la Primera Vivienda</a></li>-->
<li><a href="#" id="link_becaestudios"  style="background:#f7a30a;">BECAS DE EDUCACIÓN SUPERIOR</a></li>
</ul>
</div>
</div>
<div class="limpiar"></div>
</section>

<section class="col0">
<div id="estudios" class="descripcion_beca">

<div class="textos">
		<p>Entregaremos becas de excelencia acad&eacute;mica de educaci&oacute;n superior, para hijos de trabajadores contratistas y/o subcontratistas. Te invitamos a que puedas conocer las bases de este beneficio y postular a través de este formulario electr&oacute;nico.</p><BR>
        <p>
        <strong>Fechas Importantes:</strong>
        </p>
        <div id="nav">
<ul>
<li><a href="#" style="font-size:16px;" ><strong>17 ABRIL al 17 MAYO</strong>: <BR>Postulaciones y entrega de antecedentes.</a></li>
<li><a href="#" style="font-size:16px;" ><strong>19 JUNIO</strong>: <BR>Publicación de resultados de las Postulaciones (válidas / con reparos).</a></li>
<li><a href="#" style="font-size:16px;" ><strong>DESDE 27 JUNIO</strong>: <BR>Fecha pago Becas Adjudicadas (primera etapa).</a></li>
</ul>
</div>
<BR>
        
		<h3><span>POSTULA INGRESANDO DESDE TU COMPUTADOR</span><br><br>www.oticdelaconstruccion.cl/becas2017</h3>
		</div>
        <div class="eventos">

		<div class="limpiar"></div>
		<a id="bases" href="files/REGLAMENTO 2017 BECAS ESTUDIOS.pdf" target="_blank"><div class="basesaqui">VER LAS BASES</div></a>

		</div>


</div>
<div id="vivienda" class="descripcion_beca">

<div class="textos">
		<p>En la Corporación Nacional del cobre estamos interesados que puedas postular al fondo para la primera vivienda para trabajadores de empresas contratistas o subcontratistas que prestan servicios para Codelco. Infórmate en este sitio de los requerimientos necesarios y anímate a postular. </p><BR>
        
       <p>
        <strong>Fechas Importantes:</strong>
        </p>
        
        <div id="nav">
<ul>
<li><a href="#" style="font-size:16px;" >16 MARZO : Comienzo de Postulacion</a></li>
<li><a href="#" style="font-size:16px;" >23 MARZO : Comienzo de Postulacion</a></li>
<li><a href="#" style="font-size:16px;" >16 MARZO : Comienzo de Postulacion</a></li>
</ul>
</div>

<BR>
        
		<h3><span>POSTULA INGRESANDO DESDE TU COMPUTADOR</span><br><br>www.contratistascodelco.cl</h3>
		</div>
        <div class="eventos">

		<div class="limpiar"></div>
		<div class="basesaqui">VER LAS BASES</div>

		</div>


</div>
</section>
<div class="limpiar"></div>
<section class="col1" style="height:auto;">

<h2>Conoce el estado de tu Postulación, ingresando desde tu computador.</h2>

<!--<div class="estadopostulacion">
<form class="stdform" action="forms.html" method="post">
<div class="control-group info">
                          <div class="controls">
                            <input type="text" class="upper" id="rutconsultar" maxlength="10" placeholder="">
                            <span class="help-inline"><div class="becastipo" id="link_buscar" style="float:left">Buscar</div></span>
                          </div>
						  <div class="mensajeestados"> </div>
                        </div>
</form>
</div>-->

<!-- <div class="postula"><img src="postula.png"></div> -->


</section>
<section class="row2">
<div id="triangulos"></div>
</section>

<!--
<section class="col2">

<h2>Conoce nuestro video</h2>
<div class="video"><img src="img/note.png"></div>
</section>
-->

<section class="col3" style="padding-top: 10px;">

<h2>¿ Necesitas Ayuda ?</h2>
<div class="ayuda">
<div class="becastipo" id="link_frecuentes" style="float:left"><a id="frecuentes" href="files/PREGUNTAS FRECUENTES VP.pdf" target="_blank">Preguntas Frecuentes</a></div>
</div>
<div class="limpiar"></div>
<h3><span>CORREO</span> ayuda@oticdelaconstruccion.cl</h3>
<h3><span>TELÉFONOS</span> <BR> 222506787 (Alicia Valenzuela) <BR> 223922361 (Mabel Gómez)</h3>
<h3>&nbsp;</h3>
</section>

<!-- <section class="row3">

</section>
<section class="row4">

</section> -->



</section>



</body>
</html>