$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	id_persona = $("#id_persona").val();
	mostrarmensajes("",1,5,id_persona);
	
	//========= FUNCIONES MENSAJES ==========

	$("#tab_m").click(function(){

		mostrarmensajes("",1,5,id_persona);
    });

    $("#buscar_mensaje").keyup(function(event){

    	buscar = $("#buscar_mensaje").val();
		valorcantidad = $("#cantidad_mensaje").val();
		mostrarmensajes(buscar,1,valorcantidad,id_persona);
		
    });

    $("#cantidad_mensaje").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_mensaje").val();
    	mostrarmensajes(buscar,1,valorcantidad,id_persona);
    });

    $("body").on("click", ".paginacion_mensaje li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_mensaje").val();
    	valorcantidad = $("#cantidad_mensaje").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarmensajes(buscar,numero_pagina,valorcantidad,id_persona);
		}


    });

    $("body").on("click","#lista_mensajes a",function(event){
		event.preventDefault();
		$("#modal_ver_destinatarios_mensaje").modal();
		id_notificacionsele = $(this).attr("href");
		codigo_notificacionsele = $(this).parent().parent().children("td:eq(2)").text();
		titulosele = $(this).parent().parent().children("td:eq(3)").text();
		tipo_notificacionsele = $(this).parent().parent().children("td:eq(4)").text();
		contenidosele = $(this).parent().parent().children("td:eq(5)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();
		nombre_asignaturasele = $(this).parent().parent().children("td:eq(7)").text();
		fecha_enviosele = $(this).parent().parent().children("td:eq(8)").text();
		
		$("#id_notificacionsele").val(id_notificacionsele);
        $("#codigo_notificacionsele").val(codigo_notificacionsele);
        $("#titulosele").val(titulosele);
        $("#tipo_notificacionsele").val(tipo_notificacionsele);
        $("#contenidosele").val(contenidosele);
        $("#id_asignaturasele").val(id_asignaturasele);
        $("#nombre_asignaturasele").val(nombre_asignaturasele);
        $("#fecha_enviosele").val(fecha_enviosele);

        mostrardestinatarios("",1,1,codigo_notificacionsele);
	});


    //========= FUNCIONES TAREAS ==========


    $("#tab_t").click(function(){

		mostrartareas("",1,5,id_persona);
    });

    $("#buscar_tarea").keyup(function(event){

    	buscar = $("#buscar_tarea").val();
		valorcantidad = $("#cantidad_tarea").val();
		mostrartareas(buscar,1,valorcantidad,id_persona);
		
    });

    $("#cantidad_tarea").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_tarea").val();
    	mostrartareas(buscar,1,valorcantidad,id_persona);
    });

    $("body").on("click", ".paginacion_tarea li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_tarea").val();
    	valorcantidad = $("#cantidad_tarea").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrartareas(buscar,numero_pagina,valorcantidad,id_persona);
		}


    });

    $("body").on("click","#lista_tareas a",function(event){
		event.preventDefault();
		$("#modal_ver_destinatarios_tarea").modal();
		id_notificacionsele = $(this).attr("href");
		codigo_notificacionsele = $(this).parent().parent().children("td:eq(2)").text();
		titulosele = $(this).parent().parent().children("td:eq(3)").text();
		contenidosele = $(this).parent().parent().children("td:eq(4)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(5)").text();
		nombre_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();
		fecha_finsele = $(this).parent().parent().children("td:eq(7)").text();
		fecha_enviosele = $(this).parent().parent().children("td:eq(8)").text();
		
		$("#id_notificacionsele").val(id_notificacionsele);
        $("#codigo_notificacionsele").val(codigo_notificacionsele);
        $("#titulosele").val(titulosele);
        $("#contenidosele").val(contenidosele);
        $("#id_asignaturasele").val(id_asignaturasele);
        $("#nombre_asignaturasele").val(nombre_asignaturasele);
        $("#fecha_finsele").val(fecha_finsele);
        $("#fecha_enviosele").val(fecha_enviosele);

        mostrardestinatarios("",1,1,codigo_notificacionsele);
	});


	//========= FUNCIONES TAREAS ==========

    $("#tab_e").click(function(){

		mostrareventos("",1,5,id_persona);
    });

    $("#buscar_evento").keyup(function(event){

    	buscar = $("#buscar_evento").val();
		valorcantidad = $("#cantidad_evento").val();
		mostrareventos(buscar,1,valorcantidad,id_persona);
		
    });

    $("#cantidad_evento").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_evento").val();
    	mostrareventos(buscar,1,valorcantidad,id_persona);
    });

    $("body").on("click", ".paginacion_evento li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_evento").val();
    	valorcantidad = $("#cantidad_evento").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrareventos(buscar,numero_pagina,valorcantidad,id_persona);
		}


    });

    $("body").on("click","#lista_eventos a",function(event){
		event.preventDefault();
		$("#modal_ver_destinatarios_evento").modal();
		id_notificacionsele = $(this).attr("href");
		codigo_notificacionsele = $(this).parent().parent().children("td:eq(2)").text();
		titulosele = $(this).parent().parent().children("td:eq(3)").text();
		contenidosele = $(this).parent().parent().children("td:eq(4)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(5)").text();
		nombre_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();
		fecha_iniciosele = $(this).parent().parent().children("td:eq(7)").text();
		hora_iniciosele = $(this).parent().parent().children("td:eq(8)").text();
		fecha_finsele = $(this).parent().parent().children("td:eq(9)").text();
		hora_finsele = $(this).parent().parent().children("td:eq(10)").text();
		fecha_enviosele = $(this).parent().parent().children("td:eq(11)").text();
		
		$("#id_notificacionsele").val(id_notificacionsele);
        $("#codigo_notificacionsele").val(codigo_notificacionsele);
        $("#titulosele").val(titulosele);
        $("#contenidosele").val(contenidosele);
        $("#id_asignaturasele").val(id_asignaturasele);
        $("#nombre_asignaturasele").val(nombre_asignaturasele);
        $("#fecha_iniciosele").val(fecha_iniciosele);
        $("#hora_iniciosele").val(hora_iniciosele);
        $("#fecha_finsele").val(fecha_finsele);
        $("#hora_finsele").val(hora_finsele);
        $("#fecha_enviosele").val(fecha_enviosele);

        mostrardestinatarios("",1,1,codigo_notificacionsele);
	});

}


