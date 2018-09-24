<?php include("../conexion/conecta.php");
header('Content-typ: content="text/html; charset=UTF-8');

$id = -1;
if(isset($_GET["i"])){
$id = $_GET["i"];
}

$paso = -1;
if(isset($_GET["p"])){
$paso = $_GET["p"];
}

if(isset($_GET["b"])){
$beca = $_GET["b"];
}

if($beca == "1"){
	$query = "select * from  listar_maestro_postulaciones where IDPOSTULACION = ".$id;
}
if($beca == "2"){
	$query = "select * from  listar_maestro_postulaciones_educacion where IDPOSTULACION = ".$id;
}
//echo $query;

$result = $db->query($query);
if($result){
    while ($row = $result->fetch_object()){
		if($paso == 1){
		    echo '<div style="float:left"><label>RUT TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->RUT_TRABAJADOR.'" /></div>';
		    echo '<div style="float:left"><label>DV TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->DV_TRABAJADOR.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>NOMBRE TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->NOMBRE_TRABAJADOR.'" /></div>';
		    echo '<div style="float:left"><label>PATERNO TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->PATERNO_TRABAJADOR.'" /></div><div style="height:10px" class="clear"></div>';		
		    echo '<div style="float:left"><label>MATERNO TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->MATERNO_TRABAJADOR.'" /></div>';	
		    echo '<div style="float:left"><label>FECHA_NACIMIENTO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->FECHA_NACIMIENTO.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>SEXO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->SEXO.'" /></div>';
		    echo '<div style="float:left"><label>DIRECCION</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->DIRECCION.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>NUM_DIRECCION</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->NUM_DIRECCION.'" /></div>';	
		    echo '<div style="float:left"><label>DEPTO_DIRECCION</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->DEPTO_DIRECCION.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>VILLA_DIRECCION</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->VILLA_DIRECCION.'" /></div>';
		    echo '<div style="float:left"><label>CORREO_TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->CORREO_TRABAJADOR.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>FONO_TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->FONO_TRABAJADOR.'" /></div>';	
		    echo '<div style="float:left"><label>CELU_TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->CELU_TRABAJADOR.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>REGION_TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->REGION_NOMBRE.'" /></div>';
		    echo '<div style="float:left"><label>COMUNA_TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->COMUNA_NOMBRE.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>RENTA_TRABAJADOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="$'.number_format($row->RENTA_TRABAJADOR,0,',','.').'" /></div>';	
		    echo '<div style="float:left"><label>INTEGRANTES</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->INTEGRANTES.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>ESTADO_CIVIL</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->ESTADO_CIVIL.'" /></div>';
			
		}else if($paso == 2){
		    echo '<div style="float:left"><label>RUT_EMPRESA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->RUT_EMPRESA.'" /></div>';
		    echo '<div style="float:left"><label>DV_EMPRESA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->DV_EMPRESA.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>TIPO_EMPRESA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->TIPO_EMPRESA.'" /></div>';
		    echo '<div style="float:left"><label>RAZONSOCIAL</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->RAZONSOCIAL.'" /></div><div style="height:10px" class="clear"></div>';		
		    echo '<div style="float:left"><label>CORREO_EMPRESA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->CORREO_EMPRESA.'" /></div>';	
		    echo '<div style="float:left"><label>FONO_EMPRESA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->FONO_EMPRESA.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>CONTRATO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->CONTRATO.'" /></div>';
		    echo '<div style="float:left"><label>FECHA_CONTRATO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->FECHA_CONTRATO.'" /></div><div style="height:10px" class="clear"></div>';
		    echo '<div style="float:left"><label>DIVISION</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->DIVISION.'" /></div>';				
		}else if($paso == 3){
			if($beca == "1"){
				echo '<div style="float:left"><label>DESTINO_FONDO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->DESTINO_FONDO.'" /></div>';
				echo '<div style="float:left"><label>VIVIENDA_DIRECCION</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->VIVIENDA_DIRECCION.'" /></div><div style="height:10px" class="clear"></div>';
				echo '<div style="float:left"><label>VIVIENDA_NUMERO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->VIVIENDA_NUMERO.'" /></div>';
				echo '<div style="float:left"><label>VIVIENDA_DEPTO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->VIVIENDA_DEPTO.'" /></div><div style="height:10px" class="clear"></div>';		
				echo '<div style="float:left"><label>VIVIENDA_VILLA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->VIVIENDA_VILLA.'" /></div>';	
				echo '<div style="float:left"><label>VIVIENDA_COMUNA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->COMUNA_VIVIENDA.'" /></div><div style="height:10px" class="clear"></div>';
				echo '<div style="float:left"><label>VIVIENDA_REGION</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->REGION_VIVIENDA.'" /></div>';
			}else if($beca == "2"){
				echo '<div style="float:left"><label>HIJOS EN EDUCACION SUPERIOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->HIJOSEDSUP_TRABAJADOR.'" /></div>';
				echo '<div style="float:left"><label>TIPO POSTULANTE</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->TIPO_POSTULANTE.'" /></div><div style="height:10px" class="clear"></div>';
				echo '<div style="float:left"><label>RUT BENEFICIARIO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->RUT_POSTULANTE."-".$row->DV_POSTULANTE.'" /></div>';
				echo '<div style="float:left"><label>NOMBRE BENEFICIARIO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->NOMBRE_POSTULANTE." ".$row->PATERNO_POSTULANTE." ".$row->MATERNO_POSTULANTE.'" /></div><div style="height:10px" class="clear"></div>';		
				echo '<div style="float:left"><label>ENSENANZA QUE CURSA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->ENSENA_POSTULANTE.'" /></div>';	
				echo '<div style="float:left"><label>ENSENANZA ANTERIOR</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->ANTENSENA_POSTULANTE.'" /></div><div style="height:10px" class="clear"></div>';
				echo '<div style="float:left"><label>PROMEDIO NOTAS</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->PROMEDIONOTAS_POSTULANTE.'" /></div>';
				echo '<div style="float:left"><label>ESTABLECIMIENTO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->ESTABLECIMIENTO_POSTULANTE.'" /></div>';
				echo '<div style="float:left"><label>CARRERA</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->CARRERA_POSTULANTE.'" /></div>';
				echo '<div style="float:left"><label>FECHA NACIMIENTO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->NACIMIENTO_POSTULANTE.'" /></div>';
				echo '<div style="float:left"><label>SEXO</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$row->SEXO_POSTULANTE.'" /></div>';
			}
		}else if($paso == 4){
			if($beca == "1"){
				$acepta = $row->ACEPTA_VIVIENDA==1?"ACEPTADA":"RECHAZADA";
		    	echo '<div style="float:left"><label>CONDICIONES</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$acepta.'" /></div>';
			}else if($beca == "2"){
				$acepta = $row->ACEPTA_EDUCACION==1?"ACEPTADA":"RECHAZADA";
		    	echo '<div style="float:left"><label>CONDICIONES</label><input type="text" class="text-normal fondo-pasos" disabled="disabled" value="'.$acepta.'" /></div>';
			}
		}else if($paso == 5){
			if($beca == "1"){
			if(!empty($row->ARCHIVO_CONTRATO)){ echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=contratoempresa' target='_blank' >ARCHIVO_CONTRATO</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_CONTRATO<div style='height:20px' class='clear'></div>"; }
		   if(!empty($row->ARCHIVO_LIQ1)){ echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=liquidaciones1' target='_blank' >LIQUIDACIONES 1</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_LIQ1<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_LIQ2)){ echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=liquidaciones2' target='_blank' >LIQUIDACIONES 2</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_LIQ2<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_LIQ3)){ echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=liquidaciones3' target='_blank' >LIQUIDACIONES 3</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_LIQ3<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_DECLARACION)){  echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=declaracion' target='_blank' >DECLARACION JURADA</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_DECLARACION<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_PROMESA)){ echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=promesa' target='_blank' >PROMESA DE COMPRA</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_PROMESA<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_PROPIEDAD)){  echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=propiedad' target='_blank' >CERTIFICADO DE PROPIEDAD</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_PROPIEDAD<div style='height:20px' class='clear'></div>"; }
		     if(!empty($row->ARCHIVO_DEUDA)){ echo "<a href='../pages/ver_archivo.php?v=".$row->IDVIVIENDA."&f=deuda' target='_blank' >CERTIFICADO DE DEUDA</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_DEUDA<div style='height:20px' class='clear'></div>"; }
			 }else if($beca == "2"){
			// if(!empty($row->ARCHIVO_CONTRATO)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=contratoempresa' target='_blank' >ARCHIVO_CONTRATO</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_CONTRATO<div style='height:20px' class='clear'></div>"; }
		   //if(!empty($row->ARCHIVO_LIQ1)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=liquidaciones1' target='_blank' >LIQUIDACIONES 1</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_LIQ1<div style='height:20px' class='clear'></div>"; }
		   // if(!empty($row->ARCHIVO_LIQ2)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=liquidaciones2' target='_blank' >LIQUIDACIONES 2</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_LIQ2<div style='height:20px' class='clear'></div>"; }
		   // if(!empty($row->ARCHIVO_LIQ3)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=liquidaciones3' target='_blank' >LIQUIDACIONES 3</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN ARCHIVO_LIQ3<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_CERT_ALUMNO)){  echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=regular' target='_blank' >CERTIFICADO ALUMNO</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN CERTIFICADO ALUMNO<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_CONC_NOTAS)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=certnotas' target='_blank' >CONCENTRACION DE NOTAS</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN CONCENTRACION DE NOTAS<div style='height:20px' class='clear'></div>"; }
		    if(!empty($row->ARCHIVO_CERT_NAC)){  echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=certnac' target='_blank' >CERTIFICADO DE NACIMIENTO</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN CERTIFICADO DE NACIMIENTO<div style='height:20px' class='clear'></div>"; }
		    // if(!empty($row->ARCHIVO_CERT_MATRI)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=certmatri' target='_blank' >CERTIFICADO DE MATRIMONIO</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN CERTIFICADO DE MATRIMONIO<div style='height:20px' class='clear'></div>"; }
			//if(!empty($row->ARCHIVO_DECLARA)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=declaracion' target='_blank' >DECLARACION JURADA</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN DECLARACION JURADA<div style='height:20px' class='clear'></div>"; }
		//	if(!empty($row->ARCHIVO_SEGUROCOMP)){ echo "<a href='../pages/ver_archivoestudios.php?v=".$row->IDEDUCACION."&f=decljurada' target='_blank' >SEGURO COMPLEMENTARIO</a><div style='height:20px' class='clear'></div>"; }else{ echo "SIN SEGURO COMPLEMENTARIO<div style='height:20px' class='clear'></div>"; }
			 
			 }

		}
		
    }
     $result->close();
     $db->next_result();
}
else echo($db->error);
$db->close();


 ?>