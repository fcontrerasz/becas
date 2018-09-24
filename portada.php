<?php

//if(!isset($_GET["adminme"])) die("");

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
header('Location: ../index.php');
}
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<?php

$datestr="2017-05-18 00:00:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
//$days = 0;

date_default_timezone_set('America/Santiago'); 
$datestr3="2017-06-19 00:00:10";//Your date
$date3=strtotime($datestr3);//Converted to a PHP date (a second count)
$diff3=$date3-time();//time returns current time in seconds
$days3=floor($diff3/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours3=round(($diff3-$days3*60*60*24)/(60*60));
$daysv3=floor($diff3/(60*60*24));

date_default_timezone_set('America/Santiago'); 
$datestr2="2017-07-15 00:00:10";//Your date
$date2=strtotime($datestr2);//Converted to a PHP date (a second count)
$diff2=$date2-time();//time returns current time in seconds
$days2=floor($diff2/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours2=round(($diff2-$days2*60*60*24)/(60*60));
$daysv2=floor($diff2/(60*60*24));

//echo(date("d m y h i")."<br>");
$tiemporestante = (round(($diff2/60),0));
//echo $diff2;

?>
<!DOCTYPE HTML>
<html lang="en" class=" -webkit-">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=windows-1252' /> 
<title>Becas 2017</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link href="css/estilo.css" rel="stylesheet" media="screen, projection">
<link href="css/animations.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/jquery.numeric.js" type="text/javascript"></script>
<script src="js/jquery.bestupper.min.js" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src="js/jquery.pause.js" ></script>
<script>

function urldecode(str) {
  return decodeURIComponent((str + '')
    .replace(/%(?![\da-f]{2})/gi, function() {
      // PHP tolerates poorly formed escape sequences
      return '%25';
    })
    .replace(/\+/g, '%20'));
}

function urlencode(str) {
  str = (str + '')
    .toString();
  return encodeURIComponent(str)
    .replace(/!/g, '%21')
    .replace(/'/g, '%27')
    .replace(/\(/g, '%28')
    .replace(/\)/g, '%29')
    .replace(/\*/g, '%2A')
    .replace(/%20/g, '+');
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


	var beca=0;

function fnCambiaDialogo(alto)
{
	$("#estadobecas").dialog({height: alto});
}
function fnCierraNormal()
{
//alert("Cerrando");
$("#dialog").dialog("close");
}
	
function fnCierraFormulario(data,origen)
{
	$('<div></div>').appendTo('body')
    .html('<div><center><h6>¿Desea enviar su información a la postulación ?</h6><br><br><span>Luego de confirmar, recibiras un mail con la información que subiste a la postulación.</span></center></div>')
    .dialog({
        modal: true,
        title: 'Teminar',
        zIndex: 10000,
        autoOpen: true,
        width: '450px',
		height: '250',
        resizable: false,
        buttons: {
            "Si": function () {
								var dataString = "id="+data+"&desde="+origen;
								 $.when(
									$.ajax({
									type: "GET",
									url: "pages/guarda_estado.php",
									data: dataString,
									async: false,
									success: function (data) {
										if (window.console) console.log('--->DEBUG guarda_estado: '+data);
											var resp = data.split("|");
											if (resp[0] == "1") {
												if (resp[1] == "Mensaje Enviado") {
													alert("Correo Enviado, el codigo de respaldo es: "+resp[2]);
												}
												window.location.reload();
											}			
										},
									error: function (objeto, quepaso, otroobj) {
									if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estado.php --> '+objeto.responseText);
									}
									})
								
								);
            },
            No: function () {
                $(this).dialog("close");
            }
        },
        close: function (event, ui) {
            $(this).remove();
        }
    });
}
	
function fnParentExits(rel, data)
{
	if(rel=="" || rel.length < 1){ 
	  return false;
	}
	
    var paginadest = "";
	if(rel==1){
	  paginadest = "vivienda.php";
	}
	if(rel==2){
	  paginadest = "estudios.php";
	}

	$("#idiframe").hide();
	
	ruta = paginadest+"?"+base64_encode(data+"&t=" + new Date().getTime());
	
	$("#idiframe").attr("src", ruta );
	
	console.log(ruta);
	
	//var height = $(window).height() - 200;
	$("#dialog").dialog({height: 650,width: 1170});
	

	//$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
   
   
	$.ui.dialog.prototype._focusTabbable = function(){};
	$(".ui-dialog-title").hide();
	//.css("max-height", height);
	if($("#estadobecas").closest('.ui-dialog').is(':visible')){
		$("#estadobecas").dialog( "close" );
	}
	$("#idiframe").fadeIn();
	
}

function fnAbreChat(param){
	
	$('#iframe_chat' ).attr( 'src','http://www.studianet.cl/becascodelco/chat/?'+param);
	if($('#chatme').is(':hidden')){
		$('#iframe_chat' ).attr( 'src', function ( i, val ) { return val; });
		$("#chatme").fadeIn();
	}else{
		$("#chatme").hide();
		$('#iframe_chat' ).attr( 'src', function ( i, val ) { return val; });
	}
}


function fnAbreFormulario(beca){
		data = "b="+beca;
		$("#estadobecas").dialog("close");
		$("#idiframe").attr("src", "login.php?"+data+"&t=" + new Date().getTime());
		$("#dialog").dialog({height: '300',minWidth:500});
		$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
		$("#dialog").dialog("open");
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
}
var urlget = window.location.href;
if(urlget.indexOf("#iniciar") > -1){
	fnAbreFormulario(1);
}

function enviarTextoChat(){
				var texto = $(".userinput").val();
				$(".chat-messages ul").append('<li class="chat-msg-user"><span class="chat-msg-time"><strong>TU</strong></span>'+texto+'</li>');
				$('.fixedContent').animate({scrollTop: $(".chat-messages ul").prop("scrollHeight") },500);
				$(".userinput").val("");
				setTimeout(function(){$(".chat-messages ul").append('<li><span class="chat-msg-time"><a href="#">Callcenter</a></span>Un momento por favor, mientras revisamos su requerimiento.</li>'); $('.fixedContent').animate({scrollTop: $(".chat-messages ul").prop("scrollHeight") },500);},2000)
}

function dv(T) {
            var M = 0, S = 1; for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11; return S ? S - 1 : 'K';
}

$( document ).ready(function() {

	console.log = function() {}
	
	$(".postulaaqui").hide();
	var notyStatus = null;

	$.ajaxSetup({ cache: false });
	$('.upper').bestupper();
	//$("#rutconsultar").numeric("K");
	$("#rutconsultar2").on("keypress keyup blur",function (event) {
			console.log(event.which);
			$(this).val($(this).val().replace(/[^0-9\-]/g,''));
            if ((event.which != 45 || $(this).val().indexOf('-') != -1) && (event.which < 48 || event.which > 57) ) {
                event.preventDefault();
            }
    });
	
	$(".userinput").on("keypress",function (event) {
			console.log(event.which);
			if (event.which == 13){
				event.preventDefault();
				enviarTextoChat();
				
				return false;
				
			}

    });
	
	$(window).resize(function() {
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			 window.location.href = "index.php";
		}
	});
	
	$('input,textarea').focus(function(){
       $(this).data('placeholder',$(this).attr('placeholder'))
       $(this).attr('placeholder','');
    });
    $('input,textarea').blur(function(){
       $(this).attr('placeholder',$(this).data('placeholder'));
    });
	
	$("html, body").animate({ scrollTop: 0 }, "slow");
	
	
	
	var page = "limpia.php";
    $("#dialog").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="100%"></iframe>').dialog({ 
		autoOpen: false, 
		closeOnEscape: false, 
		modal:true, 
		height: 'auto',
		width:'500px', 
		draggable: false,
		resizable: false,
		beforeClose: function (event, ui) {
			var str = $("#idiframe").attr("src");
			if ((str.indexOf("vivienda") >= 0) ||(str.indexOf("estudios") >= 0) ){
				if (notyStatus === null) {
   			    event.preventDefault();
                $('<p style="font-size: 16px; padding: 20px;" title="¿Desea Salir del Formulario?"><br> Su Información quedará almacenada solo hasta los campos completados </p>').dialog({
					width:'400', 
                    modal: true,
                    buttons: {
                        "Salir": function () {
							notyStatus = true;
							$("#dialog").dialog("close");
                            $(this).dialog("close");
							//window.location.reload();
                            
                        },
                        "Continuar con el Formulario": function () {
							 notyStatus = null;
                            $(this).dialog("close");
                        }
                    }
                });
				}
			}
				//return false;
  		},
        open: function(event, ui) {
            $(this).css({'max-height': $(document).height()-200, 'overflow-y': 'hidden'}); 
			$(this).css('overflow', 'hidden');
			$(".ui-dialog-title").show();
        } });
	$(".ui-dialog-titlebar-close").addClass("boton-cerrar");
	
	/*$(document).scroll(function() {
	  var y = $(this).scrollTop();
	  console.log(y);
	  if (y > 90) {
		$('.row4').fadeIn();
		$('.row3').animate({ "height": '0px' }, "slow");
	  } else {
		$('.row4').fadeOut();
		$('.row3').animate({ "height": '350px' }, "fast");
	  }
	}); */

	
	
	var slider = 1;
	var current_slider = -1;
	var num_slide = $(".grupo figure").length;
	var llave = true;

	function slideme(){
	return false;
	console.log("1 -->"+current_slider);
	
	$(".progress-bar").css("width", "0px");
		if(slider == 1){	
	if(current_slider < (num_slide - 1)){
		console.log("2 -->"+current_slider);

			console.log("3 -->"+current_slider);
			current_slider++;
			var avanza = current_slider*100;
			$("div#slider figure.grupo").animate({ "left": '-'+(avanza)+'%' }, "slow");

	}else{
		console.log("4 -->"+current_slider);
		current_slider = 0;
		 $( "div#slider figure.grupo" ).fadeOut( "fast", function() {
			$("div#slider figure.grupo").animate({ "left": '0%' }, "fast");
			$( "div#slider figure.grupo" ).fadeIn( "slow");
		});
	}
	
	$('.progress-bar').animate({ width: '1280px' }, 8000, "linear", slideme);
	
			}
	
    }
	
	var flag=true;

	
	
	$('body').on({'mousewheel': function(e) {
		if(!flag){
			if (e.target.id == 'body') return;
			e.preventDefault();
			e.stopPropagation();
		}

    }
})
	
	function abrircaja(num){
		if (flag) {
			$(".overlay").show();
			$(".postulaaqui").show("slow");
			$("div#slider figure.grupo figure:eq("+num+")").find(".textos span").hide();
			$("div#slider figure.grupo figure:eq("+num+")").find(".textos").animate({ "width": '350px' }, "slow");
			$("div#slider figure.grupo figure:eq("+num+")").find(".eventos").fadeIn("slow");
			//$("div#slider figure.grupo figure:eq("+num+")").find(".eventos").show("slow");
			$("div#slider figure.grupo figure:eq("+num+")").find(".textos p").show("slow");
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos").css("background","rgba(0,0,0,0.3)");
			$('.progress-bar').hide();
			$('.progress-bar').pause();
			slider = 0;
			$(".row0").animate({ height: '550px' }, "slow");
			$(".row0").clearQueue();
			
			$("body").css("overflow","hidden");
			flag = false;
		}
	}
	
	function cerrarcaja(){
		if (!flag) {
			$(".postulaaqui").hide();
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos span").show("slow");
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos").animate({ "width": '600px' }, "slow");
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".eventos").hide();
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos p").hide();
			$(".row0").animate({ "height": '390px' }, "slow");
			$('.progress-bar').show();
			$('.progress-bar').resume();
			slider = 1;
			$(".overlay").hide();
			$("body").css("overflow","visible");
			flag = true;
		}
	}

	slideme();
	
	$("#link_casa").click(function(){
		current_slider = -1;
		slideme();
		abrircaja(1);
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
		
	})
	
	$("#link_estudios").click(function(){
		current_slider = 0;
		slideme();
		abrircaja(0);
		$("html, body").animate({ scrollTop: 0 }, "slow");

		<?php
		if($tiemporestante < 0){
		?>
		//$(".postulaaqui").hide();
		<?php
		}
		?>

		return false;

	})
	
	$("#minimizar").click(function(){
	
	if($('.fixedContent').is(':visible')){
		$(".fixedContent").hide();
		$(".chatbox").hide();
		$(this).html("&#9632;");
	}else{
		$(".fixedContent").show();
		$(".chatbox").show();
		$(this).html("&#9644;");
	}
		
	})
	
	
	$("#link_buscar").click(function(){
		
		<?php
		//echo "console.log('Restante: ".$tiemporestante."');";
		//if($tiemporestante > 0 || isset($_GET["adminme"])){
		?>
		//alert(111);
		//$(".mensajeestados").show().html("Aun no ha comenzado el proceso de postulación.");
		//return false;
		
		var codigo = $("#rutconsultar").val();
		$(".mensajeestados").hide();
		
		if(codigo=="" || codigo.length < 7){ 
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("Debes ingresa un codigo valido.");
			$("#rutconsultar").focus();
			return false;
		} /*
		var rutA = rut.split("-");
		if(rutA[0].length<6){
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("Codigo Incorrecto");
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
                return;
        }*/
		
		var dataString = "c="+codigo;
		
		$.ajax({
			type: "GET",
			url: "pages/existe_codigoticket.php",
			data: dataString,
			async: false,
			success: function (data) {
				if (window.console) console.log('--->DEBUG existe_codigoticket: '+data);
				if (data == "1") {
					
						var page = "estado.php?r="+codigo;
						console.log(page);
						$("#estadobecas").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="yes" src="' + page + '" width="100%" height="100%"></iframe>').dialog({ 
						autoOpen: true, 
						closeOnEscape: false, 
						modal:true, 
						height: '450',
						width:'580', 
						draggable: false,
						resizable: false,
						open: function(event, ui) {
							$(this).css({'max-height': $(document).height()-200, 'overflow-y': 'hidden'}); 
							$(this).css('overflow', 'hidden');
							$(".ui-dialog-title").show();
						} });					
				}else{
					//alert("Los resultados de las postulaciones serán publicados el día 15 de Julio de 2016.");
					$(".mensajeestados").show().html("Codigo No encontrado.");
				}	
			}
		});
		
		<?php
		//}else{
		?>
		//alert("Los resultados de las postulaciones serán publicados el día 15 de Julio de 2016.");
		<?php
		//}
		?>
	})
	
	
	
	
	
	$(".overlay").click(function(){
		cerrarcaja();
	})
	
	$(".postulasalir").click(function(){
		cerrarcaja();
	})
	
	
	$("#link_chat").click(function(){
		$("#chatme").fadeIn();
	})
		
	$(".postulaaqui").click(function(){
		<?php
		//echo "alert('".isset($_GET["adminme"])."');";
		if(($tiemporestante > 0) || (isset($_GET["adminme"])) ){
		?>

		beca = $(this).attr("rel");
		//cerrarcaja();
		$("#idiframe").hide();
		data = "b="+beca;
		$("#idiframe").attr("src", "login.php?"+data+"&t=" + new Date().getTime());
		$("#dialog").dialog({height: '310', width: 500,minWidth:500});
		$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
		notyStatus = null
		$("#dialog").dialog("open");
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		$("#idiframe").fadeIn();

		<?php
		}else{
		?>
		alert("info");
		alert("Los resultados de las postulaciones serán publicados el día 15 de Julio de 2016.");
		<?php
		}
		?>
	})
	
	
	
	$(".link_pasoapaso_todas").click(function(){
		var beca = $(this).attr("rel");
		$("html").css("overflow-y","hidden");
		if(beca=="2"){
			var page = "files/INSTRUCCIONES PASO A PASO BES VP.pdf";
		}
		$("#basespdf").attr("title","Documento");
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})

	
	$("#link_frecuentes_educacion").click(function(){
		$("html").css("overflow-y","hidden");
		var page = "files/PREGUNTAS FRECUENTES VP.pdf";
		$("#basespdf").attr("title","Documento");
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})
	
	$("#link_frecuentes_vivienda").click(function(){
		$("html").css("overflow-y","hidden");
		var page = "files/PREGUNTAS FRECUENTES 2015 FONDO DE VIVIENDA.pdf";
		$("#basespdf").attr("title","Documento");
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})
	
	$(".basesaqui").click(function(){
		var tipob = $(this).attr("rel");
		$("html").css("overflow-y","hidden");
		
		var page = "files/REGLAMENTO 2016 FONDO DE VIVIENDA.pdf";
		if(tipob == "2"){
			page = "files/REGLAMENTO 2017 BECAS ESTUDIOS.pdf";
		}
		
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		$("#basespdf").attr("title","Documento");
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})
	
	
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

