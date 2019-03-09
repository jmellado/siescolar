$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	
	

	// este metodo permite enviar la inf del formulario
	$("#form_logrosAL_insertar").submit(function (event) {
		
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario

		if($("#form_logrosAL_insertar").valid()==true){
			if(validarCampoNotaAL()==true){
				if(validarLogros()==true){
					$.ajax({

						url:$("#form_logrosAL_insertar").attr("action"),
						type:$("#form_logrosAL_insertar").attr("method"),
						data:$("#form_logrosAL_insertar").serialize(),   //captura la info de la cajas de texto
						success:function(respuesta) {

							
							if (respuesta==="registroguardado") {
								
								toastr.success('Logros Asignados Satisfactoriamente.', 'Success Alert', {timeOut: 5000});

							}
							else if(respuesta==="registronoguardado"){
								
								toastr.error('Logros No Asignados.', 'Success Alert', {timeOut: 3000});

							}
							else if(respuesta==="nohayinformacion"){
						
								toastr.warning('No Hay Información Por Registrar.', 'Success Alert', {timeOut: 3000});	

							}
							else{

								toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
								
							}
							

								
								
						}

					});

				}else{

					toastr.warning('Debe Asignar Cuatro Logros En Total.', 'Success Alert', {timeOut: 3000});
				}	
			}else{

				toastr.warning('El Estudiante Seleccionado No Tiene Nota Ingresada.', 'Success Alert', {timeOut: 3000});
				
			}
		}	

	});


    $("#id_estudianteAL").change(function(){
    	desmarcar_checkbox();
    	id_estudiante = $(this).val();
    	periodo = $("#periodoAL").val();
		id_curso = $("#id_cursoAL").val();
		id_asignatura = $("#id_asignaturaAL").val();
		buscar_notas_estudianteAL(id_estudiante,periodo,id_curso,id_asignatura);
		logros_asignados_estudianteAL(id_estudiante,periodo,id_curso,id_asignatura);
    });


    $("#btn_buscar_profesorAL").click(function(event){
    	
    	if($("#identificacion_profesorAL").val()==""){

    		toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacion_profesorAL").val();
       		buscar_profesorAL(id);
		}
		
       
    });


    $("#identificacion_profesorAL").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacion_profesorAL").val()==""){
	        	toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacion_profesorAL").val();
       			buscar_profesorAL(id);
	       	}
    	}
		
    });


    $("#id_cursoAL").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_asignaturas_profesorAL(id_persona,id_curso);
    	ocultar_div();
    	limpiarcampo_calificacion();
    });


    $("#id_asignaturaAL").change(function(){
    	ocultar_div();
    	limpiarcampo_calificacion();
    });


    $("#periodoAL").change(function(){
    	ocultar_div();
    	limpiarcampo_calificacion();
    });


    $("#btn_ingresar_logro").click(function(){

    	if($("#form_asignar_logros").valid()==true){

    		fecha_actual = obtener_fecha_actual();
    		nombreRol = $("#rol").val();

    		if(nombreRol=="administrador"){

    			//$("#modal_ingresar_nota").modal();
    			mostrar_div();

    			id_persona = $("#id_persona").val();
	    		periodo = $("#periodoAL").val();
	    		id_curso = $("#id_cursoAL").val();
	    		id_asignatura = $("#id_asignaturaAL").val();

	    		llenarcombo_estudiantesAL(id_curso);
	    		mostrarlogros_profesorAL(periodo,id_persona,id_curso,id_asignatura);
	    		document.getElementById("id_estudianteAL").focus();

	    		$("#periodoseleAL").val(periodo);
	    		$("#id_cursoseleAL").val(id_curso);
	    		$("#id_asignaturaseleAL").val(id_asignatura);

    		}
    		else{

    			validar_fechaIngresoLogros($("#periodoAL").val(),fecha_actual);
    		}

    	}
    	

    });






	$("#form_asignar_logros").validate({

    	rules:{

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			id_persona:{
				required: true,
				digits: true	

			},

			id_curso:{
				required: true,
				digits: true

			},

			id_asignatura:{
				required: true,
				digits: true	

			}


		}


	});

	$("#form_logrosAL_insertar").validate({

    	rules:{

			id_persona:{
				required: true,
				digits: true
			}

		}


	});

	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


