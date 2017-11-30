$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarnotificaciones("",1,5);
	//llenarcombo_anos_lectivos();

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
						
						toastr.success('Mensaje Enviado Satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_notificaciones")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('Mensaje No Enviado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="asunto ya existe"){
						
						toastr.success('Ya Fue Enviado Un Mensaje Con El Mismo Asunto', 'Success Alert', {timeOut: 5000});
						

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarnotificaciones("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_notificacion").click(function(){

		$("#modal_agregar_notificacion").modal();
       
    });

    /*$("#btn_buscar_notificacion").click(function(event){
		
       mostrarnotificaciones("",1,5);
    });*/

    $("#buscar_notificacion").keyup(function(event){

    	buscar = $("#buscar_notificacion").val();
		valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones(buscar,1,valorcantidad);
		
    });

    $("#cantidad_notificacion").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_notificacion").val();
    	mostrarnotificaciones(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_notificacion li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_notificacion").val();
    	valorcantidad = $("#cantidad_notificacion").val();
		mostrarnotificaciones(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_notificaciones button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar El Mensaje?")){
			eliminar_notificacion(idsele);

		}

	});

	$("body").on("click","#lista_notificaciones a",function(event){
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
        $("#destinatariosele").val(destinatariosele);
        
        
	});

	
    $("#btn_actualizar_notificacion").click(function(event){

    	if($("#form_notificaciones_actualizar").valid()==true){
       		actualizar_notificacion();
       	

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });






	$("#form_notificaciones").validate({

    	rules:{

			asunto:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			mensaje:{
				required: true,
				maxlength: 300,
					

			},

			fecha_evento:{
				required: true,
				date: true
		

			},

			destinatario:{
				required: true

			}

			//time: "required time"

		}


	});

	$("#form_notificaciones_actualizar").validate({

    	rules:{

			asunto:{
				required: true,
				maxlength: 45
				//lettersonly: true	

			},

			mensaje:{
				required: true,
				maxlength: 300,
					

			},

			fecha_evento:{
				required: true,
				date: true
		

			},

			destinatario:{
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


function mostrarnotificaciones(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"notificaciones_controller/mostrarnotificaciones",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		dataType:"json",
		success:function(response) {
				//toastr.error(''+response, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
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
					html +="<tr><td>"+i+"</td><td style='display:none'>"+item.id_notificacion+"</td><td>"+item.asunto+"</td><td style='display:none'>"+item.mensaje+"</td><td>"+item.fecha_evento+"</td><td style='display:none'>"+item.hora_evento+"</td><td>"+item.hora_evento1+"</td><td style='display:none'>"+item.destinatario+"</td><td>"+destino+"</td><td>"+item.fecha_envio+"</td><td><a class='btn btn-success' href="+item.id_notificacion+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+item.id_notificacion+"><i class='fa fa-trash'></i></button></td></tr>";
					i++;
				});
				
				$("#lista_notificaciones tbody").html(html);

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
				mostrarnotificaciones("",1,5);

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
				
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_notificaciones_actualizar")[0].reset();

				mostrarnotificaciones("",1,5);

		}


	});

}
