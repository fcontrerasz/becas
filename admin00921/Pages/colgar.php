<?php
 error_reporting(0);

 include("../conexion/conecta.php");

$campo = "";
 
 //tomar el idcorre y guardarlo en una variable
	//$idcorre = explode(",",$_GET["b"]);
	$idcorre = $_GET["b"];
	//230091,230093,230094
//	foreach($idcorre as $campo){
//		echo $campo.",";
//	}
 //primer nivel : 230055 / comercial: 230057,61598,169470 / operaciones : 230195 / tecnologico :230684
var_dump($idcorre);
 $allResults = array();
 $res = mssql_query("EXEC [dbo].[listar_tabulaciones_colgar] @idgestiones = N'230055,230057,230195,230684,184242,169470'");
 $result = mssql_fetch_object($res);
 
 $esprimernivel = $result->primer_nivel;
 $escomercial = $result->lista_comercial;
 $esoperacion = $result->lista_operaciones;
 $estecnologico = $result->lista_tecnologico;
	

 
 //var_dump($result);
 //$numRows = mssql_num_rows($res);
 //echo "total parametros >> ".$numRows;
 //var_dump($res);
 
 
 
 
/*
 foreach($idcorre as $campo) {
   if(trim($campo) != "") {
     $res = mssql_query(
        "SELECT g.IDGESTION FROM GESTION g
        WHERE g.IDGESTION=". $campo ." AND g.TA_TIPO IN (1) AND g.TA_SUBTIPO IN (33);" );
     $numRows = mssql_num_rows($res);
	 
	 if($res !="") {
	 	//cambia a seleccionado
		
		echo "<script> $('#colg_9').attr('checked', true);</script>";
	}
   }
 }//fin foreach
 */
 
 
/*var_dump($allResults);die;*/
?>

