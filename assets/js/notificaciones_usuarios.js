$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	rol = $("#rol").val();
	id_persona = $("#id_persona").val()
	mostrarnotificaciones_usuarios("",1,5,rol,id_persona);
	total_notificaciones();


    $("#buscar_notificacion").keyup(function(event){

    	buscar = $("#buscar_notificacion").val();
		valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones_usuarios(buscar,1,valorcantidad,rol,id_persona);
		
    });

    $("#cantidad_notificacion").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_notificacion").val();
    	mostrarnotificaciones_usuarios(buscar,1,valorcantidad,rol,id_persona);
    });

    $("body").on("click", ".paginacion_notificacionP li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_notificacion").val();
    	valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones_usuarios(buscar,numero_pagina,valorcantidad,rol,id_persona);


    });

	$("body").on("click","#lista_notificacionesP a",function(event){
		event.preventDefault();
		$("#modal_actualizar_notificacion").modal();
		codigo_notificacionsele = $(this).attr("href");
		titulosele = $(this).parent().parent().children("td:eq(2)").text();
		tiposele = $(this).parent().parent().children("td:eq(3)").text();
		contenidosele = $(this).parent().parent().children("td:eq(4)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		rol_destinatariosele = $(this).parent().parent().children("td:eq(5)").text();
		fecha_enviosele = $(this).parent().parent().children("td:eq(7)").text();
		

		$("#codigo_notificacionsele").val(codigo_notificacionsele);
        $("#titulo_msele").val(titulosele);
        $("#tipo_msele").val(tiposele);
        $("#contenido_msele").val(contenidosele);
        $("#fecha_envio_msele").val(fecha_enviosele);
        //$("#destinatariosele").val(destinatariosele);
        
        
	});




	setInterval(total_notificaciones, 10000);
}


function total_notificaciones(){

	var msj = document.getElementById('mensaje_notificaciones');
	msj.innerHTML = "";

	rol = $("#rol").val();
	id_persona = $("#id_persona").val();

	$.ajax({
		url:base_url+"notificaciones_controller/total_notificaciones",
		type:"post",
		data:{rol:rol,id_persona:id_persona},
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

					mostrarnotificaciones_usuarios("",1,5,rol,id_persona);
				}
				else{
					$("#total_notificaciones").hide();
				}

         		
		}

	});
}


function VistaPrevia_Notificaciones(){

	rol = $("#rol").val();
	id_persona = $("#id_persona").val();
	$("#total_notificaciones").hide(); 

	$.ajax({
		url:base_url+"notificaciones_controller/vistaprevia_notificaciones",
		type:"post",
		data:{rol:rol,id_persona:id_persona},
		success:function(respuesta) {

				//alert(""+respuesta);
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.notificaciones.length; i++) {
					if (registros.notificaciones[i].categoria_notificacion == "Mensajes") {
						$categoria = "<i class='fa fa-envelope-o text-aqua'></i>";
					}
					if (registros.notificaciones[i].categoria_notificacion == "Eventos") {
						$categoria = "<i class='fa fa-calendar text-aqua'></i>";
					}

					if (rol == "profesor") {
						html +="<li><a href='"+base_url+"notificaciones_controller/index_profesor'>"+$categoria+" "+registros.notificaciones[i].titulo+"<br/>"+registros.notificaciones[i].fecha_envio+"</a></li>";
					}
					else if (rol == "estudiante") {
						html +="<li><a href='"+base_url+"notificaciones_controller/index_estudiante'>"+$categoria+" "+registros.notificaciones[i].titulo+"<br/>"+registros.notificaciones[i].fecha_envio+"</a></li>";
					}
					else if (rol == "acudiente") {
						html +="<li><a href='"+base_url+"notificaciones_controller/index_acudiente'>"+$categoria+" "+registros.notificaciones[i].titulo+"<br/>"+registros.notificaciones[i].fecha_envio+"</a></li>";
					}	
				};

				$("#listado_notificaciones").html(html);

				
		}

	});
}


function mostrarnotificaciones_usuarios(valor,pagina,cantidad,rol,id_persona){

	$.ajax({
		url:base_url+"notificaciones_controller/mostrarnotificaciones_usuarios",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,rol:rol,id_persona:id_persona},
		dataType:"json",
		success:function(response) {
				//alert(""+response);
				i = 1;
				html ="";

				if (response.notificaciones.length > 0) {

					$.each(response.notificaciones,function(key,item){
						if (item.rol_destinatario == 1) {
							destino = "Estudiantes y Acudientes";
						}
						if (item.rol_destinatario == 2) {
							destino = "Profesores";
						}
						if (item.rol_destinatario == 3) {
							destino = "Estudiantes, Profesores y Acudientes";
						}
						html +="<tr><td>"+i+"</td><td style='display:none'>"+item.codigo_notificacion+"</td><td>"+item.titulo+"</td><td>"+item.tipo_notificacion+"</td><td style='display:none'>"+item.contenido+"</td><td style='display:none'>"+item.rol_destinatario+"</td><td style='display:none'>"+destino+"</td><td>"+item.fecha_envio+"</td><td><a class='btn btn-success' href="+item.codigo_notificacion+"><i class='fa fa-eye'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+item.codigo_notificacion+"><i class='fa fa-trash'></i></button></td></tr>";
						i++;
					});
					
					$("#lista_notificacionesP tbody").html(html);
				}
				else{
					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Mensajes..</p></td></tr>";
					$("#lista_notificacionesP tbody").html(html);
				}

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
