$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarpensum("",1,5);
	//llenarcombo_anos_lectivos();
	llenarcombo_asignaturas();
	//llenarcombo_grados();

	// este metodo permite enviar la inf del formulario
	$("#form_pensum").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_pensum").valid()==true){

			$.ajax({

				url:$("#form_pensum").attr("action"),
				type:$("#form_pensum").attr("method"),
				data:$("#form_pensum").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_pensum")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="pensum ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarpensum("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_pensum").click(function(){

		$("#modal_agregar_pensum").modal();
       
    });

    $("#btn_buscar_pensum").click(function(event){
		
       mostrarpensum("",1,5);
    });

    $("#buscar_pensum").keyup(function(event){

    	buscar = $("#buscar_pensum").val();
		valorcantidad = $("#cantidad_pensum").val();
		mostrarpensum(buscar,1,valorcantidad);
		
    });

    $("#cantidad_pensum").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_pensum").val();
    	mostrarpensum(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_pensum li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_pensum").val();
    	valorcantidad = $("#cantidad_pensum").val();
		mostrarpensum(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_pensum button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_pensum(idsele);

		}

	});

	$("body").on("click","#lista_pensum a",function(event){
		event.preventDefault();
		$("#modal_actualizar_pensum").modal();
		id_pensumsele = $(this).attr("href");
		id_gradosele = $(this).parent().parent().children("td:eq(1)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		intensidad_horariasele = $(this).parent().parent().children("td:eq(5)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(6)").text();
		estado_pensumsele = $(this).parent().parent().children("td:eq(8)").text();
		
		//alert(municipio_expedicionsele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_pensumsele").val(id_pensumsele);
        $("#id_gradosele").val(id_gradosele);
        $("#id_asignaturasele").val(id_asignaturasele);
        $("#intensidad_horariasele").val(intensidad_horariasele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#estado_pensumsele").val(estado_pensumsele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_pensum").click(function(event){

    	if($("#form_pensum_actualizar").valid()==true){
       	actualizar_pensum();
       	//bloquear_cajas_texto();

       }
       else{
			alert("formulario incorrecto");
			alert($("#form_pensum_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });






	$("#form_pensum").validate({

    	rules:{

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

			intensidad_horaria:{
				required: true,
				maxlength: 2
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

	$("#form_pensum_actualizar").validate({

    	rules:{

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

			intensidad_horaria:{
				required: true,
				maxlength: 2
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


function mostrarpensum(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"pensum_controller/mostrarpensum",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.pensum.length; i++) {
					html +="<tr><td>"+registros.pensum[i].id_pensum+"</td><td style='display:none'>"+registros.pensum[i].id_grado+"</td><td>"+registros.pensum[i].nombre_grado+"</td><td style='display:none'>"+registros.pensum[i].id_asignatura+"</td><td>"+registros.pensum[i].nombre_asignatura+"</td><td>"+registros.pensum[i].intensidad_horaria+"</td><td style='display:none'>"+registros.pensum[i].ano_lectivo+"</td><td>"+registros.pensum[i].nombre_ano_lectivo+"</td><td>"+registros.pensum[i].estado_pensum+"</td><td><a class='btn btn-success' href="+registros.pensum[i].id_pensum+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.pensum[i].id_pensum+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				
				$("#lista_pensum tbody").html(html);

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
				$(".paginacion_pensum").html(paginador);

			}

	});

}


function eliminar_pensum(valor){

	$.ajax({
		url:base_url+"pensum_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarpensum("",1,5);

		}


	});



}

function actualizar_pensum(){

	$.ajax({
		url:base_url+"pensum_controller/modificar",
		type:"post",
        data:$("#form_pensum_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_pensum").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_pensum_actualizar")[0].reset();

				mostrarpensum("",1,5);

		}


	});

}

function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"pensum_controller/llenarcombo_anos_lectivos",
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

function llenarcombo_asignaturas(){

	$.ajax({
		url:base_url+"pensum_controller/llenarcombo_asignaturas",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
				};
				
				$("#asignatura1 select").html(html);
		}

	});
}

function llenarcombo_grados(){

	$.ajax({
		url:base_url+"pensum_controller/llenarcombo_grados",
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