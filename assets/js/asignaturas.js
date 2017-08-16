$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarasignaturas("",1,5);
	//llenarcombo_anos_lectivos();
	llenarcombo_areas();

	// este metodo permite enviar la inf del formulario
	$("#form_asignaturas").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_asignaturas").valid()==true){

			$.ajax({

				url:$("#form_asignaturas").attr("action"),
				type:$("#form_asignaturas").attr("method"),
				data:$("#form_asignaturas").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_asignaturas")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="asignatura ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarasignaturas("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_asignatura").click(function(){

		$("#modal_agregar_asignatura").modal();
       
    });

    $("#btn_buscar_asignatura").click(function(event){
		
       mostrarasignaturas("",1,5);
    });

    $("#buscar_asignatura").keyup(function(event){

    	buscar = $("#buscar_asignatura").val();
		valorcantidad = $("#cantidad_asignatura").val();
		mostrarasignaturas(buscar,1,valorcantidad);
		
    });

    $("#cantidad_asignatura").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_asignatura").val();
    	mostrarasignaturas(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_asignatura li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_asignatura").val();
    	valorcantidad = $("#cantidad_asignatura").val();
		mostrarasignaturas(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_asignaturas button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_asignatura(idsele);

		}

	});

	$("body").on("click","#lista_asignaturas a",function(event){
		event.preventDefault();
		$("#modal_actualizar_asignatura").modal();
		id_asignaturasele = $(this).attr("href");
		nombre_asignaturasele = $(this).parent().parent().children("td:eq(1)").text();
		id_areasele = $(this).parent().parent().children("td:eq(2)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		ano_lectivosele = $(this).parent().parent().children("td:eq(4)").text();
		estado_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();
		
		//alert(municipio_expedicionsele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_asignaturasele").val(id_asignaturasele);
        $("#nombre_asignaturasele").val(nombre_asignaturasele);
        $("#id_areasele").val(id_areasele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#estado_asignaturasele").val(estado_asignaturasele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_asignatura").click(function(event){

    	if($("#form_asignaturas_actualizar").valid()==true){
       	actualizar_asignatura();
       	//bloquear_cajas_texto();

       }
       else{
			alert("formulario incorrecto");
			alert($("#form_asignaturas_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });






	$("#form_asignaturas").validate({

    	rules:{

			nombre_asignatura:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_area:{
				required: true,
				maxlength: 15,
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_asignatura:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});

	$("#form_asignaturas_actualizar").validate({

    	rules:{

			nombre_asignatura:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_area:{
				required: true,
				maxlength: 15,
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_asignatura:{
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


function mostrarasignaturas(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"asignaturas_controller/mostrarasignaturas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.asignaturas.length; i++) {
					html +="<tr><td>"+registros.asignaturas[i].id_asignatura+"</td><td>"+registros.asignaturas[i].nombre_asignatura+"</td><td style='display:none'>"+registros.asignaturas[i].id_area+"</td><td>"+registros.asignaturas[i].nombre_area+"</td><td style='display:none'>"+registros.asignaturas[i].ano_lectivo+"</td><td>"+registros.asignaturas[i].nombre_ano_lectivo+"</td><td>"+registros.asignaturas[i].estado_asignatura+"</td><td><a class='btn btn-success' href="+registros.asignaturas[i].id_asignatura+">editar</a></td><td><button type='button' class='btn btn-danger' value="+registros.asignaturas[i].id_asignatura+">eliminar</button></td></tr>";
				};
				
				$("#lista_asignaturas tbody").html(html);

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
				$(".paginacion_asignatura").html(paginador);

			}

	});

}


function eliminar_asignatura(valor){

	$.ajax({
		url:base_url+"asignaturas_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarasignaturas("",1,5);

		}


	});



}

function actualizar_asignatura(){

	$.ajax({
		url:base_url+"asignaturas_controller/modificar",
		type:"post",
        data:$("#form_asignaturas_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_asignatura").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_asignaturas_actualizar")[0].reset();

				mostrarasignaturas("",1,5);

		}


	});

}

function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"asignaturas_controller/llenarcombo_anos_lectivos",
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

function llenarcombo_areas(){

	$.ajax({
		url:base_url+"asignaturas_controller/llenarcombo_areas",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_area"]+">"+registros[i]["nombre_area"]+"</option>";
				};
				
				$("#area1 select").html(html);
		}

	});
}