$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarelecciones("",1,5);

	$("#form_elecciones").submit(function (event) {
		
		event.preventDefault(); 
		if($("#form_elecciones").valid()==true){

			$.ajax({

				url:$("#form_elecciones").attr("action"),
				type:$("#form_elecciones").attr("method"),
				data:$("#form_elecciones").serialize(),   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Elección Registrada Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_elecciones")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Elección No Registrada.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="eleccionyaexiste"){
						
						toastr.warning('Elección Ya Existente.', 'Success Alert', {timeOut: 5000});
							

					}
					else if(respuesta==="anionoexiste"){
						
						toastr.warning('Elección No Registrada; No Se Encontró Un Año Lectivo Activo.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarelecciones("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});

	$("#btn_agregar_eleccion").click(function(){

		$("#modal_agregar_eleccion").modal();
       
    });


    $("#btn_buscar_eleccion").click(function(event){
		
       mostrarelecciones("",1,5);
    });

    $("#buscar_eleccion").keyup(function(event){

    	buscar = $("#buscar_eleccion").val();
		valorcantidad = $("#cantidad_eleccion").val();
		mostrarelecciones(buscar,1,valorcantidad);
		
    });

    $("#cantidad_eleccion").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_eleccion").val();
    	mostrarelecciones(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_eleccion li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_eleccion").val();
    	valorcantidad = $("#cantidad_eleccion").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
			mostrarelecciones(buscar,numero_pagina,valorcantidad);
		}

    });

    $("body").on("click","#lista_elecciones button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Esta Elección.?")){
			eliminar_eleccion(idsele);

		}

	});

	$("body").on("click","#lista_elecciones a",function(event){
		event.preventDefault();
		$("#modal_actualizar_eleccion").modal();
		id_eleccionsele = $(this).attr("href");
		nombre_eleccionsele = $(this).parent().parent().children("td:eq(2)").text();
		descripcion_eleccionsele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		fecha_inicio_eleccionsele = $(this).parent().parent().children("td:eq(4)").text();
		hora_inicio_eleccionsele = $(this).parent().parent().children("td:eq(5)").text();
		fecha_fin_eleccionsele = $(this).parent().parent().children("td:eq(6)").text();
		hora_fin_eleccionsele = $(this).parent().parent().children("td:eq(7)").text();
		ano_lectivoeleccionsele = $(this).parent().parent().children("td:eq(8)").text();
		anolectivoeleccionsele = $(this).parent().parent().children("td:eq(9)").text();
		estado_eleccionsele = $(this).parent().parent().children("td:eq(10)").text();
		
		$("#id_eleccionsele").val(id_eleccionsele);
        $("#nombre_eleccionsele").val(nombre_eleccionsele);
        $("#descripcion_eleccionsele").val(descripcion_eleccionsele);
        $("#fecha_inicio_eleccionsele").val(fecha_inicio_eleccionsele);
        $("#hora_inicio_eleccionsele").val(hora_inicio_eleccionsele);
        $("#fecha_fin_eleccionsele").val(fecha_fin_eleccionsele);
        $("#hora_fin_eleccionsele").val(hora_fin_eleccionsele);
        $("#ano_lectivoeleccionsele").val(ano_lectivoeleccionsele);
        $("#estado_eleccionsele").val(estado_eleccionsele);

	});

	
    $("#btn_actualizar_eleccion").click(function(event){

    	if($("#form_elecciones_actualizar").valid()==true){
       		actualizar_eleccion();
       	
       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 2000});
			
		}
		
       
    });


    $("#modal_agregar_eleccion").on('hidden.bs.modal', function () {
        $("#form_elecciones")[0].reset();
        $("#form_elecciones").valid()==true;
    });


    $("#modal_actualizar_eleccion").on('hidden.bs.modal', function () {
        $("#form_elecciones_actualizar")[0].reset();
        $("#form_elecciones_actualizar").valid()==true;
    });



    $("#form_elecciones").validate({

    	rules:{

			nombre_eleccion:{
				required: true,
				maxlength: 50
				//lettersonly: true	

			},

			descripcion_eleccion:{
				required: true,
				maxlength: 300
					

			},

			fecha_inicio:{
				required: true,
				date: true
		

			},

			hora_inicio:{
				required: true
		

			},

			fecha_fin:{
				required: true,
				date: true
		

			},

			hora_fin:{
				required: true
		

			}


		}

	});

	$("#form_elecciones_actualizar").validate({

    	rules:{

			nombre_eleccion:{
				required: true,
				maxlength: 50
				//lettersonly: true	

			},

			descripcion_eleccion:{
				required: true,
				maxlength: 300
					

			},

			fecha_inicio:{
				required: true,
				date: true
		

			},

			hora_inicio:{
				required: true
		

			},

			fecha_fin:{
				required: true,
				date: true
		

			},

			hora_fin:{
				required: true
		

			}


		}

	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");

}


function mostrarelecciones(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"elecciones_controller/mostrarelecciones",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.elecciones.length > 0) {

					for (var i = 0; i < registros.elecciones.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.elecciones[i].id_eleccion+"</td><td>"+registros.elecciones[i].nombre_eleccion+"</td><td style='display:none'>"+registros.elecciones[i].descripcion+"</td><td>"+registros.elecciones[i].fecha_inicio+"</td><td>"+registros.elecciones[i].hora_inicio+"</td><td>"+registros.elecciones[i].fecha_fin+"</td><td>"+registros.elecciones[i].hora_fin+"</td><td style='display:none'>"+registros.elecciones[i].ano_lectivo+"</td><td>"+registros.elecciones[i].nombre_ano_lectivo+"</td><td>"+registros.elecciones[i].estado_eleccion+"</td><td><a class='btn btn-success' href="+registros.elecciones[i].id_eleccion+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.elecciones[i].id_eleccion+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_elecciones tbody").html(html);
				}
				else{
					html ="<tr><td colspan='10'><p style='text-align:center'>No Hay Elecciones Creadas..</p></td></tr>";
					$("#lista_elecciones tbody").html(html);
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
				$(".paginacion_eleccion").html(paginador);

			}

	});

}


function eliminar_eleccion(valor){

	$.ajax({
		url:base_url+"elecciones_controller/eliminar_eleccion",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 3000});
				mostrarelecciones("",1,5);

		}


	});



}

function actualizar_eleccion(){

	$.ajax({
		url:base_url+"elecciones_controller/modificar_eleccion",
		type:"post",
        data:$("#form_elecciones_actualizar").serialize(),
		success:function(respuesta) {
				

				$("#modal_actualizar_eleccion").modal('hide');
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Elección Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Elección No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="eleccionyaexiste"){
					
					toastr.warning('Elección Ya Existente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('La Información Corresponde A Un Año Lectivo Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_elecciones_actualizar")[0].reset();

				mostrarelecciones("",1,5);

		}


	});

}