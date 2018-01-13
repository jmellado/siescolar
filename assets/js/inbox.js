$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	
	id_persona = $("#id_persona").val();


	$("#form_mensajes").submit(function (event) {
		
		event.preventDefault();
		if($("#form_mensajes").valid()==true){

			$.ajax({

				url:$("#form_mensajes").attr("action"),
				type:$("#form_mensajes").attr("method"),
				data:$("#form_mensajes").serialize(),
				success:function(respuesta) {

					if (respuesta==="registroguardado") {
						
						toastr.success('Mensaje Enviado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_mensajes")[0].reset();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Mensaje No Enviado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="nohaydestinatarios"){
						
						toastr.warning('Debe Seleccionar Destinatarios.', 'Success Alert', {timeOut: 3000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}

						
				}

			});

		}else{

			toastr.warning('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}

	});

	$("#form_tareas").submit(function (event) {
		
		event.preventDefault();
		if($("#form_tareas").valid()==true){

			$.ajax({

				url:$("#form_tareas").attr("action"),
				type:$("#form_tareas").attr("method"),
				data:$("#form_tareas").serialize(),
				success:function(respuesta) {

					if (respuesta==="registroguardado") {
						
						toastr.success('Tarea Creada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_tareas")[0].reset();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Tarea No Creada.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="nohaydestinatarios"){
						
						toastr.warning('Debe Seleccionar Destinatarios.', 'Success Alert', {timeOut: 3000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}

						
				}

			});

		}else{

			toastr.warning('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}

	});

	$("#form_eventos").submit(function (event) {
		
		event.preventDefault();
		if($("#form_eventos").valid()==true){

			$.ajax({

				url:$("#form_eventos").attr("action"),
				type:$("#form_eventos").attr("method"),
				data:$("#form_eventos").serialize(),
				success:function(respuesta) {

					if (respuesta==="registroguardado") {
						
						toastr.success('Evento Creado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_eventos")[0].reset();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Evento No Creado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="nohaydestinatarios"){
						
						toastr.warning('Debe Seleccionar Destinatarios.', 'Success Alert', {timeOut: 3000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}

						
				}

			});

		}else{

			toastr.warning('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}

	});

	//***************************************************** FUNCIONES MENSAJES *************************************************************
	$("#btn_buscar_destinatario_m").click(function(){

		$("#modal_agregar_destinatario_m").modal();
		llenarcombo_cursos_profesorI(id_persona);
        $("#check_todos_m").prop('checked',0);
    });

    $("#id_curso_m").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
 
    	llenarcombo_asignaturas_profesorI(id_persona,id_curso);

    	mostrarestudiantes_m("","","","");
    	$("#paginacion_estudiante_m").hide();
    	$("#check_todos_m").prop('checked',0);
    });

    $("#id_asignatura_m").change(function(){
    	
    	if ($(this).val() == "") {
	    	mostrarestudiantes_m("","","","");
	    	$("#check_todos_m").prop('checked',0);
	    	$("#paginacion_estudiante_m").hide();
	    }
	    else{

	    	id_curso = $("#id_curso_m").val();
	    	mostrarestudiantes_m("",1,5,id_curso);
	    }
    });

    /*$("#btn_buscar_notificacion").click(function(event){
		
       mostrarnotificaciones("",1,5);
    });*/

    $("#buscar_estudiante_m").keyup(function(event){

    	buscar = $("#buscar_estudiante_m").val();
		//valorcantidad = $("#cantidad_estudianteI").val();
		id_curso = $("#id_curso_m").val();
		$("#check_todos_m").prop('checked',0);
		$("#paginacion_estudiante_m").hide();
		mostrarestudiantes_m(buscar,1,5,id_curso);
		
    });

    /*$("#cantidad_estudianteI").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_estudianteI").val();
    	id_curso = $("#id_cursoI").val();
    	$("#paginacion_estudianteI").hide();
    	mostrarestudiantesI(buscar,1,valorcantidad,id_curso);
    });*/

    //Resetear Formulario Al Cerrar El Modal
    $("#modal_agregar_destinatario_m").on('hidden.bs.modal', function () {
        
        $("#id_curso_m").val("");
        $("#id_asignatura_m").val("");
        $("#buscar_estudiante_m").val("");
        $("#check_todos_m").prop('checked',0);
        $("#paginacion_estudiante_m").hide();
        mostrarestudiantes_m("","","","");
    });


    $("#check_todos_m").change(function () {
    	
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  	});


  	$("#btn_agregar_estudiantes_m").click(function(event){

  		var acudientes = document.getElementsByName("acudiente[]");
  		var acudientes_seleccionados = [];
  		
  		if (acudientes.length > 0) {

  			for(i = 0; i < acudientes.length; i++){

       			if(acudientes[i].checked){

	       			acudientes_seleccionados.push(acudientes[i].value);
	       			$("#total_destinatario_m").val(acudientes_seleccionados.length+" Estudiantes");
	       		}
       			
       		}

       		if (acudientes_seleccionados.length > 0) {

	       		html ="";
	       		html +="<input type='text' value='"+$("#id_asignatura_m").val()+"' name='id_asignatura_destinatario'>";

	       		for(j = 0; j < acudientes_seleccionados.length; j++){

	       			html +="<input type='text' value='"+acudientes_seleccionados[j]+"' name='destinatario[]'>";
	       		}

	       		$("#lista_destinatarios_m").html(html);
	       		$("#modal_agregar_destinatario_m").modal("hide");
	       	}
	       	else{
	       		toastr.warning('Debe Seleccionar Mínimo Un Estudiante.', 'Success Alert', {timeOut: 2000});
	       	}

  		}
  		else{

  			toastr.warning('Debe Seleccionar Mínimo Un Estudiante.', 'Success Alert', {timeOut: 2000});
  		}


  	});

  	//***************************************************** FUNCIONES TAREAS *************************************************************

  	$("#btn_buscar_destinatario_t").click(function(){

		$("#modal_agregar_destinatario_t").modal();
		llenarcombo_cursos_profesorI(id_persona);
		$("#check_todos_t").prop('checked',0);
       
    });

    $("#id_curso_t").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
 
    	llenarcombo_asignaturas_profesorI(id_persona,id_curso);

    	mostrarestudiantes_t("","","","");
    	$("#paginacion_estudiante_t").hide();
    	$("#check_todos_t").prop('checked',0);
    });

    $("#id_asignatura_t").change(function(){
    	
    	if ($(this).val() == "") {
	    	mostrarestudiantes_t("","","","");
	    	$("#check_todos_t").prop('checked',0);
	    	$("#paginacion_estudiante_t").hide();
	    }
	    else{

	    	id_curso = $("#id_curso_t").val();
	    	mostrarestudiantes_t("",1,5,id_curso);
	    }
    });

    $("#buscar_estudiante_t").keyup(function(event){

    	buscar = $("#buscar_estudiante_t").val();
		//valorcantidad = $("#cantidad_estudianteI").val();
		id_curso = $("#id_curso_t").val();
		$("#check_todos_t").prop('checked',0);
		$("#paginacion_estudiante_t").hide();
		mostrarestudiantes_t(buscar,1,5,id_curso);
		
    });

    //Resetear Formulario Al Cerrar El Modal
    $("#modal_agregar_destinatario_t").on('hidden.bs.modal', function () {
        
        $("#id_curso_t").val("");
        $("#id_asignatura_t").val("");
        $("#buscar_estudiante_t").val("");
        $("#check_todos_t").prop('checked',0);
        $("#paginacion_estudiante_t").hide();
        mostrarestudiantes_t("","","","");
    });


    $("#check_todos_t").change(function () {
    	
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  	});


  	$("#btn_agregar_estudiantes_t").click(function(event){

  		var acudientes = document.getElementsByName("acudiente[]");
  		var acudientes_seleccionados = [];
  		
  		if (acudientes.length > 0) {

  			for(i = 0; i < acudientes.length; i++){

       			if(acudientes[i].checked){

	       			acudientes_seleccionados.push(acudientes[i].value);
	       			$("#total_destinatario_t").val(acudientes_seleccionados.length+" Estudiantes");
	       		}
       			
       		}

       		if (acudientes_seleccionados.length > 0) {

	       		html ="";
	       		html +="<input type='text' value='"+$("#id_asignatura_t").val()+"' name='id_asignatura_destinatario'>";

	       		for(j = 0; j < acudientes_seleccionados.length; j++){

	       			html +="<input type='text' value='"+acudientes_seleccionados[j]+"' name='destinatario[]'>";
	       		}

	       		$("#lista_destinatarios_t").html(html);
	       		$("#modal_agregar_destinatario_t").modal("hide");
	       	}
	       	else{
	       		toastr.warning('Debe Seleccionar Mínimo Un Estudiante.', 'Success Alert', {timeOut: 2000});
	       	}

  		}
  		else{

  			toastr.warning('Debe Seleccionar Mínimo Un Estudiante.', 'Success Alert', {timeOut: 2000});
  		}


  	});

  	//***************************************************** FUNCIONES EVENTOS *************************************************************

  	$("#btn_buscar_destinatario_e").click(function(){

		$("#modal_agregar_destinatario_e").modal();
		llenarcombo_cursos_profesorI(id_persona);
		$("#check_todos_e").prop('checked',0);
       
    });

    $("#id_curso_e").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
 
    	llenarcombo_asignaturas_profesorI(id_persona,id_curso);

    	mostrarestudiantes_e("","","","");
    	$("#paginacion_estudiante_e").hide();
    	$("#check_todos_e").prop('checked',0);
    });

    $("#id_asignatura_e").change(function(){
    	
    	if ($(this).val() == "") {
	    	mostrarestudiantes_e("","","","");
	    	$("#check_todos_e").prop('checked',0);
	    	$("#paginacion_estudiante_e").hide();
	    }
	    else{

	    	id_curso = $("#id_curso_e").val();
	    	mostrarestudiantes_e("",1,5,id_curso);
	    }
    });

    $("#buscar_estudiante_e").keyup(function(event){

    	buscar = $("#buscar_estudiante_e").val();
		//valorcantidad = $("#cantidad_estudianteI").val();
		id_curso = $("#id_curso_e").val();
		$("#check_todos_e").prop('checked',0);
		$("#paginacion_estudiante_e").hide();
		mostrarestudiantes_e(buscar,1,5,id_curso);
		
    });

    //Resetear Formulario Al Cerrar El Modal
    $("#modal_agregar_destinatario_e").on('hidden.bs.modal', function () {
        
        $("#id_curso_e").val("");
        $("#id_asignatura_e").val("");
        $("#buscar_estudiante_e").val("");
        $("#check_todos_e").prop('checked',0);
        $("#paginacion_estudiante_e").hide();
        mostrarestudiantes_e("","","","");
    });


    $("#check_todos_e").change(function () {
    	
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  	});


  	$("#btn_agregar_estudiantes_e").click(function(event){

  		var acudientes = document.getElementsByName("acudiente[]");
  		var acudientes_seleccionados = [];
  		
  		if (acudientes.length > 0) {

  			for(i = 0; i < acudientes.length; i++){

       			if(acudientes[i].checked){

	       			acudientes_seleccionados.push(acudientes[i].value);
	       			$("#total_destinatario_e").val(acudientes_seleccionados.length+" Estudiantes");
	       		}
       			
       		}

       		if (acudientes_seleccionados.length > 0) {

	       		html ="";
	       		html +="<input type='text' value='"+$("#id_asignatura_e").val()+"' name='id_asignatura_destinatario'>";

	       		for(j = 0; j < acudientes_seleccionados.length; j++){

	       			html +="<input type='text' value='"+acudientes_seleccionados[j]+"' name='destinatario[]'>";
	       		}

	       		$("#lista_destinatarios_e").html(html);
	       		$("#modal_agregar_destinatario_e").modal("hide");
	       	}
	       	else{
	       		toastr.warning('Debe Seleccionar Mínimo Un Estudiante.', 'Success Alert', {timeOut: 2000});
	       	}

  		}
  		else{

  			toastr.warning('Debe Seleccionar Mínimo Un Estudiante.', 'Success Alert', {timeOut: 2000});
  		}


  	});



	$("#form_mensajes").validate({

    	rules:{

    		total_destinatario:{
				required: true	

			},

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300
					

			},

			tipo:{
				required: true
		

			}

		}


	});

	$("#form_tareas").validate({

    	rules:{

    		total_destinatario:{
				required: true	

			},

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300
					

			},

			fecha_limite:{
				required: true,
				date: true
		

			}

		}


	});

	$("#form_eventos").validate({

    	rules:{

    		total_destinatario:{
				required: true	

			},

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300
					

			},

			fecha_inicio:{
				required: true,
				date: true
		

			},

			hora_inicio:{
				required: true
		

			},

			fecha_fin:{
				required: true,
				date: true
		

			},

			hora_fin:{
				required: true
		

			}

			//time: "required time"

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");
	/*$.validator.addMethod("time", function(value, element) {  
	return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(value);  
	}, "Please enter a valid time.");*/


}


function llenarcombo_cursos_profesorI(valor){

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
				
				$("#cursos_inbox1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorI(valor,valor2){

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
				
				$("#asignaturas_inbox1 select").html(html);
		}

	});
}


function mostrarestudiantes_m(valor,pagina,cantidad,id_curso){

	$.ajax({
		url:base_url+"inbox_controller/mostrarestudiantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.estudiantes.length; i++) {
					html +="<tr><td><input type='checkbox' name='acudiente[]' value='"+registros.estudiantes[i].id_acudiente+"'></td><td>"+[i+1]+"</td><td>"+registros.estudiantes[i].nombres+"</td><td>"+registros.estudiantes[i].apellido1+"</td><td>"+registros.estudiantes[i].apellido2+"</td><td style='display:none'><a class='btn btn-success' href="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-edit'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				
				$("#lista_estudiantes_m tbody").html(html);

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
				$(".paginacion_estudiante_m").html(paginador);

			}

	});

}


function mostrarestudiantes_t(valor,pagina,cantidad,id_curso){

	$.ajax({
		url:base_url+"inbox_controller/mostrarestudiantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.estudiantes.length; i++) {
					html +="<tr><td><input type='checkbox' name='acudiente[]' value='"+registros.estudiantes[i].id_acudiente+"'></td><td>"+[i+1]+"</td><td>"+registros.estudiantes[i].nombres+"</td><td>"+registros.estudiantes[i].apellido1+"</td><td>"+registros.estudiantes[i].apellido2+"</td><td style='display:none'><a class='btn btn-success' href="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-edit'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				
				$("#lista_estudiantes_t tbody").html(html);

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
				$(".paginacion_estudiante_t").html(paginador);

			}

	});

}


function mostrarestudiantes_e(valor,pagina,cantidad,id_curso){

	$.ajax({
		url:base_url+"inbox_controller/mostrarestudiantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.estudiantes.length; i++) {
					html +="<tr><td><input type='checkbox' name='acudiente[]' value='"+registros.estudiantes[i].id_acudiente+"'></td><td>"+[i+1]+"</td><td>"+registros.estudiantes[i].nombres+"</td><td>"+registros.estudiantes[i].apellido1+"</td><td>"+registros.estudiantes[i].apellido2+"</td><td style='display:none'><a class='btn btn-success' href="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-edit'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				
				$("#lista_estudiantes_e tbody").html(html);

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
				$(".paginacion_estudiante_e").html(paginador);

			}

	});

}