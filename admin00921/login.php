<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador</title>

<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<style>
.mensaje {
font-size: 13px;
padding: 3px;
margin: 5px;
margin-left: 0px;
padding-left: 3px;
background-color: #b92c34;
color: white;
display:none;
}
</style>

<!-- JavaScripts-->
<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript" src="style/js/jNice.js"></script>
<script src="style/js/jquery.bestupper.min.js" type="text/javascript"></script>
    <link href="style/css/estilo.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">

        $(document).ready(function () {

            $('#nombre').focus();
			$('#nombre').bestupper();
            $('#nombre').keyup(function (e) {
                if (e.keyCode == 13) {
                    if ($("#nombre").val() != "") {
                        $('#clave').focus();
                    } else {
                        $('#nombre').focus();
                    }
                }
            });
			
            $('#clave').keyup(function (e) {
                if (e.keyCode == 13) {
                    if ($('#clave').val() != "") {
                        $('#btn_enviar').trigger('click');
                    } else {
                        $('#clave').focus();
                    }
                }
            });


            



            $("#btn_enviar").click(function () {
                enviarFormulario();
            });

            function enviarFormulario() {
                $("#btn_enviar").hide();
                $("#debug_login").html("<img src='style/img/ajax-loader.gif'/>");
				$('.mensaje').hide().html("");

                var znombre = $("#nombre").val();
                if (znombre == "") {
                    $('.mensaje').show().html("Completa tu nombre de usuario");
                    $("#debug_login").html("");
                    $("#btn_enviar").show();
                    $('#nombre').focus();
                    return;
                }

                var zclave = $("#clave").val();
                if (zclave == "") {
                    $('.mensaje').show().html("Completa tu clave");
                    $("#debug_login").html("");
                    $("#btn_enviar").show();
                    $('#clave').focus();
                    return;
                }

                var dataString = "nombre=" + znombre + "&clave=" + zclave;

                //alert(dataString);
				if (window.console) console.log('Pages/validarlogin.php?'+dataString);

                $.ajax({
                    type: "GET",
                    url: "Pages/validarlogin.php",
                    data: dataString,
                    success: function (data) {
						if (window.console) console.log('DEBUG Pages/validarlogin.php => '+data);
                        if (data == "1") {
							document.location.href = "gestion.php";
                        } else {
                            $('.mensaje').show().html("Clave Incorrecta o Cuenta No existe.");
                            $('#clave').focus();
                            $("#debug_login").html("");
                            $("#btn_enviar").show();
                        }
                    },
                    error: function (objeto, quepaso, otroobj) {
                         $('.mensaje').show().html("Error al intentar la comunicacion. \n Contacte a su administrador.");
                        $("#debug").html(objeto.responseText);
                        $("#debug_login").html("");
                        $("#btn_enviar").show();
                    }
                });

            }


        });
    
    </script>

</head>

<body>
<div id="wrapper">
<br><br>    
        <div id="containerHolder">
        <div id="loginpic">
&nbsp;	    </div>
         <div id="loginform">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:3px;"><div align="right">Nombre</div></td>
    <td style="padding:3px;"><div align="left">
      <input type="text" id="nombre" size="10" name="nombre" maxlength="10" />
    </div></td>
  </tr>
  <tr>
    <td style="padding:3px;"><div align="right">Clave</div></td>
    <td style="padding:3px;"><div align="left">
      <input type="password" id="clave" maxlength="8" size="10" />
    </div></td>
  </tr>
  <tr>
    <td style="padding:3px;" colspan="2"><input type="button" id="btn_enviar" value="Acceder"  class="button-submit" /></td>
    </tr>
</table>
<div class="mensaje"></div>
<div id="debug_login"></div>
         
</div>

<div style="clear:both"></div>
    <div id="debug"></div>
  </div>	

     <p id="footer"></p>
</div>
</body>
</html>