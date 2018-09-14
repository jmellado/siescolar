$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarperiodos("",1,5);

	
	$("#form_periodos").submit(function (event) {
		
		event.preventDefault();
		if($("#form_periodos").valid()==true){

			$.ajax({

				url:$("#form_periodos").attr("action"),
				type:$("#form_periodos").attr("method"),
				data:$("#form_periodos").serialize(),   
				success:function(respuesta) {

	
					if (respuesta==="registroguardado") {
						
						toastr.success('Registro Guardado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_periodos")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Registro No Guardado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="periodo ya existe"){
						
						toastr.warning('Período Ya Registrado.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
					mostrarperiodos("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_agregar_periodo").click(function(){

		$("#modal_agregar_periodo").modal();
       
    });

    $("#btn_buscar_periodo").click(function(event){
		
       	mostrarperiodos("",1,5);
    });

    $("#buscar_periodo").keyup(function(event){

    	buscar = $("#buscar_periodo").val();
		mostrarperiodos(buscar,1,5);
		
    });

	$("body").on("click","#lista_periodos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_periodo").modal();
		id_periodosele = $(this).attr("href");
		periodosele = $(this).parent().parent().children("td:eq(2)").text();
		fecha_inicialsele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		fecha_finalsele = $(this).parent().parent().children("td:eq(4)").text();
		estado_periodosele = $(this).parent().parent().children("td:eq(5)").text();
		
		$("#id_periodosele").val(id_periodosele);
        $("#periodosele").val(periodosele);
        $("#fecha_inicialsele").val(fecha_inicialsele);
        $("#fecha_finalsele").val(fecha_finalsele);
        $("#estado_periodosele").val(estado_periodosele);

	});

	$("body").on("click","#lista_periodos .btn-activar",function(event){
		event.preventDefault();
		id_periodo = $(this).attr("value");
		estado_periodo = $(this).parent().parent().children("td:eq(5)").text();
		
		if (estado_periodo =="Activo") {

			toastr.warning('El Período De Evaluación Ya Se Encuentra Activo.', 'Success Alert', {timeOut: 3000});
		}
		else{
			if(confirm("Esta Seguro De Activar Este Período De Evaluación.?")){
				activar_periodo(id_periodo);

			}
		}

	});

	$("body").on("click","#lista_periodos .btn-cerrar",function(event){
		event.preventDefault();
		id_periodo = $(this).attr("value");
		estado_periodo = $(this).parent().parent().children("td:eq(5)").text();
		
		if (estado_periodo =="Cerrado") {

			toastr.error('El Período De Evaluación Ya Se Encuentra Cerrado.', 'Success Alert', {timeOut: 3000});
		}
		else{
			if(confirm("Esta Seguro De Cerrar Este Período De Evaluación.?")){
				cerrar_periodo(id_periodo);

			}
		}

	});

	
    $("#btn_actualizar_periodo").click(function(event){

    	if($("#form_periodos_actualizar").valid()==true){
       		actualizar_periodo();
       	
       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });



	$("#form_periodos").validate({

    	rules:{

			periodo:{
				required: true	

			},

			fecha_inicial:{
				required: true	

			},

			fecha_final:{
				required: true	

			},

			estado_periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});

	$("#form_periodos_actualizar").validate({

    	rules:{

			fecha_inicial:{
				required: true	

			},

			fecha_final:{
				required: true	

			},

			estado_periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrarperiodos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"configuraciones_controller/mostrarperiodos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.periodos.length > 0) {

					for (var i = 0; i < registros.periodos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.periodos[i].id_actividad+"</td><td>"+registros.periodos[i].nombre_actividad+"</td><td>"+registros.periodos[i].fecha_inicial+"</td><td>"+registros.periodos[i].fecha_final+"</td><td>"+registros.periodos[i].estado_actividad+"</td><td><a class='btn btn-success' href="+registros.periodos[i].id_actividad+" title='Actualizar Información De Este Período De Evaluación'><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-warning btn-activar' value="+registros.periodos[i].id_actividad+" title='Activar Período De Evaluación'><i class='fa fa-check'></i></button></td><td><button type='button' class='btn btn-danger btn-cerrar' value="+registros.periodos[i].id_actividad+" title='Cerrar Período De Evaluación'><i class='fa fa-close'></i></button></td></tr>";
					};

					$("#lista_periodos tbody").html(html);
				}
				else{

					html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Datos Disponibles..</p></td></tr>";
					$("#lista_periodos tbody").html(html);
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
				$(".paginacion_periodo").html(paginador);

			}

	});

}


function actualizar_periodo(){

	$.ajax({
		url:base_url+"configuraciones_controller/modificar_periodo",
		type:"post",
        data:$("#form_periodos_actualizar").serialize(),
		success:function(respuesta) {
				
				$("#modal_actualizar_periodo").modal('hide');
			
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_periodos_actualizar")[0].reset();

				mostrarperiodos("",1,5);

		}


	});

}


function activar_periodo(valor){

	$.ajax({
		url:base_url+"configuraciones_controller/activar_periodo",
		type:"post",
        data:{id_periodo:valor},
		success:function(respuesta) {
				
				
			if (respuesta==="periodoactivado") {
					
				toastr.success('Período Activado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

			}
			else if(respuesta==="periodonoactivado"){
				
				toastr.error('Período No Activado.', 'Success Alert', {timeOut: 3000});
				
			}
			else if(respuesta==="periodosactivos"){
				
				toastr.warning('Solo Puede Tener Un Período Activo.', 'Success Alert', {timeOut: 3000});
				
			}
			else{

				toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
			}

			mostrarperiodos("",1,5);

		}


	});

}


function cerrar_periodo(valor){

	$.ajax({
		url:base_url+"configuraciones_controller/cerrar_periodo",
		type:"post",
        data:{id_periodo:valor},
		success:function(respuesta) {
				
				
			if (respuesta==="periodocerrado") {
					
				toastr.success('Período Cerrado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

			}
			else if(respuesta==="periodonocerrado"){
				
				toastr.error('Período No Cerrado.', 'Success Alert', {timeOut: 3000});
				
			}
			else if(respuesta==="periodoinactivo"){
				
				toastr.warning('No Se Puede Cerrar Un Período Inactivo.', 'Success Alert', {timeOut: 3000});
				
			}
			else if(respuesta==="periodopendiente"){
				
				toastr.warning('No Se Puede Cerrar El Período;Existen Estudiantes Pendientes Por Calificaciones.', 'Success Alert', {timeOut: 3000});
				
			}
			else{

				toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
			}

			mostrarperiodos("",1,5);

		}


	});

}

