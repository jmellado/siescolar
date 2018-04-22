$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostraranoslectivos("",1,5);

	$("#form_anoslectivos").submit(function (event) {
		//validar()
		event.preventDefault();
		if($("#form_anoslectivos").valid()==true){

			$.ajax({

				url:$("#form_anoslectivos").attr("action"),
				type:$("#form_anoslectivos").attr("method"),
				data:$("#form_anoslectivos").serialize(),
				success:function(respuesta) {

		
					if (respuesta==="registroguardado") {
						
						toastr.success('Registro Guardado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_anoslectivos")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Registro No Guardado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="anolectivoyaexiste"){
						
						toastr.warning('Año Lectivo Ya Registrado.', 'Success Alert', {timeOut: 5000});
							

					}
					else if(respuesta==="registrodenegado"){
						
						toastr.warning('Año Lectivo No Registrado; Solo Puede Tener Un Año Lectivo Activo.', 'Success Alert', {timeOut: 5000});
						$("#form_anoslectivos")[0].reset();	

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostraranoslectivos("",1,5);
					llenarcombo_anolectivo();
						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}

	});


	$("#btn_agregar_anolectivo").click(function(){

		$("#modal_agregar_anolectivo").modal();
		llenarcombo_anolectivo();
       
    });

    $("#btn_buscar_anolectivo").click(function(event){
		
       mostraranoslectivos("",1,5);
    });

    $("#buscar_anolectivo").keyup(function(event){

    	buscar = $("#buscar_anolectivo").val();
		valorcantidad = $("#cantidad_anolectivo").val();
		mostraranoslectivos(buscar,1,valorcantidad);
		
    });

    $("#cantidad_anolectivo").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_anolectivo").val();
    	mostraranoslectivos(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_anolectivo li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_anolectivo").val();
    	valorcantidad = $("#cantidad_anolectivo").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostraranoslectivos(buscar,numero_pagina,valorcantidad);
		}

    });

    $("body").on("click","#lista_anoslectivos .btn-eliminar",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("Esta Seguro De Eliminar Este Año Lectivo.?")){
			eliminar_anolectivo(idsele);

		}

	});

	$("body").on("click","#lista_anoslectivos .btn-seleccionar",function(event){
		event.preventDefault();
		id_anolectivo = $(this).attr("value");
		seleccionado = $(this).parent().parent().children("td:eq(6)").text();
		
		if (seleccionado =="Si") {

			toastr.warning('El Año Lectivo Ya Se Encuentra Seleccionado.', 'Success Alert', {timeOut: 3000});
		}
		else{
			if(confirm("Esta Seguro De Seleccionar Este Año Lectivo.?")){
				seleccionar_anolectivo(id_anolectivo);

			}
		}

	});

	$("body").on("click","#lista_anoslectivos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_anolectivo").modal();
		id_anolectivosele = $(this).attr("href");
		anolectivosele = $(this).parent().parent().children("td:eq(2)").text();
		fecha_iniciosele = $(this).parent().parent().children("td:eq(3)").text();
		fecha_finsele = $(this).parent().parent().children("td:eq(4)").text();
		estado_anolectivosele = $(this).parent().parent().children("td:eq(5)").text();
		
		$("#id_anolectivosele").val(id_anolectivosele);
        $("#anolectivosele").val(anolectivosele);
        $("#fecha_iniciosele").val(fecha_iniciosele);
        $("#fecha_finsele").val(fecha_finsele);
        $("#estado_anolectivosele").val(estado_anolectivosele);
     
	});

	
    $("#btn_actualizar_anolectivo").click(function(event){

    	if($("#form_anoslectivos_actualizar").valid()==true){
       		actualizar_anolectivo();

       	}
       	else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#modal_agregar_anolectivo").on('hidden.bs.modal', function () {
        $("#form_anoslectivos")[0].reset();
        $("#form_anoslectivos").valid()==true;
    });


    $("#modal_actualizar_anolectivo").on('hidden.bs.modal', function () {
        $("#form_anoslectivos_actualizar")[0].reset();
        $("#form_anoslectivos_actualizar").valid()==true;
    });



	$("#form_anoslectivos").validate({

    	rules:{

			anolectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			fecha_inicio:{
				required: true	

			},

			fecha_fin:{
				required: true	

			},

			estado_anolectivo:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});

	$("#form_anoslectivos_actualizar").validate({

    	rules:{

			anolectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			fecha_inicio:{
				required: true	

			},

			fecha_fin:{
				required: true	

			},

			estado_anolectivo:{
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


function mostraranoslectivos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"configuraciones_controller/mostraranoslectivos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.anoslectivos.length > 0) {

					for (var i = 0; i < registros.anoslectivos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.anoslectivos[i].id_ano_lectivo+"</td><td>"+registros.anoslectivos[i].nombre_ano_lectivo+"</td><td>"+registros.anoslectivos[i].fecha_inicio+"</td><td>"+registros.anoslectivos[i].fecha_fin+"</td><td>"+registros.anoslectivos[i].estado_ano_lectivo+"</td><td>"+registros.anoslectivos[i].seleccionado+"</td><td><a class='btn btn-success' href="+registros.anoslectivos[i].id_ano_lectivo+" title='Actualizar Información De Este Año Lectivo'><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-warning btn-seleccionar' value="+registros.anoslectivos[i].id_ano_lectivo+" title='Seleccionar Este Año Lectivo'><i class='fa fa-check-square-o'></i></button><td style='display:none'><button type='button' class='btn btn-danger btn-eliminar' value="+registros.anoslectivos[i].id_ano_lectivo+" title='Eliminar Este Año Lectivo'><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_anoslectivos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Años Lectivos Registrados..</p></td></tr>";
					$("#lista_anoslectivos tbody").html(html);
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
				$(".paginacion_anolectivo").html(paginador);

			}

	});

}


function eliminar_anolectivo(valor){

	$.ajax({
		url:base_url+"configuraciones_controller/eliminar_anolectivo",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostraranoslectivos("",1,5);

		}


	});

}

function actualizar_anolectivo(){

	$.ajax({
		url:base_url+"configuraciones_controller/modificar_anolectivo",
		type:"post",
        data:$("#form_anoslectivos_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_anolectivo").modal('hide');
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Año Lectivo Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Año Lectivo No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('No Se Pudo Actualizar; El Año Lectivo Se Encuentra Cerrado.', 'Success Alert', {timeOut: 3000});
					
				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_anoslectivos_actualizar")[0].reset();

				mostraranoslectivos("",1,5);

		}


	});

}

function llenarcombo_anolectivo(){

	$.ajax({
		url:base_url+"configuraciones_controller/llenarcombo_anolectivo",
		type:"post",
		success:function(respuesta) {
				
				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["nombre_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#anolectivo1 select").html(html);
		}

	});
}


function seleccionar_anolectivo(valor){

	$.ajax({
		url:base_url+"configuraciones_controller/seleccionar_anolectivo",
		type:"post",
        data:{id_anolectivo:valor},
		success:function(respuesta) {
				
				
			if (respuesta==="registroseleccionado") {
					
				toastr.success('Año Lectivo Seleccionado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

			}
			else if(respuesta==="registronoseleccionado"){
				
				toastr.error('Año Lectivo No Seleccionado.', 'Success Alert', {timeOut: 3000});
				
			}
			else{

				toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
			}

			mostraranoslectivos("",1,5);

		}


	});

}