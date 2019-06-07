$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarmatriculas("",1,5);
	llenarcombo_cursos($("#jornadaMT").val(),null);

	// este metodo permite enviar la inf del formulario
	$("#form_matriculas").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_matriculas").valid()==true){

			$.ajax({

				url:$("#form_matriculas").attr("action"),
				type:$("#form_matriculas").attr("method"),
				data:$("#form_matriculas").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Estudiante Matriculado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_matriculas")[0].reset();
						$("#identificacionN").val("");
						bloquear_cajas_texto();
						llenarcombo_cursos($("#jornadaMT").val(),null);
						llenarcombo_acudientes("");

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Estudiante No Matriculado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="matricula ya existe"){
						
						toastr.warning('El Estudiante Ya Se Encuentra Matriculado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="pensumnoexiste"){
						
						toastr.info('Estudiante No Matriculado; No Se Encontro Un Pensum Para El Grado Al Que Aspira.', 'Success Alert', {timeOut: 3000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarmatriculas("",1,5);
					//llenarcombo_cursos($("#jornadaMT").val(),null);
					//llenarcombo_acudientes("");
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_matricula").click(function(){

		$("#modal_agregar_matricula").modal();
		llenarcombo_cursos($("#jornadaMT").val(),null);
		llenarcombo_cursosA($("#jornadaMTA").val(),$("#nombre_gradoA").val());
       
    });

    $("#btn_buscar_matricula").click(function(event){
		
       mostrarmatriculas("",1,5);
    });

    $("#buscar_matricula").keyup(function(event){

    	buscar = $("#buscar_matricula").val();
		valorcantidad = $("#cantidad_matricula").val();
		mostrarmatriculas(buscar,1,valorcantidad);
		
    });

    $("#cantidad_matricula").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_matricula").val();
    	mostrarmatriculas(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_matricula li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_matricula").val();
    	valorcantidad = $("#cantidad_matricula").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarmatriculas(buscar,numero_pagina,valorcantidad);
		}	

    });

    $("body").on("click","#lista_matriculas .btn-eliminar",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("Esta Seguro De Eliminar Esta Matrícula.?")){
			eliminar_matricula(idsele);

		}

	});

	$("body").on("click","#lista_matriculas .btn-imprimir",function(event){
		event.preventDefault();
		id_matriculasele = $(this).attr("value");
		
		window.open(base_url+'matriculas_controller/generar_ficha'+'?id_matricula='+id_matriculasele, '_blank');
	});

	$("body").on("click","#lista_matriculas a",function(event){
		event.preventDefault();
		$("#modal_actualizar_matricula").modal();
		id_matriculasele = $(this).attr("href");
		id_personasele = $(this).parent().parent().children("td:eq(2)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		id_cursosele = $(this).parent().parent().children("td:eq(5)").text()
		jornadasele = $(this).parent().parent().children("td:eq(8)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(9)").text();
		id_acudientesele = $(this).parent().parent().children("td:eq(11)").text();
		parentescosele = $(this).parent().parent().children("td:eq(12)").text();
		observacionessele = $(this).parent().parent().children("td:eq(13)").text();
		fecha_matriculasele = $(this).parent().parent().children("td:eq(14)").text();
		
		//alert(""+observacionessele+fecha_matriculasele+ano_lectivosele);
		
		llenarcombo_anos_lectivos_actualizar(ano_lectivosele);
		llenarcombo_cursos_actualizar(jornadasele,ano_lectivosele,id_cursosele);
		llenarcombo_acudientes(id_acudientesele);
		$("#id_matriculasele").val(id_matriculasele);
        $("#fecha_matriculasele").val(fecha_matriculasele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#id_personasele").val(id_personasele);
        $("#id_cursosele").val(id_cursosele);
        $("#jornadaseleMT").val(jornadasele);
        $("#id_acudientesele").val(id_acudientesele);
        $("#parentescosele").val(parentescosele);
        $("#observacionessele").val(observacionessele);
        
	});

	
    $("#btn_actualizar_matricula").click(function(event){

    	if($("#form_matriculas_actualizar").valid()==true){

    		//desbloqueo los campos deshabilitados antes hacer el llamado ajax
    		desbloquear_cajas_texto_actualizar();
       		actualizar_matricula();
        }
        else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000})
			//alert($("#form_matriculas_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


    $("#btn_buscar_estudiante").click(function(event){
    	
    	if($("#identificacionN").val()==""){

    		toastr.warning('Favor Digite Un Numero De Identificación', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacionN").val();
       		buscar_estudiante(id);
		}
		
       
    });


    $("#identificacionN").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacionN").val()==""){
	        	toastr.warning('Favor Digite Un Numero De Identificación', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacionN").val();
       			buscar_estudiante(id);
	       	}
    	}
		
    });


    $("#jornadaMT").change(function(){
    	jornada = $(this).val();
    	llenarcombo_cursos(jornada,null);
    });


    $("#jornadaseleMT").change(function(){
    	jornadasele = $(this).val();
    	llenarcombo_cursos(jornadasele,null);
    });


    //Resetear Formulario Al Cerrar El Modal
    $("#modal_agregar_matricula").on('hidden.bs.modal', function () {
        $("#form_matriculas")[0].reset();
        $("#form_matriculas").valid()==true;
        $("#identificacionN").val("");
        bloquear_cajas_texto();

        $("#form_matriculasA")[0].reset();
        $("#form_matriculasA").valid()==true;
        $("#identificacionA").val("");
        bloquear_cajas_textoA();
    });


    $("#modal_actualizar_matricula").on('hidden.bs.modal', function () {
        $("#form_matriculas_actualizar")[0].reset();
        $("#form_matriculas_actualizar").valid()==true;
        llenarcombo_acudientes("");
    });


	$("#form_matriculas").validate({

    	rules:{

			id_curso:{
				required: true,
				digits: true
				//lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 30
				//lettersonly: true	

			},

			id_acudiente:{
				required: true,
				digits: true	

			},

			parentesco:{
				required: true,
				maxlength: 30
				//lettersonly: true	

			},

			observaciones:{
				required: true,
				maxlength: 80,
				minlength: 1	

			}

		}


	});

	$("#form_matriculas_actualizar").validate({

    	rules:{

			id_curso:{
				required: true,
				digits: true
				//lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 30
				//lettersonly: true	

			},

			id_acudiente:{
				required: true,
				digits: true	

			},

			parentesco:{
				required: true,
				maxlength: 30

			},

			observaciones:{
				required: true,
				maxlength: 80
					

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//************************* FUNCIONES PARA LA MATRICULA DE ESTUDIANTES ANTIGUOS *****************************


	$("#form_matriculasA").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_matriculasA").valid()==true){

			$.ajax({

				url:$("#form_matriculasA").attr("action"),
				type:$("#form_matriculasA").attr("method"),
				data:$("#form_matriculasA").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Estudiante Matriculado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_matriculasA")[0].reset();
						$("#identificacionA").val("");
						bloquear_cajas_textoA();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Estudiante No Matriculado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="matricula ya existe"){
						
						toastr.warning('El Estudiante Ya Se Encuentra Matriculado.', 'Success Alert', {timeOut: 5000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarmatriculas("",1,5);
					llenarcombo_cursosA($("#jornadaMTA").val(),$("#nombre_gradoA").val());
					llenarcombo_acudientes("");
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}

	});


	$("#btn_buscar_estudianteA").click(function(event){
    	
    	if($("#identificacionA").val()==""){

    		toastr.warning('Favor Digite Un Numero De Identificación', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacionA").val();
       		buscar_estudianteA(id);
		}
		
       
    });


    $("#identificacionA").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacionA").val()==""){
	        	toastr.warning('Favor Digite Un Numero De Identificación', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacionA").val();
       			buscar_estudianteA(id);
	       	}
    	}
		
    });


    $("#jornadaMTA").change(function(){
    	jornada = $(this).val();
    	nombre_grado = $("#nombre_gradoA").val();
    	llenarcombo_cursosA(jornada,nombre_grado);
    });


	$("#form_matriculasA").validate({

    	rules:{

			id_curso:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 30
				//lettersonly: true	

			},

			id_acudiente:{
				required: true,
				maxlength: 15	

			},

			parentesco:{
				required: true,
				maxlength: 30
				//lettersonly: true	

			},

			observaciones:{
				required: true,
				maxlength: 80,
				minlength: 1	

			}

		}


	});
}


function mostrarmatriculas(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"matriculas_controller/mostrarmatriculas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.matriculas.length > 0) {

					for (var i = 0; i < registros.matriculas.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.matriculas[i].id_matricula+"</td><td style='display:none'>"+registros.matriculas[i].id_estudiante+"</td><td>"+registros.matriculas[i].identificacion+"</td><td>"+registros.matriculas[i].nombres+" "+registros.matriculas[i].apellido1+" "+registros.matriculas[i].apellido2+"</td><td style='display:none'>"+registros.matriculas[i].id_curso+"</td><td>"+registros.matriculas[i].nombre_grado+"</td><td>"+registros.matriculas[i].nombre_grupo+"</td><td>"+registros.matriculas[i].jornada+"</td><td style='display:none'>"+registros.matriculas[i].ano_lectivo+"</td><td>"+registros.matriculas[i].nombre_ano_lectivo+"</td><td style='display:none'>"+registros.matriculas[i].id_acudiente+"</td><td style='display:none'>"+registros.matriculas[i].parentesco+"</td><td style='display:none'>"+registros.matriculas[i].observaciones+"</td><td>"+registros.matriculas[i].fecha_matricula+"</td><td>"+registros.matriculas[i].estado_matricula+"</td><td>"+registros.matriculas[i].situacion_academica+"</td><td><a class='btn btn-success' href="+registros.matriculas[i].id_matricula+" title='Ver y/o Actualizar Matrícula'><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-warning btn-imprimir' value="+registros.matriculas[i].id_matricula+" title='Imprimir Ficha De Matrícula'><i class='fa fa-print'></i></button></td><td><button type='button' class='btn btn-danger btn-eliminar' value="+registros.matriculas[i].id_matricula+" title='Eliminar Matrícula'><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_matriculas tbody").html(html);
				}
				else{
					html ="<tr><td colspan='13'><p style='text-align:center'>No Hay Estudiantes Matriculados..</p></td></tr>";
					$("#lista_matriculas tbody").html(html);
				}	

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
				$(".paginacion_matricula").html(paginador);

			}

	});

}