function mostrarmensajes(valor,pagina,cantidad,id_persona){

	$.ajax({
		url:base_url+"inbox_controller/mostrarmensajes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.mensajes.length > 0) {

					for (var i = 0; i < registros.mensajes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.mensajes[i].id_notificacion+"</td><td style='display:none'>"+registros.mensajes[i].codigo_notificacion+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.mensajes[i].titulo+"</textarea></td><td>"+registros.mensajes[i].tipo_notificacion+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.mensajes[i].contenido+"</textarea></td><td style='display:none'>"+registros.mensajes[i].id_asignatura+"</td><td>"+registros.mensajes[i].nombre_asignatura+"</td><td>"+registros.mensajes[i].fecha_envio+"</td><td><a class='btn btn-success' href="+registros.mensajes[i].id_notificacion+" title='Ver Destinatarios'><i class='fa fa-list-alt'></i></a></td></tr>";
					};
					
					$("#lista_mensajes tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Mensajes Registrados..</p></td></tr>";
					$("#lista_mensajes tbody").html(html);
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
				$(".paginacion_mensaje").html(paginador);

			}

	});

}


function mostrartareas(valor,pagina,cantidad,id_persona){

	$.ajax({
		url:base_url+"inbox_controller/mostrartareas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.tareas.length > 0) {

					for (var i = 0; i < registros.tareas.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.tareas[i].id_notificacion+"</td><td style='display:none'>"+registros.tareas[i].codigo_notificacion+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.tareas[i].titulo+"</textarea></td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.tareas[i].contenido+"</textarea></td><td style='display:none'>"+registros.tareas[i].id_asignatura+"</td><td>"+registros.tareas[i].nombre_asignatura+"</td><td>"+registros.tareas[i].fecha_fin+"</td><td>"+registros.tareas[i].fecha_envio+"</td><td><a class='btn btn-success' href="+registros.tareas[i].id_notificacion+" title='Ver Destinatarios'><i class='fa fa-list-alt'></i></a></td></tr>";
					};
					
					$("#lista_tareas tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Tareas Registradas..</p></td></tr>";
					$("#lista_tareas tbody").html(html);
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
				$(".paginacion_tarea").html(paginador);

			}

	});

}


function mostrareventos(valor,pagina,cantidad,id_persona){

	$.ajax({
		url:base_url+"inbox_controller/mostrareventos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.eventos.length > 0) {

					for (var i = 0; i < registros.eventos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.eventos[i].id_notificacion+"</td><td style='display:none'>"+registros.eventos[i].codigo_notificacion+"</td><td><textarea class='form-control' cols='25' rows='2' readonly style='resize:none'>"+registros.eventos[i].titulo+"</textarea></td><td><textarea class='form-control' cols='25' rows='2' readonly style='resize:none'>"+registros.eventos[i].contenido+"</textarea></td><td style='display:none'>"+registros.eventos[i].id_asignatura+"</td><td>"+registros.eventos[i].nombre_asignatura+"</td><td>"+registros.eventos[i].fecha_inicio+"</td><td>"+registros.eventos[i].hora_inicio+"</td><td>"+registros.eventos[i].fecha_fin+"</td><td>"+registros.eventos[i].hora_fin+"</td><td>"+registros.eventos[i].fecha_envio+"</td><td><a class='btn btn-success' href="+registros.eventos[i].id_notificacion+" title='Ver Destinatarios'><i class='fa fa-list-alt'></i></a></td></tr>";
					};
					
					$("#lista_eventos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='10'><p style='text-align:center'>No Hay Eventos Registrados..</p></td></tr>";
					$("#lista_eventos tbody").html(html);
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
				$(".paginacion_evento").html(paginador);

			}

	});

}


function mostrardestinatarios(valor,pagina,cantidad,codigo_notificacion){

	$.ajax({
		url:base_url+"inbox_controller/mostrardestinatarios",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,codigo_notificacion:codigo_notificacion},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.destinatarios.length > 0) {

					for (var i = 0; i < registros.destinatarios.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.destinatarios[i].id_estudiante+"</td><td style='display:none'>"+registros.destinatarios[i].identificacion+"</td><td>"+registros.destinatarios[i].nombres+"</td><td>"+registros.destinatarios[i].apellido1+"</td><td>"+registros.destinatarios[i].apellido2+"</td></tr>";
					};
					
					$("#lista_destinatarios tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Destinatarios Registrados..</p></td></tr>";
					$("#lista_destinatarios tbody").html(html);
				}

			}

	});

}