<?php
	header('Content-type: text/html; charset=UTF-8');
	session_start();
	/*
	$idcorre = explode(",",$_GET["b"]);
	foreach($idcorre as $campo){
		echo $campo;
	}*/
	
	
	
	
	
	
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
		<link href="../style/css/colgar.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript" src="../style/js/jquery-1.4.1.min.js"></script>
	<script type="text/javascript" src="../style/js/jNice.js"></script>
		<link href="../style/css/estilo.css" rel="stylesheet" type="text/css" />
		<script>
			//	$("#deriva").click(function () {
	//			  alert("hice clik en el select derivacion ");
	//			});
	
		$("#deriva").change(function () {
					//alert("hice clik ");
					if ($(this).attr("value") != 0) {
						$("#colg_6").attr('checked', true);
						if($(this).attr("value")=="Otro"){
							$("#verotro").show();
						}else{
							$("#verotro").hide("slow");
						}
					} else {
						$("#colg_6").attr("checked", false);
					}
				});
			function copiarllamada(data){
				var copied = window.clipboardData.getData("Text");
					if(copied.length == 18){
						var dt = new Date(); 
						var month = dt.getMonth() + 1;
						if(month<10){
							month = "0"+month;
						}
						var day = dt.getUTCDay();
						if(day<10){
							day = "0"+day;
						}
						var year = dt.getUTCFullYear();
						newdate = year + "" + month + "" + day; 
						if(copied.indexOf(newdate) > 0){
							$("#idllamada").val(copied);
						}else{
							if(data>1){
								alert("Ningún correlativo que Pegar");
							}
						}
					}else{
							if(data>1){
								alert("Ningún correlativo que Pegar");
							}
					}
			}
			
			jQuery.fn.ForceNumericOnly = function()
				{
				return this.each(function()
				{
					$(this).keydown(function(e)
					{
						var key = e.charCode || e.keyCode || 0;
						// allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
						return (
							key == 8 || 
							key == 9 ||
							key == 46 ||
							(key >= 37 && key <= 40) ||
							(key >= 48 && key <= 57) ||
							(key >= 96 && key <= 105));
					});
				});
				};
				
				$('#datacolgarcliente').click(function () {
					
					solicitudgeneral = $('#sol_gral option:selected').val();	
					comercial = $('#sol_com option:selected').val();
					reclamo = $('#t_recla option:selected').val();
					tecnologia = $('#sol_tec option:selected').val();
					operacional = $('#sol_op option:selected').val();
					derivacion = $('#deriva option:selected').val();
			
					var totalesx = 0;
					$("#frm_tabulacion :checkbox").each(function(index) {
						if($(this).is(':checked')) {
							 totalesx++;
						}
					});
					
					if(totalesx == 0){
							alert("Debes indicar un tipo de gestion para el llamado.");
							return false;
					}
					
				
					if(solicitudgeneral!="0" || comercial!="0" && reclamo!="0" &&  tecnologia!="0" &&  operacional!="0" &&  derivacion!="0" ){
						if($("#tb_llave").val()!=2){
							 alert("Debes crear una Solicitud antes de Colgar.");
							 return false;
						}
					
					}
					
					//alert("VALOR :"+$("#colg_1").is(':checked'));
					
								
					if ($("#colg_1").is(':checked')) {
						pre1 = 1;
						if (solicitudgeneral == "0") {
							alert("Debes indicar un tipo de Consulta General");
							return false;
						}
					} else {
						pre1 = 0;
					}
					
				
					if ($("#colg_2").is(':checked')) {
						pre1 = 1;
						if (comercial == "0") {
							alert("Debes indicar un tipo de Consulta Comercial");
							return false;
						}
					} else {
						pre1 = 0;
					}
					
					
					if ($("#colg_3").is(':checked')) {
						pre1 = 1;
						if (reclamo == "0") {
							alert("Debes indicar un tipo de Reclamo");
							return false;
						}
					} else {
						pre1 = 0;
					}
					
					if ($("#colg_4").is(':checked')) {
						pre1 = 1;
						if (tecnologia == "0") {
							alert("Debes indicar un tipo de Tecnologia");
							return false;
						}
					} else {
						pre1 = 0;
					}
					
					if ($("#colg_5").is(':checked')) {
						pre1 = 1;
						if (operacional == "0") {
							alert("Debes indicar un tipo de Consulta Operacional");
							return false;
						}
					} else {
						pre1 = 0;
					}
					
					if ($("#colg_6").is(':checked')) {
						pre1 = 1;
						if (derivacion == "0") {
							alert("Debes indicar un tipo de Derivacion");
							return false;
						}
					} else {
						pre1 = 0;
					}
					
					if((derivacion == "Otro") && $('#otro').val() == ""){
						alert("Debes describir la otra derivacion.");
						 return false;
					}
					
					if((reclamo == "Otro") && $('#otroreclamo').val() == ""){
						alert("Debes describir el otro reclamo.");
						 return false;
					}
					
					var data991 = $("#callcenter").val();
					var idllam = $("#idllamada").val();
					var pre991 = $("#colg_9").is(':checked');
					
					//alert(pre991);
					
					if (!pre991) {
						//alert(data991);
						if(data991 == "1"){
							 if(idllam.length < 18){
								alert("Debes ingresar el correlativo");
								$("#idllamada").focus();
								return false;
							 }
								var dt = new Date(); 
								var month = dt.getMonth() + 1;
								if(month<10){
									month = "0"+month;
								}
								var day = dt.getDate();
								if(day<10){
									day = "0"+day;
								}
								var year = dt.getUTCFullYear();
								newdate = year + "" + month + "" + day; 
								if(idllam.indexOf(newdate) > 0){
								//
								}else{
									//alert("Correlativo Incorrecto enviado:"+idllam+" vs "+newdate);
									//return false;
								}
							
						}
					}else{
						$("#idllamada").val();
						$("#tb_id").val("1");
					}
					
	
							
				   var dataString = $("#frm_tabulacion").serialize();
				   
				   //alert(dataString);
			
					$.ajax({
						type: "GET",
						url: "Pages/enviar_colgar2.php",
						data: dataString,
						success: function (data) {
							//alert(data);
							if(data>1){
								document.location.href = "gestion.php";
							} else {
								alert("ERROR");
							}
						},
						error: function (objeto, quepaso, otroobj) {
							alert("Error al intentar la comunicacion. \n Contacte a su administrador.");
							$("#botonloginsenviar").html("");
							$("#enviar").show();
						}
					});
				});
				
				$("#data_correlativo").click(function () {
					copiarllamada(2);
				});
		
			$(document).ready(function () {
			
		//	$(".ct_tab").toggle();
			$(".ct_tab").fadeIn("slow");
		
			

				var solicitudgeneral = 0;
				var comercial = 0;
				var reclamo = 0;
				var tecnologia = 0;
				var operacional = 0;
				var derivacion = 0;
				
				copiarllamada(1);
	
				
				$("#idllamada").ForceNumericOnly();
				 
				$('#colg_9').mousedown(function() {
					if (!$(this).is(':checked')) {
						this.checked = confirm("¿Estas Seguro? \n Toda la gestión será invalidada.");
					}
				});
				
				
				$('#sol_gral').change(function () {
					if ($(this).attr('value') != 0) {
						$('#colg_1').attr('checked', true);
					} else {
						$('#colg_1').attr('checked', false);
					}
				});
				
				$('#colg_1').mousedown(function() {
				var checked = $(this).attr('checked');
				$(this).attr('value', checked);
				if (checked) {
				   $('#sol_gral').val(0);
				}
				});
				
				$('#t_recla').change(function () {
					if ($(this).attr('value') != 0) {
						$('#colg_3').attr('checked', true);
						if($(this).attr('value')=="Otro"){
							$('#verotroreclamo').show("slow");
						}else{
							$('#verotroreclamo').hide("slow");
						}
					} else {
						$('#colg_3').attr('checked', false);
					}
				});
				
				$('#colg_3').mousedown(function() {
				var checked = $(this).attr('checked');
				$(this).attr('value', checked);
				if (checked) {
				   $('#t_recla').val(0);
				}
				});
				
				$('#sol_op').change(function () {
					if ($(this).attr('value') != 0) {
						$('#colg_5').attr('checked', true);
					} else {
						$('#colg_5').attr('checked', false);
					}
				});
				
				$('#colg_5').mousedown(function() {
				var checked = $(this).attr('checked');
				$(this).attr('value', checked);
				if (checked) {
				   $('#sol_op').val(0);
				}
				});
				
				$('#sol_com').change(function () {
					if ($(this).attr('value') != 0) {
						$('#colg_2').attr('checked', true);
					} else {
						$('#colg_2').attr('checked', false);
					}
				});
				
				$('#colg_2').mousedown(function() {
				var checked = $(this).attr('checked');
				$(this).attr('value', checked);
				if (checked) {
				   $('#sol_com').val(0);
				}
				});
				
				$('#sol_tec').change(function () {
					if ($(this).attr('value') != 0) {
						$('#colg_4').attr('checked', true);
					} else {
						$('#colg_4').attr('checked', false);
					}
				});
				
				$('#colg_4').mousedown(function() {
				var checked = $(this).attr('checked');
				$(this).attr('value', checked);
				if (checked) {
				   $('#sol_tec').val(0);
				}
				});
				
				//aqui se abre el textarea de otros comenatrios
				
		
			//	$("#deriva").change(function () {
	//				//alert("hice clik ");
	//                if ($(this).attr("value") != 0) {
	//                    $("#colg_6").attr('checked', true);
	//					if($(this).attr("value")=="Otro"){
	//						$("#verotro").show();
	//					}else{
	//						$("#verotro").hide("slow");
	//					}
	//                } else {
	//                    $("#colg_6").attr("checked", false);
	//                }
	//            });
				
				$('#colg_6').mousedown(function() {
				var checked = $(this).attr('checked');
				$(this).attr('value', checked);
				if (checked) {
				   $('#deriva').val(0);
				}
				});
				
		});
		
		</script>
	</head>
	<body>
	
	<form name="frm_tabulacion" id="frm_tabulacion">
	
	<table id="tabla01" class="rounded-corner" width="100%" style="padding: 0; margin:0;">
        <thead>
          <tr>
            <th colspan="4" scope="col" class="rounded-company">¿ Esta gestión se relacionó con ?</th>
          </tr>
        </thead>
        <tbody>
          <!-- INICIO GESTION PRIMER NIVEL -->
          <tr>
            <th colspan="4" scope="col" class="rounded-company">&nbsp;</th>
          </tr>
          <tr>
            <td width="3%"><input id="niveluno" name="niveluno"  type="checkbox" <?php echo $esprimernivel!=''?'checked="checked" disabled="disabled"':''; ?> /></td>
            <td width="53%" align=left style="background-color:#669999">
			<div>Primer Nivel</div>
			<div class="salto"></div>
                
                <div class="ct_tab">
                  <?
			  	$elem_niveluno = explode(',',$esprimernivel);
				foreach($elem_niveluno as $campo){
					if($campo!=""){
	            ?>
                  <li style="display: inline; font-size:9px;"><?php echo $campo; ?></li>
                  <? } } ?>
                </div></td>
          <td><!--<input id="colg_1" name="colg_1" type="checkbox"  />-->
                <input id="colg_1" name="colg_1" type="checkbox" <?php if(isset($b)) echo “checked” ?> />
                <input id="tb_id" type="hidden" name="tb_id" value="<?php echo $_GET["q"]; ?>"  />
                <input id="tb_llave" type="hidden" name="tb_llave" value="<?php echo $_GET["k"]; ?>"  />
                <input id="tb_correlativo" type="hidden" name="tb_correlativo" value="<?php echo $_GET["b"]; ?>"  />
                <input id="tb_usuario" type="hidden" name="tb_usuario" value="<?php echo $_SESSION["idusuario"]; ?>"  />            </td>
            <td align=left>Solicitud General <span>
              <select id="sol_gral" name="sol_gral">
                <option value=0>SELECCIONE</option>
                <option value="Telefonos">Telefonos</option>
                <option value="Direcciones">Direcciones</option>
                <option value="Horarios">Horarios</option>
              </select>
            </span></td>
          </tr>
          <!-- FIN GESTION PRIMER NIVEL -->
          <tr>
          <td><input id="colg_2" name="colg_2"  type="checkbox" <?php echo $escomercial!=''?'checked="checked" disabled="disabled"':''; ?> /></td>
           
		   
		   
		   
		    <td width="41%" align=left style="background-color:#999999">
			<div>Comercial</div>
			<div class="salto"></div>
                <div class="ct_tab">
                  <?
			  	$elem_comercial = explode(',',$escomercial);
				foreach($elem_comercial as $campo){
					if($campo!=""){
	            ?>
                  <li style="display: inline; font-size:9px;"><div class="salto"></div><?php echo $campo; ?></li>
                  <? } } ?>
                </div>
              </td>
            <td><input name="colg_6" type="checkbox" id="colg_6"  /></td>
            <td align=left>Otra Derivaciónes <span>
              <select id="deriva" name="deriva">
                <option value="0">SELECCIONE</option>
                <!--<option value="Mesa BEME - CCL">Mesa BEME - CCL</option>
				<option value="Emergencias">Emergencias</option>-->
                <option value="Otro">Otro</option>
              </select>
            </span></td>
          </tr>
		  <tr>
            <td colspan="2"><div id="verotroreclamo" style="display:none" >
                <textarea id="otroreclamo" name="otroreclamo" cols="40" rows="4"></textarea>
            </div></td>
            <td colspan="2"><div id="verotro" style="display:none" >
                <textarea id="otro" name="otro" cols="40" rows="4"></textarea>
            </div></td>
          </tr>
          <tr height="50px;">
            <td><input name="colg_5" type="checkbox" id="colg_5" <?php echo $esoperacion!=''?'checked="checked" disabled="disabled"':''; ?>  /></td>
            <td align=left style="background-color:#99CC66">
		<div>Operacional</div>
			<div class="salto2"></div>             
                <div class="ct_tab">
                  <?
			  	$elem_operacion = explode(',',$esoperacion);
				foreach($elem_operacion as $campo){
					if($campo!=""){
	            ?>
                  <li style="display: inline; font-size:9px;"><?php echo $campo; ?></li>
                  <? } } ?>
                </div></td>
            <td><input name="colg_11" type="checkbox" id="colg_11" style="display:none"  />
                <input name="colg_7" type="checkbox" id="colg_7"  /></td>
            <td align=left>Broma o Pitanza</td>
          </tr>
          <tr>
            <!--<td><input name="colg_3" type="checkbox" id="colg_3"  /></td>
			<td align=left>Reclamo <span>
			<select id="t_recla" name="t_recla">
			  <option value="0">SELECCIONE</option>
			  <option value="Contra Ejecutivo">Contra Ejecutivo</option>
			  <option value="Contra Sop. Operacional">Contra Sop. Operacional</option>
			  <option value="Contra Sop. Tecnologico">Contra Sop. Tecnológico</option>
			  <option value="Contra Unidad CajaVecina">Contra Unidad CajaVecina</option>
			  <option value="Otro">Otro</option>
			</select>
			</span></td>-->
                 <td><input name="colg_4" type="checkbox" id="colg_4" <?php echo $estecnologico!=''?'checked="checked" disabled="disabled"':''; ?>  /></td>
            <td align=left style="background-color:#999966">
			<div>Tecnológico</div>
			<div class="salto"></div>
                
                <div  class="ct_tab">
                  <?
			  	$elem_tecnologico = explode(',',$estecnologico);
				foreach($elem_tecnologico as $campo){
					if($campo!=""){
	            ?>
                  <li style="display: inline; font-size:9px;"><?php echo $campo; ?></li>
                  <? } } ?>
                </div></td>
            
			<td><input name="colg_10" type="checkbox" id="colg_10" style="display:none"  />
                <input name="colg_8" type="checkbox" id="colg_8"  /></td>
			<td width="41%">Se corta Llamado</td>
          </tr>
          
          <tr>
            <td><!--<input name="colg_9" type="checkbox" id="colg_9"  />-->
                <input id="colg_9" name="colg_9" type="checkbox" class="chequeado" />            </td>
            <td align=left>Prueba</td>
            <td></td>
            <td align=left></td>
          </tr>
          <tr>
            <td></td>
            <td align=left></td>
            <td><input name="colg_12" type="checkbox" id="colg_12" style="display:none"  /></td>
            <td align=left>&nbsp;
                <input name="hidden" type="hidden" id="callcenter" value="<?php echo $_SESSION["callcenter"];  ?>"  /></td>
          </tr>
          <?php if($_SESSION["callcenter"]=="1"){ ?>
          <tr>
            <td colspan="4" align="center"><label>Correlativo&nbsp;
                  <input type="text" name="idllamada" id="idllamada" maxlength="18" />
                  <input name="button" type="button" class="button-submit" id="data_correlativo" style="width:120px;" value="Pegar Correlativo" />
            </label></td>
          </tr>
          <?php } ?>
          
          <tr>
            <th colspan="4" scope="col" class="rounded-company" align="center"><center>
              <input name="button" type="button" class="button-submit" id="datacolgarcliente" value="Colgar" />
            </center></th>
          </tr>
        </tbody>
	    <div id="mensaje"></div>
	    <tfoot>
        </tfoot>
      </table>
	  <div id="debug"></div>
	
		   
	</form>
	</body>
	
	
	</html>
	
