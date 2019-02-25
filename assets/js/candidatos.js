$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_elecciones();
	mostrarcandidatos("",1,5);

	$("#form_candidatos").submit(function (event) {
		
		event.preventDefault();
		var formData = new FormData($("#form_candidatos")[0]);

		if($("#form_candidatos").valid()==true){

			$.ajax({

				url:$("#form_candidatos").attr("action"),
				type:$("#form_candidatos").attr("method"),
				data:formData,
				cache:false,
				contentType:false,
				processData:false,   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Candidato Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_candidatos")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Candidato No Registrado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="candidatoyaexiste"){
						
						toastr.warning('Candidato Ya Existente.', 'Success Alert', {timeOut: 5000});
							

					}
					else if(respuesta==="numeroyaexiste"){
						
						toastr.warning('El Número De Tarjetón Ya Fue Asignado.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarcandidatos("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_agregar_candidato").click(function(){

		$("#modal_agregar_candidato").modal();
       
    });

    $("#btn_buscar_candidato").click(function(event){
		
       mostrarcandidatos("",1,5);
    });

    $("#buscar_candidato").keyup(function(event){

    	buscar = $("#buscar_candidato").val();
		valorcantidad = $("#cantidad_candidato").val();
		mostrarcandidatos(buscar,1,valorcantidad);
		
    });

    $("#cantidad_candidato").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_candidato").val();
    	mostrarcandidatos(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_candidato li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_candidato").val();
    	valorcantidad = $("#cantidad_candidato").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
			mostrarcandidatos(buscar,numero_pagina,valorcantidad);
		}

    });

    $("body").on("click","#lista_candidatos button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		id_eleccionsele = $(this).parent().parent().children("td:eq(2)").text();

		if(confirm("Esta Seguro De Eliminar Este Candidato.?")){
			eliminar_candidato(idsele,id_eleccionsele);

		}

	});

	$("body").on("click","#lista_candidatos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_candidato").modal();
		id_candidato_eleccion = $(this).attr("href");
		id_eleccionsele = $(this).parent().parent().children("td:eq(2)").text();
		eleccionsele = $(this).parent().parent().children("td:eq(3)").text();
		candidatosele = $(this).parent().parent().children("td:eq(5)").text();
		partidosele = $(this).parent().parent().children("td:eq(6)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		numerosele = $(this).parent().parent().children("td:eq(7)").text();
		
		$("#id_candidato_eleccion").val(id_candidato_eleccion);
		$("#id_eleccionsele").val(id_eleccionsele);
		$("#eleccionsele").val(eleccionsele);
        $("#candidatosele").val(candidatosele);
        $("#partidosele").val(partidosele);
        $("#numerosele").val(numerosele);

	});

	$("#btn_actualizar_candidato").click(function(event){

    	if($("#form_candidatos_actualizar").valid()==true){
       		actualizar_candidato();
       	
       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 2000});
			
		}
		
       
    });

    $("#modal_agregar_candidato").on('hidden.bs.modal', function () {
        $("#form_candidatos")[0].reset();
        $("#form_candidatos").valid()==true;
    });


    //******************* Estudiantes Matriculados **************************************
    $("#candidato").focus(function(){

    	$("#modal_buscar_estudiantes_matriculados").modal();
       
    });

    $("#btn_buscar_estudiante_matriculado").click(function(event){

    	if($("#buscar_estudiante_matriculado").val()==""){

			$("#buscar_estudiante_matriculado").val("");
        	$("#lista_estudiantes_matriculados tbody").html("");
		}
		else{

			buscar = $("#buscar_estudiante_matriculado").val();
       		mostrarestudiantes_matriculados(buscar);
		}
		
    });

    $("#buscar_estudiante_matriculado").keyup(function(event){

    	if($("#buscar_estudiante_matriculado").val()==""){

			$("#buscar_estudiante_matriculado").val("");
        	$("#lista_estudiantes_matriculados tbody").html("");
		}
		else{
	    	buscar = $("#buscar_estudiante_matriculado").val();
			mostrarestudiantes_matriculados(buscar);
		}
		
    });

    $("body").on("click","#lista_estudiantes_matriculados a",function(event){
		event.preventDefault();
		id_candidato = $(this).attr("href");
		candidato = $(this).parent().parent().children("td:eq(3)").text();
		
		$("#id_candidato").val(id_candidato);
        $("#candidato").val(candidato);
        $("#modal_buscar_estudiantes_matriculados").modal("hide");
	});


	$("#modal_buscar_estudiantes_matriculados").on('hidden.bs.modal', function () {
        
        $("#buscar_estudiante_matriculado").val("");
        $("#lista_estudiantes_matriculados tbody").html("");
    });

	//*************************************** Validaciones De Los Formularios ************************************************

    $("#form_candidatos").validate({

    	rules:{

			id_eleccion:{
				required: true

			},

			candidato:{
				required: true
					

			},

			partido:{
				required: true
		

			},

			numero:{
				required: true,
				digits: true,
				maxlength: 3,
				minlength: 1

			}


		}

	});

	$("#form_candidatos_actualizar").validate({

    	rules:{

			id_eleccion:{
				required: true

			},

			candidato:{
				required: true
					

			},

			partido:{
				required: true
		

			},

			numero:{
				required: true,
				digits: true,
				maxlength: 3,
				minlength: 1

			}


		}

	});


}


