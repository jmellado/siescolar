$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursos_profesorN($("#id_persona").val());

	// este metodo permite enviar la inf del formulario
	$("#form_notas_insertar").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario

		desbloquear_variables();
		p = $("#periodoN").val();
		if(validarCampoNota(p)==true){

			$.ajax({

				url:$("#form_notas_insertar").attr("action"),
				type:$("#form_notas_insertar").attr("method"),
				data:$("#form_notas_insertar").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Notas Registradas Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						mostrarnotas("",1,5,id_curso,id_asignatura);

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Notas No Registradas.', 'Success Alert', {timeOut: 3000});
		

					}
					else if(respuesta==="nohayestudiantes"){
						
						toastr.warning('No Hay Informacion Por Registrar', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="notasincorrectas"){
						
						toastr.warning('Las Notas Ingresadas Son Incorrectas.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}

					bloquear_variables();

						
						
				}

			});

		}else{

			toastr.warning('Faltan Notas Por Ingresar.', 'Success Alert', {timeOut: 3000});
			bloquear_variables();
		}

	});


    $("#cantidad_nota").change(function(){
    	valorcantidad = $(this).val();
    	mostrarnotas("",1,valorcantidad,id_curso,id_asignatura);
    });

    $("body").on("click", ".paginacion_nota li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_grado").val();
    	valorcantidad = $("#cantidad_nota").val();
		
		if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
			
			mostrarnotas("",numero_pagina,valorcantidad,id_curso,id_asignatura);
		}

    });


    $("#btn_buscar_profesorN").click(function(event){
    	
    	if($("#identificacion_profesorN").val()==""){

    		toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacion_profesorN").val();
       		buscar_profesorN(id);
		}
		
       
    });


    $("#identificacion_profesorN").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacion_profesorN").val()==""){
	        	toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacion_profesorN").val();
       			buscar_profesorN(id);
	       	}
    	}
		
    });


    $("#id_cursoN").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_asignaturas_profesorN(id_persona,id_curso);
    });


    $("#btn_ingresar_nota").click(function(){

    	if($("#form_notas").valid()==true){

    		fecha_actual = obtener_fecha_actual();
    		nombreRol = $("#rol").val();

    		if(nombreRol=="administrador"){

    			$("#modal_ingresar_nota").modal();

    			id_persona = $("#id_persona").val();
	    		periodo = $("#periodoN").val();
	    		id_curso = $("#id_cursoN").val();
	    		id_asignatura = $("#id_asignaturaN").val();

	    		mostrarnotas("",1,5,id_curso,id_asignatura);

	    		$("#periodoseleN").val(periodo);
	    		$("#id_cursoseleN").val(id_curso);
	    		$("#id_asignaturaseleN").val(id_asignatura);

    		}
    		else{

    			validar_fechaIngresoNotas($("#periodoN").val(),fecha_actual);
    		}

    	}
    	

    });


    $("#modal_ingresar_nota").on('hidden.bs.modal', function () {

        var validator = $("#form_notas_insertar").validate();
        validator.resetForm();
    });


	$("#form_notas").validate({

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

	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrarnotas(valor,pagina,cantidad,id_curso,id_asignatura){

	$.ajax({
		url:base_url+"notas_controller/mostrarnotas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				p = $("#periodoN").val();
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.notas.length; i++) {
					
					if(p=="Primero"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_estudiante[]' id='id_estudiante' value='"+registros.notas[i].id_estudiante+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' disabled><input type='hidden' name='p2[]' id='p2' value='"+registros.notas[i].p2+"'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' disabled><input type='hidden' name='p3[]' id='p3' value='"+registros.notas[i].p3+"'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' disabled><input type='hidden' name='p4[]' id='p4' value='"+registros.notas[i].p4+"'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td style='display:none'><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
					if(p=="Segundo"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_estudiante[]' id='id_estudiante' value='"+registros.notas[i].id_estudiante+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' disabled><input type='hidden' name='p1[]' id='p1' value='"+registros.notas[i].p1+"'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' disabled><input type='hidden' name='p3[]' id='p3' value='"+registros.notas[i].p3+"'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' disabled><input type='hidden' name='p4[]' id='p4' value='"+registros.notas[i].p4+"'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td style='display:none'><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
					if(p=="Tercero"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_estudiante[]' id='id_estudiante' value='"+registros.notas[i].id_estudiante+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' disabled><input type='hidden' name='p1[]' id='p1' value='"+registros.notas[i].p1+"'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' disabled><input type='hidden' name='p2[]' id='p2' value='"+registros.notas[i].p2+"'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' disabled><input type='hidden' name='p4[]' id='p4' value='"+registros.notas[i].p4+"'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td style='display:none'><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
					if(p=="Cuarto"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_estudiante[]' id='id_estudiante' value='"+registros.notas[i].id_estudiante+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' disabled><input type='hidden' name='p1[]' id='p1' value='"+registros.notas[i].p1+"'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' disabled><input type='hidden' name='p2[]' id='p2' value='"+registros.notas[i].p2+"'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' disabled><input type='hidden' name='p3[]' id='p3' value='"+registros.notas[i].p3+"'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td style='display:none'><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
				};
				
				$("#lista_notas tbody").html(html);

				linkseleccionado = Number(pagina);
				//total de registros
			    totalregistros = registros.totalregistros;
				//cantidad de registros por pagina
				cantidadregistros = registros.cantidad;
				//numero de links o paginas dependiendo de la cantidad de registros y el numero a mostrar
				numerolinks = Math.ceil(totalregistros/cantidadregistros);

				paginador="<ul class='pagination'>";

				if(linkseleccionado>1)
				{
					paginador+="<li><a href='1'>&laquo;</a></li>";
					paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";

				}
				else
				{
					paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
					paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
				}
				//muestro de los enlaces 
				//cantidad de link hacia atras y adelante
	 			cant = 2;
	 			//inicio de donde se va a mostrar los links
				pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
				//condicion en la cual establecemos el fin de los links
				if (numerolinks > cant)
				{
					//conocer los links que hay entre el seleccionado y el final
					pagRestantes = numerolinks - linkseleccionado;
					//defino el fin de los links
					pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
				}
				else 
				{
					pagFin = numerolinks;
				}

				for (var i = pagInicio; i <= pagFin; i++) {
					if (i == linkseleccionado)
						paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
					else
						paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
				}
				//condicion para mostrar el boton sigueinte y ultimo
				if(linkseleccionado<numerolinks)
				{
					paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
					paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

				}
				else
				{
					paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
					paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
				}
				
				paginador +="</ul>";
				$(".paginacion_nota").html(paginador);

			}

	});

}


function buscar_profesorN(valor){

	$.ajax({
		url:base_url+"notas_controller/buscar_profesor",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				

				if(respuesta==="profesornoexiste"){

					toastr.success('Profesor No Registrado.', 'Success Alert', {timeOut: 3000});
					$("#form_notas")[0].reset();
					$("#id_persona").val("");
					llenarcombo_cursos_profesorN("");
					llenarcombo_asignaturas_profesorN("","","");
					bloquear_cajas_texto_notas();
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

	        			desbloquear_cajas_texto_notas();
						llenarcombo_cursos_profesorN(id_persona);
						llenarcombo_asignaturas_profesorN("","","");
					};
				}	
				
		
		}

	});
}


function llenarcombo_cursos_profesorN(valor){

	$.ajax({
		url:base_url+"notas_controller/llenarcombo_cursos_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_notas1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorN(valor,valor2){

	$.ajax({
		url:base_url+"notas_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_curso:valor2},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_notas1 select").html(html);
		}

	});
}



function validar_fechaIngresoNotas(nombre_periodo,fecha_actual){

	$.ajax({
		url:base_url+"notas_controller/validar_fechaIngresoNotas",
		type:"post",
		data:{periodo:nombre_periodo,fecha_actual:fecha_actual},
		success:function(respuesta) {

				if(respuesta ==="si"){

					//alert("si existen fechas");

					$("#modal_ingresar_nota").modal();
			
		    		id_persona = $("#id_persona").val();
		    		periodo = $("#periodoN").val();
		    		id_curso = $("#id_cursoN").val();
		    		id_asignatura = $("#id_asignaturaN").val();

		    		mostrarnotas("",1,5,id_curso,id_asignatura);

		    		$("#periodoseleN").val(periodo);
		    		$("#id_cursoseleN").val(id_curso);
		    		$("#id_asignaturaseleN").val(id_asignatura);

				}
				else{
					alert("No Existen Fechas Para El Ingreso De Notas.");
				}
		}

	});
}


function bloquear_cajas_texto_notas(){

	$("#id_cursoN").attr("disabled", "disabled");
	$("#id_asignaturaN").attr("disabled", "disabled");
    $("#periodoN").attr("disabled", "disabled");
    $("#btn_ingresar_nota").attr("disabled", "disabled");
}

function desbloquear_cajas_texto_notas(){

	$("#id_cursoN").removeAttr("disabled");
	$("#id_asignaturaN").removeAttr("disabled");
    $("#periodoN").removeAttr("disabled");
    $("#btn_ingresar_nota").removeAttr("disabled");

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

function valida_nota(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9\.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function validarCampoNota(periodo){

	var resn=[];
    var resy=[];
    var vacio = "";

	if(periodo=="Primero"){
   	 	var notas = document.getElementsByName("p1[]");

   	}else if(periodo=="Segundo"){
   		var notas = document.getElementsByName("p2[]");
   	}
   	else if(periodo=="Tercero"){
   		var notas = document.getElementsByName("p3[]");
   	}
   	else{
   		var notas = document.getElementsByName("p4[]");
   	}


   	for(i = 0; i < notas.length; i++){
   		//notas[i].value != vacio && notas[i].value >= 0 && notas[i].value <= 5
   		if(notas[i].value != vacio){

   			resy.push("si")
   		}
   		else{
   			resn.push("no");
   		}


   	}

   	if(resy.length == notas.length){

		//alert("ok");
		return true;
	}
	else{
		//alert("no");
		return false;
	}

}

function valida_falla(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


function bloquear_variables(){

	$("#periodoseleN").attr("disabled", "disabled");
	$("#id_cursoseleN").attr("disabled", "disabled");
	$("#id_asignaturaseleN").attr("disabled", "disabled");

}


function desbloquear_variables(){

	$("#periodoseleN").removeAttr("disabled");
	$("#id_cursoseleN").removeAttr("disabled");
	$("#id_asignaturaseleN").removeAttr("disabled");

}