<div id="dialog" class="hidden" title="Acceso Becas"><p></p></div>
<div id="basespdf" class="hidden" title="Bases"><p></p></div>
<div id="estadobecas" class="hidden" title="Estado Solicitud"><p></p></div>






<section id="content" role="main">

<div class="row0">


<div id="slider">

<figure class="grupo">
	
	<figure>
	    <img src="img/banner1.jpg">
		<figcaption>
		<div class="textos">
		<h1>Becas de Educación Superior Año 2017</h1>
		<span>Entregaremos becas de excelencia académica de educación superior, para hijos de trabajadores contratistas y/o subcontratistas.</span>
		<p>Entregaremos becas de excelencia académica de educación superior, para hijos de trabajadores contratistas y/o subcontratistas. Te invitamos a que puedas conocer las bases de este beneficio y postular a través de este formulario electrónico. <?php if(isset($_GET["adminme"])){  ?><div class="postulaaqui" style="display:none;" rel="2">POSTULA AQUÍ</div> <?php } ?></p><div class="limpiar"></div>
		</div>
		<div class="eventos">
		<blockquote><span>17<br>
		ABRIL</span><span>&nbsp;al&nbsp;</span><span>17<br>
		MAYO</span>
		<p>Postulaciones y entrega de antecedentes <strong style="text-decoration:underline;"><?php //echo $days; ?> terminado</strong>.</p></blockquote>
		<blockquote><span>19<br>
		JUNIO</span>
		  <p>Publicación de resultados de las postulaciones (válidas / con reparos).</p></blockquote>
		<blockquote><span>DESDE 27<br>
		JUNIO</span>
		  <p>Fecha pago Becas Adjudicadas (primera etapa).</p></blockquote>
		<div class="limpiar"></div>
		<div class="basesaqui" rel="2">VER LAS BASES</div>
        <div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
        <div class="div-to-display">
          <span>Para postular Necesitas: </span>
      <ul id="listado_requisitos">

      	<li>1.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Nacimiento para Asignación familiar</a></li>
		<li>2.- <a style="color:black;" href="#" >Certificado de Alumno Regular</a></li>
		<li>3.- <a style="color:black;" href="#" >Concentración de Notas</a></li>

    </ul></div></div>
        <div class="prerequisitos" id="link_frecuentes_educacion">PREGUNTAS FRECUENTES</div>
         <div class="prerequisitos link_pasoapaso_todas" rel="2">PASO A PASO</div>
		<div class="limpiar"></div>
		<div class="postulasalir">SALIR</div>
		</div>
		</figcaption>
	</figure>
