$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarareas("",1,5);
	//llenarcombo_anos_lectivos();

	// este metodo permite enviar la inf del formulario
	$("#form_areas").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_areas").valid()==true){

			$.ajax({

				url:$("#form_areas").attr("action"),
				type:$("#form_areas").attr("method"),
				data:$("#form_areas").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Registro Guardado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_areas")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Registro No Guardado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="areayaexiste"){
						
						toastr.warning('Área Ya Registrada.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarareas("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_area").click(function(){

		$("#modal_agregar_area").modal();
       
    });

    $("#btn_buscar_area").click(function(event){
		
       mostrarareas("",1,5);
    });

    $("#buscar_area").keyup(function(event){

    	buscar = $("#buscar_area").val();
		valorcantidad = $("#cantidad_area").val();
		mostrarareas(buscar,1,valorcantidad);
		
    });

    $("#cantidad_area").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_area").val();
    	mostrarareas(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_area li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_area").val();
    	valorcantidad = $("#cantidad_area").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarareas(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_areas button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("Esta Seguro De Eliminar Esta Área.?")){
			eliminar_area(idsele);

		}

	});

	$("body").on("click","#lista_areas a",function(event){
		event.preventDefault();
		$("#modal_actualizar_area").modal();
		id_areasele = $(this).attr("href");
		nombre_areasele = $(this).parent().parent().children("td:eq(2)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(3)").text();
		estado_areasele = $(this).parent().parent().children("td:eq(5)").text();
		
		//alert(municipio_expedicionsele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_areasele").val(id_areasele);
        $("#nombre_areasele").val(nombre_areasele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#estado_areasele").val(estado_areasele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_area").click(function(event){

    	if($("#form_areas_actualizar").valid()==true){
       		actualizar_area();
       		//bloquear_cajas_texto();

      	}
       	else{
			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
			//alert($("#form_areas_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


    $("#modal_agregar_area").on('hidden.bs.modal', function () {
        $("#form_areas")[0].reset();
        $("#form_areas").valid()==true;
    });


    $("#modal_actualizar_area").on('hidden.bs.modal', function () {
        $("#form_areas_actualizar")[0].reset();
        $("#form_areas_actualizar").valid()==true;
    });



	$("#form_areas").validate({

    	rules:{

			nombre_area:{
				required: true,
				maxlength: 50
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_area:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});

	$("#form_areas_actualizar").validate({

    	rules:{

			nombre_area:{
				required: true,
				maxlength: 50
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_area:{
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


function mostrarareas(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"areas_controller/mostrarareas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.areas.length > 0) {

					for (var i = 0; i < registros.areas.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.areas[i].id_area+"</td><td>"+registros.areas[i].nombre_area+"</td><td style='display:none'>"+registros.areas[i].ano_lectivo+"</td><td>"+registros.areas[i].nombre_ano_lectivo+"</td><td>"+registros.areas[i].estado_area+"</td><td><a class='btn btn-success' href="+registros.areas[i].id_area+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.areas[i].id_area+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_areas tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Áreas Registradas..</p></td></tr>";
					$("#lista_areas tbody").html(html);
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
				$(".paginacion_area").html(paginador);

			}

	});

}


function eliminar_area(valor){

	$.ajax({
		url:base_url+"areas_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarareas("",1,5);

		}


	});



}

function actualizar_area(){

	$.ajax({
		url:base_url+"areas_controller/modificar",
		type:"post",
        data:$("#form_areas_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_area").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Área Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Área No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="areayaexiste"){
					
					toastr.warning('Área Ya Registrada.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_areas_actualizar")[0].reset();

				mostrarareas("",1,5);

		}


	});

}

function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"areas_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivo1 select").html(html);
		}

	});
}