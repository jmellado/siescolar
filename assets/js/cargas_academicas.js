$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarcargas_academicas("",1,5);
	//llenarcombo_anos_lectivos();
	llenarcombo_profesores();
	//llenarcombo_grados();

	// este metodo permite enviar la inf del formulario
	$("#form_cargas_academicas").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_cargas_academicas").valid()==true){

			$.ajax({

				url:$("#form_cargas_academicas").attr("action"),
				type:$("#form_cargas_academicas").attr("method"),
				data:$("#form_cargas_academicas").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_cargas_academicas")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="cargas_academicas ya existe"){
						
						toastr.success('Carga Academica Ya Fue Asignada', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarcargas_academicas("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_cargas_academicas").click(function(){

		$("#modal_agregar_cargas_academicas").modal();
       
    });

    $("#btn_buscar_cargas_academicas").click(function(event){
		
       mostrarcargas_academicas("",1,5);
    });

    $("#buscar_cargas_academicas").keyup(function(event){

    	buscar = $("#buscar_cargas_academicas").val();
		valorcantidad = $("#cantidad_cargas_academicas").val();
		mostrarcargas_academicas(buscar,1,valorcantidad);
		
    });

    $("#cantidad_cargas_academicas").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_cargas_academicas").val();
    	mostrarcargas_academicas(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_cargas_academicas li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_cargas_academicas").val();
    	valorcantidad = $("#cantidad_cargas_academicas").val();
		mostrarcargas_academicas(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_cargas_academicas button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_cargas_academicas(idsele);

		}

	});

	$("body").on("click","#lista_cargas_academicas a",function(event){
		event.preventDefault();
		$("#modal_actualizar_cargas_academicas").modal();
		id_carga_academicasele = $(this).attr("href");
		id_profesorsele = $(this).parent().parent().children("td:eq(2)").text();
		id_grado2sele = $(this).parent().parent().children("td:eq(4)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		id_gruposele = $(this).parent().parent().children("td:eq(8)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(10)").text();
		
		//alert(id_asignaturasele);

		llenarcombo_asignaturas_cargas(id_grado2sele,id_asignaturasele);
		$("#id_carga_academicasele").val(id_carga_academicasele);
		$("#id_profesorsele").val(id_profesorsele);
        $("#id_grado2sele").val(id_grado2sele);
        $("#id_asignaturasele").val(id_asignaturasele);
        $("#id_gruposele").val(id_gruposele);
        $("#ano_lectivosele").val(ano_lectivosele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_cargas_academicas").click(function(event){

    	if($("#form_cargas_academicas_actualizar").valid()==true){
       	actualizar_cargas_academicas();
       	//bloquear_cajas_texto();

       }
       else{
			alert("formulario incorrecto");
			//alert($("#form_cargas_academicas_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


    $("#id_grado2").change(function(){
    	id_grado = $(this).val();
    	llenarcombo_asignaturas_cargas(id_grado,null);
    	//$("#municipio_expedicion").removeAttr("disabled");
    });

    $("#id_grado2sele").change(function(){
    	id_grado = $(this).val();
    	llenarcombo_asignaturas_cargas(id_grado,null);
    });




	$("#form_cargas_academicas").validate({

    	rules:{

    		id_profesor:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_asignatura:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_grupo:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			}

		}


	});

	$("#form_cargas_academicas_actualizar").validate({

    	rules:{

    		id_profesor:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_asignatura:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_grupo:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrarcargas_academicas(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"cargas_academicas_controller/mostrarcargas_academicas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.cargas_academicas.length; i++) {
					html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_carga_academica+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_profesor+"</td><td>"+registros.cargas_academicas[i].nombres+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_grado+"</td><td>"+registros.cargas_academicas[i].nombre_grado+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_asignatura+"</td><td>"+registros.cargas_academicas[i].nombre_asignatura+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_grupo+"</td><td>"+registros.cargas_academicas[i].nombre_grupo+"</td><td style='display:none'>"+registros.cargas_academicas[i].ano_lectivo+"</td><td>"+registros.cargas_academicas[i].nombre_ano_lectivo+"</td><td><a class='btn btn-success' href="+registros.cargas_academicas[i].id_carga_academica+">editar</a></td><td><button type='button' class='btn btn-danger' value="+registros.cargas_academicas[i].id_carga_academica+">eliminar</button></td></tr>";
				};
				
				$("#lista_cargas_academicas tbody").html(html);

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
				$(".paginacion_cargas_academicas").html(paginador);

			}

	});

}


function eliminar_cargas_academicas(valor){

	$.ajax({
		url:base_url+"cargas_academicas_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarcargas_academicas("",1,5);

		}


	});



}

function actualizar_cargas_academicas(){

	$.ajax({
		url:base_url+"cargas_academicas_controller/modificar",
		type:"post",
        data:$("#form_cargas_academicas_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_cargas_academicas").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_cargas_academicas_actualizar")[0].reset();

				mostrarcargas_academicas("",1,5);

		}


	});

}

function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"cargas_academicas_controller/llenarcombo_anos_lectivos",
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

function llenarcombo_asignaturas_cargas(valor,valor2){

	$.ajax({
		url:base_url+"cargas_academicas_controller/llenarcombo_asignaturas",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_asignatura"]==valor2){
						html +="<option value="+registros[i]["id_asignatura"]+" selected>"+registros[i]["nombre_asignatura"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					}
				};
				
				$("#asignatura_carga select").html(html);
		}

	});
}

function llenarcombo_grados(){

	$.ajax({
		url:base_url+"cargas_academicas_controller/llenarcombo_grados",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
				};
				
				$("#grado1 select").html(html);
		}

	});
}

function llenarcombo_profesores(){

	$.ajax({
		url:base_url+"cargas_academicas_controller/llenarcombo_profesores",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_persona"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+"</option>";
				};
				
				$("#profesor1 select").html(html);
		}

	});
}