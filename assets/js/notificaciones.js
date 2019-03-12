$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_admin = $("#id_admin").val();
	mostrarnotificaciones("",1,5,id_admin);

	// este metodo permite enviar la inf del formulario
	$("#form_notificaciones").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_notificaciones").valid()==true){

			$.ajax({

				url:$("#form_notificaciones").attr("action"),
				type:$("#form_notificaciones").attr("method"),
				data:$("#form_notificaciones").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Mensaje Enviado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_notificaciones")[0].reset();


					}
					else if(respuesta==="registroguardado-p") {
						
						toastr.success('Mensaje Enviado Satisfactoriamente A Profesores; Estudiantes Y Acudientes No Registrados.', 'Success Alert', {timeOut: 3000});
						$("#form_notificaciones")[0].reset();


					}
					else if(respuesta==="registroguardado-ea") {
						
						toastr.success('Mensaje Enviado Satisfactoriamente A Estudiantes Y Acudientes; Profesores No Registrados.', 'Success Alert', {timeOut: 3000});
						$("#form_notificaciones")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Mensaje No Enviado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="no-p"){
						
						toastr.warning('Mensaje No Enviado; Profesores No Registrados.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="no-e-a"){
						
						toastr.warning('Mensaje No Enviado; Estudiantes Y Acudientes No Registrados.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="no-e-a-p"){
						
						toastr.warning('Mensaje No Enviado; Estudiantes, Acudientes y Profesores No Registrados.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="asunto ya existe"){
						
						toastr.warning('Ya Fue Enviado Un Mensaje Con El Mismo Asunto.', 'Success Alert', {timeOut: 5000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarnotificaciones("",1,5,id_admin);

						
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_notificacion").click(function(){

		$("#modal_agregar_notificacion").modal();
       
    });

    /*$("#btn_buscar_notificacion").click(function(event){
		
       mostrarnotificaciones("",1,5,id_admin);
    });*/

    $("#buscar_notificacion").keyup(function(event){

    	buscar = $("#buscar_notificacion").val();
		valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones(buscar,1,valorcantidad,id_admin);
		
    });

    $("#cantidad_notificacion").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_notificacion").val();
    	mostrarnotificaciones(buscar,1,valorcantidad,id_admin);
    });

    $("body").on("click", ".paginacion_notificacion li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_notificacion").val();
    	valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones(buscar,numero_pagina,valorcantidad,id_admin);


    });

    $("body").on("click","#lista_notificaciones button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar El Mensaje.?")){
			eliminar_notificacion(idsele);

		}

	});

	$("body").on("click","#lista_notificaciones a",function(event){
		event.preventDefault();
		$("#modal_actualizar_notificacion").modal();
		codigo_notificacionsele = $(this).attr("href");
		titulosele = $(this).parent().parent().children("td:eq(2)").text();
		tiposele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		contenidosele = $(this).parent().parent().children("td:eq(4)").text();
		rol_destinatariosele = $(this).parent().parent().children("td:eq(5)").text();
		fecha_enviosele = $(this).parent().parent().children("td:eq(7)").text();
		

		$("#codigo_notificacion_msele").val(codigo_notificacionsele);
        $("#titulo_msele").val(titulosele);
        $("#tipo_msele").val(tiposele);
        $("#contenido_msele").val(contenidosele);
        $("#rol_destinatario_msele").val(rol_destinatariosele);
        
        
	});

	
    $("#btn_actualizar_notificacion").click(function(event){

    	if($("#form_notificaciones_actualizar").valid()==true){
       		actualizar_notificacion();
       	

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    //Resetear Formulario Al Cerrar El Modal
    $("#modal_agregar_notificacion").on('hidden.bs.modal', function () {
        $("#form_notificaciones")[0].reset();
        $("#form_notificaciones").valid()==true;
    });


    //Resetear Formulario Al Cerrar El Modal
    $("#modal_actualizar_notificacion").on('hidden.bs.modal', function () {
        $("#form_notificaciones_actualizar")[0].reset();
        $("#form_notificaciones_actualizar").valid()==true;
    });



	$("#form_notificaciones").validate({

    	rules:{

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300,
					

			},

			tipo:{
				required: true
		

			},

			rol_destinatario:{
				required: true

			}

			//time: "required time"

		}


	});

	$("#form_notificaciones_actualizar").validate({

    	rules:{

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300,
					

			},

			tipo:{
				required: true
		

			},

			rol_destinatario:{
				required: true

			}

			//time: "required time"

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");
	/*$.validator.addMethod("time", function(value, element) {  
	return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(value);  
	}, "Please enter a valid time.");*/


}


function mostrarnotificaciones(valor,pagina,cantidad,id_admin){

	$.ajax({
		url:base_url+"notificaciones_controller/mostrarnotificaciones",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_admin:id_admin},
		dataType:"json",
		success:function(response) {
				//toastr.error(''+response, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
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
						html +="<tr><td>"+i+"</td><td style='display:none'>"+item.codigo_notificacion+"</td><td>"+item.titulo+"</td><td>"+item.tipo_notificacion+"</td><td style='display:none'>"+item.contenido+"</td><td style='display:none'>"+item.rol_destinatario+"</td><td>"+destino+"</td><td>"+item.fecha_envio+"</td><td><a class='btn btn-success' href="+item.codigo_notificacion+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+item.codigo_notificacion+"><i class='fa fa-trash'></i></button></td></tr>";
						i++;
					});
					
					$("#lista_notificaciones tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Mensajes..</p></td></tr>";
					$("#lista_notificaciones tbody").html(html);
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
				$(".paginacion_notificacion").html(paginador);

			}

	});

}


function eliminar_notificacion(valor){

	$.ajax({
		url:base_url+"notificaciones_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarnotificaciones("",1,5,id_admin);

		}


	});



}

function actualizar_notificacion(){

	$.ajax({
		url:base_url+"notificaciones_controller/modificar",
		type:"post",
        data:$("#form_notificaciones_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_notificacion").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Mensaje Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Mensaje No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}
				
				$("#form_notificaciones_actualizar")[0].reset();

				mostrarnotificaciones("",1,5,id_admin);

		}


	});

}