</figure>

<div class="progress-bar"></div>
</div>
</div>

<section class="row1">
<div class="opcionbecas"><div class="centerbecas"><div id="link_estudios"  style="" class="becaselije">BECAS DE EDUCACIÓN SUPERIOR 2017</div></div></div>
<div class="limpiar"></div>
</section>
<section class="row2">
<div id="triangulos"></div>
</section>


<section class="col1">
<?php if($daysv3 < 0){ ?>
<h2>Conoce el Estado de tu Postulación </h2>
<div class="estadopostulacion">
<form class="stdform">
<div style="color:white;  font-family:inherit;">Ingresa el Rut (sin DV) del Trabajador Codelco VP</div>
<div class="control-group info">
                          <div class="controls">
                           
                            <input type="text" class="upper" id="rutconsultar" maxlength="13" placeholder="">
                            <span class="help-inline"><div class="becastipo" id="link_buscar" style="float:left">Buscar</div></span>                          </div>
						  <small>Ejemplo: 16789211</small>
                          <div class="mensajeestados">						  </div>
                        </div>
</form>
</div>
<?php } ?>
<!-- <div class="postula"><img src="postula.png"></div> -->
</section>

<section class="col2">

<h2 style="visibility:hidden;">Conoce nuestro video </h2>
<div class="video" style="visibility:hidden;"><img src="img/video.jpg" alt="Video Becas"></div>
</section>