function eliminar_matricula(valor){

	$.ajax({
		url:base_url+"matriculas_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarmatriculas("",1,5);
				llenarcombo_cursos($("#jornadaMT").val(),null);
				
		}


	});



}

function actualizar_matricula(){

	$.ajax({
		url:base_url+"matriculas_controller/modificar",
		type:"post",
        data:$("#form_matriculas_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_matricula").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Matrícula Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Matrícula No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('No Se Puede Modificar La Información De Esta Matrícula; El Año Lectivo En La Que Fue Registrada, Se Encuentra Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_matriculas_actualizar")[0].reset();

				bloquear_cajas_texto_actualizar();
				mostrarmatriculas("",1,5);
				llenarcombo_cursos($("#jornadaMT").val(),null);

		}


	});

}

function llenarcombo_cursos(jornada,id_cursosele){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_curso"]==id_cursosele){

						html +="<option value="+registros[i]["id_curso"]+" selected>"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					}	
				};
				
				$("#curso1 select").html(html);
		}

	});
}

function buscar_estudiante(valor){

	$.ajax({
		url:base_url+"matriculas_controller/buscar_estudiante",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				

				if(respuesta==="estudiantenoexiste"){

					toastr.warning('Estudiante No Registrado.', 'Success Alert', {timeOut: 3000});
					$("#form_matriculas")[0].reset();
					$("#id_persona").val("");
					bloquear_cajas_texto();
				}
				else if(respuesta==="matricula ya existe"){

					toastr.warning('El Estudiante Ya Se Encuentra Matriculado.', 'Success Alert', {timeOut: 3000});
					$("#form_matriculas")[0].reset();
					$("#id_persona").val("");
					bloquear_cajas_texto();
				}
				else if(respuesta==="estudianteantiguo"){

					toastr.info('El N° De Identificación Corresponde A Un Estudiante Antiguo.', 'Success Alert', {timeOut: 3000});
					$("#form_matriculas")[0].reset();
					$("#id_persona").val("");
					bloquear_cajas_texto();
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

	        			desbloquear_cajas_texto();
						llenarcombo_acudientes("");
						
					};
				}	
				
		
		}

	});
}


