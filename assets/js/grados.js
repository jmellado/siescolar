$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrargrados("",1,5);
	llenarcombo_niveles_educacion();

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
						
						toastr.success('Grado Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_grados")[0].reset();
						llenarcombo_niveles_educacion("","");
						llenarcombo_grados_educacion("","");

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Grado No Registrado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="gradoyaexiste"){
						
						toastr.warning('Grado Ya Registrado.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrargrados("",1,5);

						
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 5000});
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

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrargrados(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_grados button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("Esta Seguro De Eliminar Este Grado.?")){
			eliminar_grado(idsele);

		}

	});

	$("body").on("click","#lista_grados a",function(event){
		event.preventDefault();
		$("#modal_actualizar_grado").modal();
		id_gradosele = $(this).attr("href");
		nombre_gradosele = $(this).parent().parent().children("td:eq(2)").text();
		nivel_educacionsele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		ano_lectivosele = $(this).parent().parent().children("td:eq(5)").text();
		anolectivosele = $(this).parent().parent().children("td:eq(6)").text();
		estado_gradosele = $(this).parent().parent().children("td:eq(7)").text();
		
		//alert(municipio_expedicionsele);

		llenarcombo_grados_educacion(nivel_educacionsele,nombre_gradosele);
		$("#id_gradosele").val(id_gradosele);
        $("#nombre_gradosele").val(nombre_gradosele);
        $("#nivel_educacionsele").val(nivel_educacionsele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#anolectivosele").val(anolectivosele);
        $("#estado_gradosele").val(estado_gradosele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_grado").click(function(event){

    	if($("#form_grados_actualizar").valid()==true){
	       	actualizar_grado();
	       	//bloquear_cajas_texto();

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
			//alert($("#form_grados_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


    $("#nivel_educacion").change(function(){
    	id_nivel = $(this).val();
    	llenarcombo_grados_educacion(id_nivel,null);
    });


    $("#nivel_educacionsele").change(function(){
    	id_nivel = $(this).val();
    	llenarcombo_grados_educacion(id_nivel,null);
    });


    $("#modal_agregar_grado").on('hidden.bs.modal', function () {
        $("#form_grados")[0].reset();
        $("#grados_educacion1 select").html("");
        $("#form_grados").valid()==true;
    });


    $("#modal_actualizar_grado").on('hidden.bs.modal', function () {
        $("#form_grados_actualizar")[0].reset();
        $("#grados_educacion1 select").html("");
        $("#form_grados_actualizar").valid()==true;
    });


	$("#form_grados").validate({

    	rules:{

			nombre_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			nivel_educacion:{
				required: true,
				maxlength: 45
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

	$("#form_grados_actualizar").validate({

    	rules:{

			nombre_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			nivel_educacion:{
				required: true,
				maxlength: 45
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
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
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

				if (registros.grados.length > 0) {

					for (var i = 0; i < registros.grados.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.grados[i].id_grado+"</td><td>"+registros.grados[i].nombre_grado+"</td><td style='display:none'>"+registros.grados[i].nivel_educacion+"</td><td>"+registros.grados[i].nombre_nivel+"</td><td style='display:none'>"+registros.grados[i].ano_lectivo+"</td><td>"+registros.grados[i].nombre_ano_lectivo+"</td><td>"+registros.grados[i].estado_grado+"</td><td><a class='btn btn-success' href="+registros.grados[i].id_grado+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.grados[i].id_grado+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_grados tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Grados Registrados..</p></td></tr>";
					$("#lista_grados tbody").html(html);
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
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Grado Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Grado No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="gradoyaexiste"){
					
					toastr.warning('Grado Ya Registrado.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="gradoencursos"){
					
					toastr.warning('No Se Puede Modificar La Información De Este Grado; Actualmente Se Encuentra Asociado A Un Curso.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="gradoenpensum"){
					
					toastr.warning('No Se Puede Modificar La Información De Este Grado; Actualmente Se Encuentra Asociado A Un Pensum.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('La Información Corresponde A Un Año Lectivo Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_grados_actualizar")[0].reset();

				mostrargrados("",1,5);

		}


	});

}

function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"grados_controller/llenarcombo_anos_lectivos",
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


function llenarcombo_niveles_educacion(){

	$.ajax({
		url:base_url+"grados_controller/llenarcombo_niveles_educacion",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_nivel"]+">"+registros[i]["nombre_nivel"]+"</option>";
				};
				
				$("#niveles_educacion1 select").html(html);
		}

	});
}

function llenarcombo_grados_educacion(valor,valor2){

	$.ajax({
		url:base_url+"grados_controller/llenarcombo_grados_educacion",
		type:"post",
		data:{id_nivel:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if (registros[i]["nombre_grado"] == valor2) {

						html +="<option value="+registros[i]["nombre_grado"]+" selected>"+registros[i]["nombre_grado"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["nombre_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
					}
					
				};
				
				$("#grados_educacion1 select").html(html);
		}

	});
}