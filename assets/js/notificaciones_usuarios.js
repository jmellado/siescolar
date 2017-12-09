$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	rol = $("#rol").val();
	mostrarnotificaciones_usuarios("",1,5,rol);
	total_notificaciones();


    $("#buscar_notificacion").keyup(function(event){

    	buscar = $("#buscar_notificacion").val();
		valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones_usuarios(buscar,1,valorcantidad,rol);
		
    });

    $("#cantidad_notificacion").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_notificacion").val();
    	mostrarnotificaciones_usuarios(buscar,1,valorcantidad,rol);
    });

    $("body").on("click", ".paginacion_notificacionP li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_notificacion").val();
    	valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones_usuarios(buscar,numero_pagina,valorcantidad,rol);


    });

	$("body").on("click","#lista_notificacionesP a",function(event){
		event.preventDefault();
		$("#modal_actualizar_notificacion").modal();
		id_notificacionsele = $(this).attr("href");
		asuntosele = $(this).parent().parent().children("td:eq(2)").text();
		mensajesele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		fecha_eventosele = $(this).parent().parent().children("td:eq(4)").text();
		hora_eventosele = $(this).parent().parent().children("td:eq(5)").text();
		destinatariosele = $(this).parent().parent().children("td:eq(7)").text();
		

		$("#id_notificacionsele").val(id_notificacionsele);
        $("#asuntosele").val(asuntosele);
        $("#mensajesele").val(mensajesele);
        $("#fecha_eventosele").val(fecha_eventosele);
        $("#hora_eventosele").val(hora_eventosele);
        //$("#destinatariosele").val(destinatariosele);
        
        
	});




	setInterval(total_notificaciones, 10000);
}


function total_notificaciones(){

	var msj = document.getElementById('mensaje_notificaciones');
	msj.innerHTML = "";

	rol = $("#rol").val();
	
	$.ajax({
		url:base_url+"notificaciones_controller/total_notificaciones",
		type:"post",
		data:{rol:rol},
		success:function(respuesta) {

				//alert(""+respuesta);
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				notifi = registros.totalnotificaciones;

				if (Number(notifi) > 0) {

					$("#total_notificaciones").show(); 

					var notificacion = document.getElementById('total_notificaciones');
					notificacion.innerHTML = notifi;

					var msj = document.getElementById('mensaje_notificaciones');
					msj.innerHTML = notifi;

					mostrarnotificaciones_usuarios("",1,5,rol);
				}
				else{
					$("#total_notificaciones").hide();
				}

         		
		}

	});
}


function VistaPrevia_Notificaciones(){

	rol = $("#rol").val();
	$("#total_notificaciones").hide(); 

	$.ajax({
		url:base_url+"notificaciones_controller/vistaprevia_notificaciones",
		type:"post",
		data:{rol:rol},
		success:function(respuesta) {

				//alert(""+respuesta);
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.notificaciones.length; i++) {
					html +="<li><a href='http://localhost/siescolar/notificaciones_controller/index_profesor'><i class='fa fa-users text-aqua'></i>"+registros.notificaciones[i].asunto+"<br/>"+registros.notificaciones[i].fecha_envio+"</a></li>";
				};

				$("#listado_notificaciones").html(html);

				
		}

	});
}


function mostrarnotificaciones_usuarios(valor,pagina,cantidad,rol){

	$.ajax({
		url:base_url+"notificaciones_controller/mostrarnotificaciones_usuarios",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,rol:rol},
		dataType:"json",
		success:function(response) {
				
				i = 1;
				html ="";
				$.each(response.notificaciones,function(key,item){
					if (item.destinatario == 1) {
						destino = "Estudiantes y Acudientes";
					}
					if (item.destinatario == 2) {
						destino = "Profesores";
					}
					if (item.destinatario == 3) {
						destino = "Estudiantes, Profesores y Acudientes";
					}
					html +="<tr><td>"+i+"</td><td style='display:none'>"+item.id_notificacion+"</td><td>"+item.asunto+"</td><td style='display:none'>"+item.mensaje+"</td><td>"+item.fecha_evento+"</td><td style='display:none'>"+item.hora_evento+"</td><td>"+item.hora_evento1+"</td><td style='display:none'>"+item.destinatario+"</td><td style='display:none'>"+destino+"</td><td>"+item.fecha_envio+"</td><td><a class='btn btn-success' href="+item.id_notificacion+"><i class='fa fa-search'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+item.id_notificacion+"><i class='fa fa-trash'></i></button></td></tr>";
					i++;
				});
				
				$("#lista_notificacionesP tbody").html(html);

				linkseleccionado = Number(pagina);
				//total de registros
			    totalregistros = response.totalregistros;
				//cantidad de registros por pagina
				cantidadregistros = response.cantidad;
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
				$(".paginacion_notificacionP").html(paginador);

			}

	});

}