//Est Funcion me permite obtener los logros ingresados por un profesor para una asignatura de un respectivo grado y periodo
function mostrarlogros_profesorAL(periodo,id_persona,id_curso,id_asignatura){

	$.ajax({
		url:base_url+"asignar_logros_controller/mostrarlogros_profesor",
		type:"post",
		data:{periodo:periodo,id_persona:id_persona,id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});

				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.logros.length > 0) {

					for (var i = 0; i < registros.logros.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td><input type='checkbox' name='id_logro[]' value='"+registros.logros[i].id_logro+"'></td><td style='display:none'>"+registros.logros[i].id_logro+"</td><td>"+registros.logros[i].nombre_logro+"</td><td><textarea class='form-control' cols='80' rows='3' readonly style='resize:none'>"+registros.logros[i].descripcion_logro+"</textarea></td><td style='display:none'>"+registros.logros[i].periodo+"</td><td style='display:none'>"+registros.logros[i].id_profesor+"</td><td style='display:none'>"+registros.logros[i].id_grado+"</td><td style='display:none'>"+registros.logros[i].nombre_grado+"</td><td style='display:none'>"+registros.logros[i].id_asignatura+"</td><td style='display:none'>"+registros.logros[i].nombre_asignatura+"</td><td style='display:none'>"+registros.logros[i].ano_lectivo+"</td><td style='display:none'>"+registros.logros[i].nombre_ano_lectivo+"</td></tr>";
					};
					
					$("#lista_logrosAL tbody").html(html);
 				}
 				else{

 					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Logros Registrados..</p></td></tr>";
					$("#lista_logrosAL tbody").html(html);
 				}
				
				
			}

	});

}


function buscar_profesorAL(valor){

	$.ajax({
		url:base_url+"asignar_logros_controller/buscar_profesor",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				

				if(respuesta==="profesornoexiste"){

					toastr.warning('Profesor No Registrado.', 'Success Alert', {timeOut: 5000});
					$("#form_asignar_logros")[0].reset();
					$("#id_persona").val("");
					llenarcombo_cursos_profesorAL("");
					llenarcombo_asignaturas_profesorAL("","");
					bloquear_cajas_texto_logrosAL();
					ocultar_div();
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						id_persona = registros[i]["id_persona"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];

						$("#id_persona").val(id_persona);
	        			$("#nombres").val(nombres);
	        			$("#apellido1").val(apellido1);
	        			$("#apellido2").val(apellido2);

	        			desbloquear_cajas_texto_logrosAL();
						llenarcombo_cursos_profesorAL(id_persona);
						llenarcombo_asignaturas_profesorAL("","");
						ocultar_div();
					};
				}	
				
		
		}

	});
}


function llenarcombo_cursos_profesorAL(valor){

	$.ajax({
		url:base_url+"asignar_logros_controller/llenarcombo_cursos_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_logrosAL1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorAL(valor,valor2){

	$.ajax({
		url:base_url+"asignar_logros_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_curso:valor2},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_logrosAL1 select").html(html);
		}

	});
}



function validar_fechaIngresoLogros(nombre_periodo,fecha_actual){

	$.ajax({
		url:base_url+"asignar_logros_controller/validar_fechaIngresoLogros",
		type:"post",
		data:{periodo:nombre_periodo,fecha_actual:fecha_actual},
		success:function(respuesta) {

				if(respuesta ==="si"){


					//$("#modal_ingresar_nota").modal();
					mostrar_div();
    		
		    		id_persona = $("#id_persona").val();
		    		periodo = $("#periodoAL").val();
		    		id_curso = $("#id_cursoAL").val();
		    		id_asignatura = $("#id_asignaturaAL").val();

		    		llenarcombo_estudiantesAL(id_curso);
	    			mostrarlogros_profesorAL(periodo,id_persona,id_curso,id_asignatura);
	    			document.getElementById("id_estudianteAL").focus();

		    		$("#periodoseleAL").val(periodo);
		    		$("#id_cursoseleAL").val(id_curso);
		    		$("#id_asignaturaseleAL").val(id_asignatura);

				}
				else{
					
					toastr.warning('No Existen Fechas Para La Asignación De Logros.', 'Success Alert', {timeOut: 3000});
				}

		}

	});
}


//Esta Funcion me permite obtener los estudiantes matriculados en un respectivo curso(id_grado y id_grupo)
function llenarcombo_estudiantesAL(id_curso){

	$.ajax({
		url:base_url+"asignar_logros_controller/llenarcombo_estudiantes",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {
				//alert(""+respuesta);
				var registros = eval(respuesta);
				
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_persona"]+">"+[i+1]+[". "]+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					
				};
				
				$("#estudiantesAL1 select").html(html);
				//$(".select2").select2();
		}

	});
}