function mostrarcandidatos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"elecciones_controller/mostrarcandidatos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.candidatos.length > 0) {

					for (var i = 0; i < registros.candidatos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.candidatos[i].id_candidato_eleccion+"</td><td style='display:none'>"+registros.candidatos[i].id_eleccion+"</td><td>"+registros.candidatos[i].nombre_eleccion+"</td><td style='display:none'>"+registros.candidatos[i].id_estudiante+"</td><td>"+registros.candidatos[i].nombres+" "+registros.candidatos[i].apellido1+" "+registros.candidatos[i].apellido2+"</td><td>"+registros.candidatos[i].partido+"</td><td>"+registros.candidatos[i].numero+"</td><td>"+registros.candidatos[i].estado_candidato+"</td><td><a class='btn btn-success' href="+registros.candidatos[i].id_candidato_eleccion+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.candidatos[i].id_candidato_eleccion+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_candidatos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Candidatos Inscritos..</p></td></tr>";
					$("#lista_candidatos tbody").html(html);
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
				$(".paginacion_candidato").html(paginador);

			}

	});

}


function llenarcombo_elecciones(){

	$.ajax({
		url:base_url+"elecciones_controller/llenarcombo_elecciones",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_eleccion"]+">"+registros[i]["nombre_eleccion"]+"</option>";
				};
				
				$("#eleccion1 select").html(html);
		}

	});
}


function mostrarestudiantes_matriculados(valor){

	$.ajax({
		url:base_url+"elecciones_controller/mostrarestudiantes_matriculados",
		type:"post",
		data:{id_buscar:valor},
		success:function(respuesta) {
				
				registros = JSON.parse(respuesta);

				html ="";

				if (registros.estudiantes.length > 0) {

					for (var i = 0; i < registros.estudiantes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.estudiantes[i].id_estudiante+"</td><td>"+registros.estudiantes[i].identificacion+"</td><td>"+registros.estudiantes[i].nombres+" "+registros.estudiantes[i].apellido1+" "+registros.estudiantes[i].apellido2+"</td><td>"+registros.estudiantes[i].nombre_grado+"</td><td>"+registros.estudiantes[i].nombre_grupo+"</td><td><a class='btn btn-success' href="+registros.estudiantes[i].id_estudiante+"><i class='fa fa-check-square-o'></i></a></td></tr>";
					};
					
					$("#lista_estudiantes_matriculados tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Datos Disponibles..</p></td></tr>";
					$("#lista_estudiantes_matriculados tbody").html(html);
				}

				

			}

	});

}


function actualizar_candidato(){

	var formData = new FormData($("#form_candidatos_actualizar")[0]);

	$.ajax({
		url:base_url+"elecciones_controller/modificar_candidato",
		type:"post",
        data:formData,
        cache:false,
		contentType:false,
		processData:false, 
		success:function(respuesta) {
				

				$("#modal_actualizar_candidato").modal('hide');
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Candidato Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Candidato No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="numeroyaexiste"){
					
					toastr.warning('El Número De Tarjetón Ya Fue Asignado.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('La Información Corresponde A Un Año Lectivo Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_candidatos_actualizar")[0].reset();

				mostrarcandidatos("",1,5);

		}


	});

}


function eliminar_candidato(valor,valor2){

	$.ajax({
		url:base_url+"elecciones_controller/eliminar_candidato",
		type:"post",
        data:{id:valor,id_eleccion:valor2},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 3000});
				mostrarcandidatos("",1,5);

		}


	});



}