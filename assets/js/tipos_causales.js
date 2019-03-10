$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrartipos_causales("",1,5);


	// este metodo permite enviar la inf del formulario
	$("#form_tipos").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_tipos").valid()==true){

			$.ajax({

				url:$("#form_tipos").attr("action"),
				type:$("#form_tipos").attr("method"),
				data:$("#form_tipos").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Tipo De Causal Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_tipos")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Tipo De Causal No Registrado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="tipoyaexiste"){
						
						toastr.warning('Tipo De Causal Ya Registrado.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrartipos_causales("",1,5);

						
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_tipo").click(function(){

		$("#modal_agregar_tipo").modal();
       
    });

    $("#btn_buscar_tipo").click(function(event){
		
       mostrartipos_causales("",1,5);
    });

    $("#buscar_tipo").keyup(function(event){

    	buscar = $("#buscar_tipo").val();
		valorcantidad = $("#cantidad_tipo").val();
		mostrartipos_causales(buscar,1,valorcantidad);
		
    });

    $("#cantidad_tipo").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_tipo").val();
    	mostrartipos_causales(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_tipo li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_tipo").val();
    	valorcantidad = $("#cantidad_tipo").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrartipos_causales(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_tipos button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Este Tipo De Causal.?")){
			eliminar_tipo_causal(idsele);

		}

	});

	$("body").on("click","#lista_tipos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_tipo").modal();
		id_tiposele = $(this).attr("href");
		tipo_causalsele = $(this).parent().parent().children("td:eq(2)").text();
		
		$("#id_tiposele").val(id_tiposele);
        $("#tipo_causalsele").val(tipo_causalsele);
	});


	$("#btn_actualizar_tipo").click(function(event){

    	if($("#form_tipos_actualizar").valid()==true){
       		actualizar_tipo_causal();
      	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
       
    });


    $("#modal_agregar_tipo").on('hidden.bs.modal', function () {
        $("#form_tipos")[0].reset();
        $("#form_tipos").valid()==true;
    });


    $("#modal_actualizar_tipo").on('hidden.bs.modal', function () {
        $("#form_tipos_actualizar")[0].reset();
        $("#form_tipos_actualizar").valid()==true;
    });


    $("#form_tipos").validate({

    	rules:{

			tipo_causal:{
				required: true,
				maxlength: 100

			}

		}


	});

	$("#form_tipos_actualizar").validate({

    	rules:{

			tipo_causal:{
				required: true,
				maxlength: 100	

			}

		}


	});


}


function mostrartipos_causales(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"causales_controller/mostrartipos_causales",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.tipos.length > 0) {

					for (var i = 0; i < registros.tipos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.tipos[i].id_tipo_causal+"</td><td>"+registros.tipos[i].tipo_causal+"</td><td><a class='btn btn-success' href="+registros.tipos[i].id_tipo_causal+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.tipos[i].id_tipo_causal+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_tipos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Tipos De Causales Registrados..</p></td></tr>";
					$("#lista_tipos tbody").html(html);
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
				$(".paginacion_tipo").html(paginador);

			}

	});

}


function actualizar_tipo_causal(){

	$.ajax({
		url:base_url+"causales_controller/modificar_tipo_causal",
		type:"post",
        data:$("#form_tipos_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_tipo").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Tipo De Causal Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Tipo De Causal No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="tipoyaexiste"){
					
					toastr.warning('Tipo De Causal Ya Registrado.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="tipoencausales"){
					
					toastr.warning('No Se Puede Modificar Este Tipo De Causal; Actualmente Tiene Causales Asociadas.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_tipos_actualizar")[0].reset();

				mostrartipos_causales("",1,5);

		}


	});

}


function eliminar_tipo_causal(valor){

	$.ajax({
		url:base_url+"causales_controller/eliminar_tipo_causal",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrartipos_causales("",1,5);

		}


	});

}