function llenarcombo_acudientes(valor){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_acudientes",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if(registros[i]["id_persona"]==valor){

						html +="<option value="+registros[i]["id_persona"]+" selected>"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_persona"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					}
				};
				
				$("#acudiente1 select").html(html);
		}

	});
}


function llenarcombo_cursos_actualizar(jornada,ano_lectivo,id_cursosele){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursos_actualizar",
		type:"post",
		data:{jornada:jornada,ano_lectivo:ano_lectivo},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_curso"]==id_cursosele){

						html +="<option value="+registros[i]["id_curso"]+" selected>"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					}	
				};
				
				$("#curso_actualizar1 select").html(html);
		}

	});
}


function llenarcombo_anos_lectivos_actualizar(ano_lectivosele){

    $.ajax({
        url:base_url+"matriculas_controller/llenarcombo_anos_lectivos_actualizar",
        type:"post",
        success:function(respuesta) {

                var registros = eval(respuesta);

                html = "<option value=''></option>";
                for (var i = 0; i < registros.length; i++) {

                	if(registros[i]["id_ano_lectivo"]==ano_lectivosele){
                    
                    	html +="<option value="+registros[i]["id_ano_lectivo"]+" selected>"+registros[i]["nombre_ano_lectivo"]+"</option>";
                    }
                    else{

                    	html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
                    }
                };
                
                $("#ano_lectivo_actualizar1 select").html(html);
        }

    });
}


function bloquear_cajas_texto(){

	$("#id_curso").attr("disabled", "disabled");
	$("#id_acudiente").attr("disabled", "disabled");
	$("#parentesco").attr("disabled", "disabled");
    $("#jornadaMT").attr("disabled", "disabled");
    $("#observaciones").attr("disabled", "disabled");
    $("#btn_registrar_matricula").attr("disabled", "disabled");
}

