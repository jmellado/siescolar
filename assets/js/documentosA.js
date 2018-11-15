$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrardocumentos("",1,5);

	$("#form_documentos").submit(function (event) {
		
		event.preventDefault();
		var formData = new FormData($("#form_documentos")[0]);

		if($("#form_documentos").valid()==true){

			$.ajax({

				url:$("#form_documentos").attr("action"),
				type:$("#form_documentos").attr("method"),
				data:formData,
				cache:false,
				contentType:false,
				processData:false,   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Documento Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_documentos")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Documento No Registrado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="documentoyaexiste"){
						
						toastr.warning('Ya Se Encuentra Cargado Un Documento Con El Mismo Nombre.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
					mostrardocumentos("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_agregar_documento").click(function(){

		$("#modal_agregar_documento").modal();
       
    });


    $("#btn_buscar_documento").click(function(event){
		
       mostrardocumentos("",1,5);
    });


    $("#buscar_documento").keyup(function(event){

    	buscar = $("#buscar_documento").val();
		valorcantidad = $("#cantidad_documento").val();
		mostrardocumentos(buscar,1,valorcantidad);
		
    });


    $("#cantidad_documento").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_documento").val();
    	mostrardocumentos(buscar,1,valorcantidad);
    });


    $("body").on("click", ".paginacion_documento li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_documento").val();
    	valorcantidad = $("#cantidad_documento").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrardocumentos(buscar,numero_pagina,valorcantidad);
		}


    });


    $("body").on("click","#lista_documentos button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Este Documento.?")){
			eliminar_documento(idsele);

		}

	});


	$("body").on("click","#lista_documentos .btn-editar",function(event){
		event.preventDefault();
		$("#modal_actualizar_documento").modal();
		id_documentosele = $(this).attr("href");
		descripcion_documentosele = $(this).parent().parent().children("td:eq(2)").text();
		nombre_documentosele = $(this).parent().parent().children("td:eq(3)").text();
		fecha_subidasele = $(this).parent().parent().children("td:eq(4)").text();
		
		$("#id_documentosele").val(id_documentosele);
        $("#descripcion_documentosele").val(descripcion_documentosele);
        $("#fecha_subidasele").val(fecha_subidasele);

	});


	$("#btn_actualizar_documento").click(function(event){

    	if($("#form_documentos_actualizar").valid()==true){
       		actualizar_documento();
       	
       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 2000});
			
		}
		
       
    });


    $("#modal_agregar_documento").on('hidden.bs.modal', function () {
        $("#form_documentos")[0].reset();
        var validator = $("#form_documentos").validate();
        validator.resetForm();
    });


    $("#modal_actualizar_documento").on('hidden.bs.modal', function () {
        $("#form_documentos_actualizar")[0].reset();
        var validator = $("#form_documentos_actualizar").validate();
        validator.resetForm();
    });


	$("#form_documentos").validate({

    	rules:{

			descripcion_documento:{
				required: true,
				maxlength: 500,

			}


		}

	});


	$("#form_documentos_actualizar").validate({

    	rules:{

			descripcion_documento:{
				required: true,
				maxlength: 500,

			}


		}

	});

}


function mostrardocumentos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"documentos_controller/mostrardocumentos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.documentos.length > 0) {

					for (var i = 0; i < registros.documentos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.documentos[i].id_documento+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.documentos[i].descripcion_documento+"</textarea></td><td style='display:none'>"+registros.documentos[i].nombre_documento+"</td><td>"+registros.documentos[i].fecha_subida+"</td><td><a class='btn btn-warning btn-descargar' href='"+base_url+"uploads/documentos/"+registros.documentos[i].nombre_documento+"' title='Descargar Documento' target='_blank'><i class='fa fa-download'></i></a></td><td><a class='btn btn-success btn-editar' href="+registros.documentos[i].id_documento+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.documentos[i].id_documento+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_documentos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Documentos Registrados..</p></td></tr>";
					$("#lista_documentos tbody").html(html);
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
				$(".paginacion_documento").html(paginador);

			}

	});

}


function eliminar_documento(valor){

	$.ajax({
		url:base_url+"documentos_controller/eliminar_documentoA",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrardocumentos("",1,5);

		}


	});



}


function actualizar_documento(){

	var formData = new FormData($("#form_documentos_actualizar")[0]);

	$.ajax({
		url:base_url+"documentos_controller/modificar_documentoA",
		type:"post",
        data:formData,
        cache:false,
		contentType:false,
		processData:false, 
		success:function(respuesta) {
				

				$("#modal_actualizar_documento").modal('hide');
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Documento Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Documento No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="documentoyaexiste"){
					
					toastr.warning('Ya Se Encuentra Cargado Un Documento Con El Mismo Nombre.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_documentos_actualizar")[0].reset();

				mostrardocumentos("",1,5);

		}


	});

}