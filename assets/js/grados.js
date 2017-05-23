$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrargrados("",1,5);
	// este metodo permite enviar la inf del formulario
	$("#form_grados").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_grados").valid()==true){

			$.ajax({

				url:$("#form_grados").attr("action"),
				type:$("#form_grados").attr("method"),
				data:$("#form_grados").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_grados")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="estudiante ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrargrados("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_grado").click(function(){

		$("#modal_agregar_grado").modal();
       
    });

    $("#btn_buscar_grado").click(function(event){
		
       mostrargrados("",1,5);
    });

    $("#buscar_grado").keyup(function(event){

    	buscar = $("#buscar_grado").val();
		valorcantidad = $("#cantidad_grado").val();
		mostrargrados(buscar,1,valorcantidad);
		
    });

    $("#cantidad_grado").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_grado").val();
    	mostrargrados(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_grado li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_grado").val();
    	valorcantidad = $("#cantidad_grado").val();
		mostrargrados(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_grados button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_grado(idsele);

		}

	});

	$("body").on("click","#lista_grados a",function(event){
		event.preventDefault();
		$("#modal_actualizar_grado").modal();
		id_gradosele = $(this).attr("href");
		nombre_gradosele = $(this).parent().parent().children("td:eq(1)").text();
		ciclo_gradosele = $(this).parent().parent().children("td:eq(2)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		jornadasele = $(this).parent().parent().children("td:eq(3)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(4)").text();
		estado_gradosele = $(this).parent().parent().children("td:eq(5)").text();
		
		//alert(municipio_expedicionsele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_gradosele").val(id_gradosele);
        $("#nombre_gradosele").val(nombre_gradosele);
        $("#ciclo_gradosele").val(ciclo_gradosele);
        $("#jornadasele").val(jornadasele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#estado_gradosele").val(estado_gradosele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_grado").click(function(event){

    	if($("#form_grados_actualizar").valid()==true){
       	actualizar_grado();
       	//bloquear_cajas_texto();

       }
       else{
			alert("formulario incorrecto");
			alert($("#form_estudiantes_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });






	$("#form_grados, #form_grados_actualizar").validate({

    	rules:{

			nombre_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			ciclo_grado:{
				required: true,
				maxlength: 45,
				//lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 30,
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_grado:{
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


function mostrargrados(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"grados_controller/mostrargrados",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.grados.length; i++) {
					html +="<tr><td>"+registros.grados[i].id_grado+"</td><td>"+registros.grados[i].nombre_grado+"</td><td>"+registros.grados[i].ciclo_grado+"</td><td>"+registros.grados[i].jornada+"</td><td>"+registros.grados[i].año_lectivo+"</td><td>"+registros.grados[i].estado_grado+"</td><td><a class='btn btn-success' href="+registros.grados[i].id_grado+">editar</a></td><td><button type='button' class='btn btn-danger' value="+registros.grados[i].id_grado+">eliminar</button></td></tr>";
				};
				
				$("#lista_grados tbody").html(html);

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
				$(".paginacion_grado").html(paginador);

			}

	});

}


function eliminar_grado(valor){

	$.ajax({
		url:base_url+"grados_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrargrados("",1,5);

		}


	});



}

function actualizar_grado(){

	$.ajax({
		url:base_url+"grados_controller/modificar",
		type:"post",
        data:$("#form_grados_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_grado").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_grados_actualizar")[0].reset();

				mostrargrados("",1,5);

		}


	});

}