<section class="col3">

<h2>¿Necesitas Ayuda?</h2>
<div class="ayuda"></div>
<div class="limpiar"></div>

<!--<h3><span>TELÉFONOS DE CONTACTO</span> <div class="limpiar"></div>222506787 (Alicia Valenzuela)<br> 223922361 (Mabel Gómez)</h3>-->
<h3 style="background-color: white;     color: black; padding: 5px;">
<strong>Fecha Pago Beca:</strong> 27-06-2017<br>
<strong>Lugar:</strong> Cualquier sucursal del Banco Chile<br>
<strong>Tipo pago:</strong> Vale Vista<br>
<strong>Medio Cobro:</strong> Carnet identidad del postulante<br>
<h3>

<h3><span>CORREO DE CONTACTO</span> ayuda@oticdelaconstruccion.cl</h3>
<!--<h3><span>DESCARGA</span> <A href="http://get.adobe.com/es/reader/" target="_blank">ADOBE PDF</A></h3>-->
</section>

<!-- <section class="row3">

</section>
<section class="row4">

</section> -->
</section>

<div id="chatme">
    <div class="fixedHeader">Chat <!--<div style="float:right;"> <a href="#" onClick="minimizar();" style="cursor:help;">&#9644;</a></div>--></div>
    <div class="fixedContent">
	<iframe id="iframe_chat" src="" scrolling="no"></iframe>
	<!--<div class="chat-messages">
                                <ul>
                                    <li>
                                        <span class="chat-msg-time"><a href="#">Callcenter</a></span>
                                        Hola Francisco !
                                    </li>
                                    <li class="chat-msg-user">
                                        <span class="chat-msg-time"><strong>TU</strong></span>
                                        Hola, Quisiera Saber sobre la Beca de la vivienda.
                                    </li>
                                    <li>
                                        <span class="chat-msg-time"><a href="#">Callcenter</a></span>
                                        Claro, Cuéntame que necesitas ?
                                    </li>
                                </ul>
                            </div>-->
	
	</div>
    <div class="chatbox" style="display:none;">
        <textarea class="userinput" style="height: 16px; " placeholder="Escriba Aqui"></textarea>            
    </div>
</div>
</header>
</body>
</html>