//Esta funcion me permite por cada estudiante obtener la calificacion de una asignatura en un determinado periodo
function buscar_notas_estudianteAL(id_estudiante,periodo,id_curso,id_asignatura){

	p = periodo;
	$.ajax({
		url:base_url+"asignar_logros_controller/buscar_notas_estudiante",
		type:"post",
		data:{id_estudiante:id_estudiante,periodo:periodo,id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {
				

				if(respuesta==="no"){

					limpiarcampo_calificacion();
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						if(p=="Primero"){
							calificacion = registros[i]["p1"];
							$("#calificacion").val(calificacion);
						}
						if(p=="Segundo"){
							calificacion = registros[i]["p2"];
							$("#calificacion").val(calificacion);
						}
						if(p=="Tercero"){
							calificacion = registros[i]["p3"];
							$("#calificacion").val(calificacion);
						}
						if(p=="Cuarto"){
							calificacion = registros[i]["p4"];
							$("#calificacion").val(calificacion);
						}

					};
				}	
				
		
		}

	});
}

//Esta funcion me permite por cada estudiante seleccionado, los logros asignados para una determinada asignatura
function logros_asignados_estudianteAL(id_estudiante,periodo,id_curso,id_asignatura){

	$.ajax({
		url:base_url+"asignar_logros_controller/buscar_logros_asignados",
		type:"post",
		data:{id_estudiante:id_estudiante,periodo:periodo,id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {
				
				
				if(respuesta==="no"){

					toastr.info('El Estudiante Seleccionado No Tiene Logros Asignados.', 'Success Alert', {timeOut: 2000});
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						var logros = document.getElementsByName("id_logro[]");

						for(j = 0; j < logros.length; j++){

					   		if(logros[j].value == registros[i]["id_logro1"]){

					   			logros[j].checked=1;
					   		}
					   		if(logros[j].value == registros[i]["id_logro2"]){

					   			logros[j].checked=1;
					   		}
					   		if(logros[j].value == registros[i]["id_logro3"]){

					   			logros[j].checked=1;
					   		}
					   		if(logros[j].value == registros[i]["id_logro4"]){

					   			logros[j].checked=1;
					   		}
					   		


					   	}


					};
				}	
				
		
		}

	});
}


function bloquear_cajas_texto_logrosAL(){

	$("#id_cursoAL").attr("disabled", "disabled");
	$("#id_asignaturaAL").attr("disabled", "disabled");
    $("#periodoAL").attr("disabled", "disabled");
    $("#btn_ingresar_logro").attr("disabled", "disabled");
}

function desbloquear_cajas_texto_logrosAL(){

	$("#id_cursoAL").removeAttr("disabled");
	$("#id_asignaturaAL").removeAttr("disabled");
    $("#periodoAL").removeAttr("disabled");
    $("#btn_ingresar_logro").removeAttr("disabled");

}

function obtener_fecha_actual(){
	var f = new Date();
	anio=f.getFullYear();
	mes=f.getMonth()+1;
	dia=f.getDate();


	if(dia<10) {
		dia='0'+dia
	} 

	if(mes<10) {
		mes='0'+mes
	} 
	
	fecha_actual=anio+'-'+mes+'-'+dia;

	return fecha_actual;
}


function validarCampoNotaAL(){

    var vacio = "";

   	var nota = document.getElementById("calificacion").value;

   	if(nota.length != 0){

		return true;
	}
	else{
		return false;
	}

}


function validarLogros(){

   	var logros = document.getElementsByName("id_logro[]");
   	var cont = 0; 

   	//alert("total:"+logros.length);

   	for(i = 0; i < logros.length; i++){

   		if(logros[i].checked){

   			cont = cont + 1;
   		}
   	}

   	//alert("total chek:"+cont);

   	if(cont == 4){

		return true;
	}
	else{

		return false;
	}

}


function mostrar_div(){

	div = document.getElementById('div-asignar_logros');
    div.style.display = '';

}

function ocultar_div(){

	div = document.getElementById('div-asignar_logros');
    div.style.display = 'none';
}

function desmarcar_checkbox(){

	var logros = document.getElementsByName("id_logro[]");
   	
   	for(i = 0; i < logros.length; i++){

   		logros[i].checked=0;

   	}

   
}

function limpiarcampo_calificacion(){

	$("#calificacion").val("");

}




