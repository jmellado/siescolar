$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostraracciones_pedagogicas("",1,5);

	// este metodo permite enviar la inf del formulario
	$("#form_acciones_pedagogicas").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_acciones_pedagogicas").valid()==true){

			$.ajax({

				url:$("#form_acciones_pedagogicas").attr("action"),
				type:$("#form_acciones_pedagogicas").attr("method"),
				data:$("#form_acciones_pedagogicas").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Acción Pedagógica Registrada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_acciones_pedagogicas")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Acción Pedagógica No Registrada.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="accionyaexiste"){
						
						toastr.warning('Acción Pedagógica Ya Registrada.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}

					valorcantidad = $("#cantidad_acciones_pedagogicas").val();
					mostraracciones_pedagogicas("",1,valorcantidad);

						
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_agregar_accion_pedagogica").click(function(){

		$("#modal_agregar_acciones_pedagogicas").modal();
       
    });

    $("#btn_buscar_acciones_pedagogicas").click(function(event){
		
       mostraracciones_pedagogicas("",1,5);
    });

    $("#buscar_acciones_pedagogicas").keyup(function(event){

    	buscar = $("#buscar_acciones_pedagogicas").val();
		valorcantidad = $("#cantidad_acciones_pedagogicas").val();
		mostraracciones_pedagogicas(buscar,1,valorcantidad);
		
    });

    $("#cantidad_acciones_pedagogicas").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_acciones_pedagogicas").val();
    	mostraracciones_pedagogicas(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_acciones_pedagogicas li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_acciones_pedagogicas").val();
    	valorcantidad = $("#cantidad_acciones_pedagogicas").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostraracciones_pedagogicas(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_acciones_pedagogicas button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Esta Acción Pedagógica.?")){
			eliminar_accion_pedagogica(idsele);

		}

	});

	$("body").on("click","#lista_acciones_pedagogicas a",function(event){
		event.preventDefault();
		$("#modal_actualizar_acciones_pedagogicas").modal();
		id_accion_pedagogicasele = $(this).attr("href");
		accion_pedagogicasele = $(this).parent().parent().children("td:eq(2)").text();

		$("#id_accion_pedagogicasele").val(id_accion_pedagogicasele);
		$("#accion_pedagogicasele").val(accion_pedagogicasele);
	});


	$("#btn_actualizar_accion_pedagogica").click(function(event){

    	if($("#form_acciones_pedagogicas_actualizar").valid()==true){
       		actualizar_accion_pedagogica();
      	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
       
    });


    $("#modal_agregar_acciones_pedagogicas").on('hidden.bs.modal', function () {
        $("#form_acciones_pedagogicas")[0].reset();
        var validator = $("#form_acciones_pedagogicas").validate();
        validator.resetForm();
    });


    $("#modal_actualizar_acciones_pedagogicas").on('hidden.bs.modal', function () {
        $("#form_acciones_pedagogicas_actualizar")[0].reset();
        var validator = $("#form_acciones_pedagogicas_actualizar").validate();
        validator.resetForm();
    });


    $("#form_acciones_pedagogicas").validate({

    	rules:{

    		accion_pedagogica:{
				required: true,
				maxlength: 500,
				lettersonly: true

			}

		}


	});

	$("#form_acciones_pedagogicas_actualizar").validate({

    	rules:{

    		accion_pedagogica:{
				required: true,
				maxlength: 500,
				lettersonly: true

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostraracciones_pedagogicas(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"acciones_pedagogicas_controller/mostraracciones_pedagogicas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.acciones_pedagogicas.length > 0) {

					for (var i = 0; i < registros.acciones_pedagogicas.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.acciones_pedagogicas[i].id_accion_pedagogica+"</td><td><textarea class='form-control' cols='40' rows='2' readonly style='resize:none'>"+registros.acciones_pedagogicas[i].accion_pedagogica+"</textarea></td><td><a class='btn btn-success' href="+registros.acciones_pedagogicas[i].id_accion_pedagogica+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.acciones_pedagogicas[i].id_accion_pedagogica+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_acciones_pedagogicas tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Acciones Pedagógicas Registradas..</p></td></tr>";
					$("#lista_acciones_pedagogicas tbody").html(html);
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
				$(".paginacion_acciones_pedagogicas").html(paginador);

			}

	});

}


function actualizar_accion_pedagogica(){

	$.ajax({
		url:base_url+"acciones_pedagogicas_controller/modificar",
		type:"post",
        data:$("#form_acciones_pedagogicas_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_acciones_pedagogicas").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Acción Pedagógica Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Acción Pedagógica No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="accionyaexiste"){
					
					toastr.warning('Acción Pedagógica Ya Registrada.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="accionenseguimientos"){
					
					toastr.warning('No Se Puede Modificar Esta Acción Pedagógica; Actualmente Se Encuentra Asociada A Un Seguimiento.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_acciones_pedagogicas_actualizar")[0].reset();

				valorcantidad = $("#cantidad_acciones_pedagogicas").val();
				mostraracciones_pedagogicas("",1,valorcantidad);

		}


	});

}


function eliminar_accion_pedagogica(valor){

	$.ajax({
		url:base_url+"acciones_pedagogicas_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 3000});
				valorcantidad = $("#cantidad_acciones_pedagogicas").val();
				mostraracciones_pedagogicas("",1,valorcantidad);

		}


	});

}