function desbloquear_cajas_texto(){

	$("#id_curso").removeAttr("disabled");
	$("#id_acudiente").removeAttr("disabled");
	$("#parentesco").removeAttr("disabled");
    $("#jornadaMT").removeAttr("disabled");
    $("#observaciones").removeAttr("disabled");
    $("#btn_registrar_matricula").removeAttr("disabled");

}

function valida(e){
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

function desbloquear_cajas_texto_actualizar(){

	$("#fecha_matriculasele").removeAttr("disabled");
    $("#ano_lectivosele").removeAttr("disabled");
    $("#jornadaseleMT").removeAttr("disabled");
    $("#id_cursosele").removeAttr("disabled");
}

function bloquear_cajas_texto_actualizar(){

	$("#fecha_matriculasele").attr("disabled", "disabled");
    $("#ano_lectivosele").attr("disabled", "disabled");
    $("#jornadaseleMT").attr("disabled", "disabled");
    $("#id_cursosele").attr("disabled", "disabled");
}


//************************************** FUNCIONES PARA LA MATRICULA DE ESTUDIANTES ANTIGUOS **********************************


function buscar_estudianteA(valor){

	$.ajax({
		url:base_url+"matriculas_controller/buscar_estudianteA",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				

				if(respuesta==="estudiantenoexiste"){

					toastr.warning('Estudiante No Registrado.', 'Success Alert', {timeOut: 3000});
					$("#form_matriculasA")[0].reset();
					$("#id_personaA").val("");
					$("#nombre_gradoA").val("");
					bloquear_cajas_textoA();
				}
				else if(respuesta==="matricula ya existe"){

					toastr.warning('El Estudiante Ya Se Encuentra Matriculado.', 'Success Alert', {timeOut: 3000});
					$("#form_matriculasA")[0].reset();
					$("#id_personaA").val("");
					$("#nombre_gradoA").val("");
					bloquear_cajas_textoA();
				}
				else if(respuesta==="estudiantenuevo"){

					toastr.info('El N° De Identificación No Corresponde A Un Estudiante Antiguo.', 'Success Alert', {timeOut: 3000});
					$("#form_matriculasA")[0].reset();
					$("#id_personaA").val("");
					$("#nombre_gradoA").val("");
					bloquear_cajas_textoA();
				}
				else if(respuesta==="estudianteretirado"){

					toastr.info('El N° De Identificación Corresponde A Un Estudiante Retirado.', 'Success Alert', {timeOut: 3000});
					$("#form_matriculasA")[0].reset();
					$("#id_personaA").val("");
					$("#nombre_gradoA").val("");
					bloquear_cajas_textoA();
				}
				else{

					registros = JSON.parse(respuesta);
					
					for (var i = 0; i < registros.datos.length; i++) {

						id_persona = registros.datos[i].id_persona;
						nombres =    registros.datos[i].nombres;
						apellido1 =  registros.datos[i].apellido1;
						apellido2 =  registros.datos[i].apellido2;
						jornada   =  $("#jornadaMTA").val();
						nombre_grado = registros.proximo_grado;

						$("#id_personaA").val(id_persona);
	        			$("#nombresA").val(nombres);
	        			$("#apellido1A").val(apellido1);
	        			$("#apellido2A").val(apellido2);
	        			$("#nombre_gradoA").val(nombre_grado);

	        			desbloquear_cajas_textoA();
						llenarcombo_acudientes("");
						llenarcombo_cursosA(jornada,nombre_grado);
						
					};
				}	
				
		
		}

	});
}


function llenarcombo_cursosA(jornada,nombre_grado){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursosA",
		type:"post",
		data:{jornada:jornada,nombre_grado:nombre_grado},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_curso"]==id_cursosele){

						html +="<option value="+registros[i]["id_curso"]+" selected>"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					}	
				};
				
				$("#curso1A select").html(html);
		}

	});
}


function bloquear_cajas_textoA(){

	$("#id_cursoA").attr("disabled", "disabled");
	$("#id_acudienteA").attr("disabled", "disabled");
	$("#parentescoA").attr("disabled", "disabled");
    $("#jornadaMTA").attr("disabled", "disabled");
    $("#observacionesA").attr("disabled", "disabled");
    $("#btn_registrar_matriculaA").attr("disabled", "disabled");
}

function desbloquear_cajas_textoA(){

	$("#id_cursoA").removeAttr("disabled");
	$("#id_acudienteA").removeAttr("disabled");
	$("#parentescoA").removeAttr("disabled");
    $("#jornadaMTA").removeAttr("disabled");
    $("#observacionesA").removeAttr("disabled");
    $("#btn_registrar_matriculaA").removeAttr("disabled");

}