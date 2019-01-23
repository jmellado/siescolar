$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarcriterios_promocion("",1,5);

	$("#form_criterios_promocion").submit(function (event) {
		
		event.preventDefault();
		if($("#form_criterios_promocion").valid()==true){

			$.ajax({

				url:$("#form_criterios_promocion").attr("action"),
				type:$("#form_criterios_promocion").attr("method"),
				data:$("#form_criterios_promocion").serialize(),
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Criterio Asignado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_criterios_promocion")[0].reset();
						ocultardiv_parametros();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Criterio No Asignado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="criterioyaexiste"){
						
						toastr.warning('Criterio Ya Fue Asignado.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
					mostrarcriterios_promocion("",1,5);
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
		}

	});


	$("#btn_agregar_criterios_promocion").click(function(){

		$("#modal_agregar_criterios_promocion").modal();
		llenarcombo_criterios();
		llenarcombo_gradosCP();
       
    });

    $("#id_criterio").change(function(){

    	id_criterio = $("#id_criterio").val();
    	ocultardiv_parametros();
    	mostrardiv_parametros(id_criterio);
    });

    $("#id_gradoCP").change(function(){

    	id_criterio = $("#id_criterio").val();
    	ocultardiv_parametros();
    	mostrardiv_parametros(id_criterio);
    });

    $("#btn_buscar_criterios_promocion").click(function(event){
		
       mostrarcriterios_promocion("",1,5);
    });

    $("#buscar_criterios_promocion").keyup(function(event){

    	buscar = $("#buscar_criterios_promocion").val();
		valorcantidad = $("#cantidad_criterios_promocion").val();
		mostrarcriterios_promocion(buscar,1,valorcantidad);
		
    });

    $("#cantidad_criterios_promocion").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_criterios_promocion").val();
    	mostrarcriterios_promocion(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_criterios_promocion li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_criterios_promocion").val();
    	valorcantidad = $("#cantidad_criterios_promocion").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarcriterios_promocion(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_criterios_promocion button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Este Criterio De Promoción.?")){
			eliminar_criterios_promocion(idsele);

		}

	});

    $("body").on("click","#lista_criterios_promocion a",function(event){
		event.preventDefault();
		$("#modal_actualizar_criterios_promocion").modal();
		id_criterio_asignadosele = $(this).attr("href");
		id_gradosele = $(this).parent().parent().children("td:eq(2)").text();
		nombre_gradosele = $(this).parent().parent().children("td:eq(3)").text();
		id_criteriosele = $(this).parent().parent().children("td:eq(4)").text();
		nombre_criteriosele = $(this).parent().parent().children("td:eq(5)").text();
		codigo_criteriosele = $(this).parent().parent().children("td:eq(6)").text();
		numero_areas_asignaturassele = $(this).parent().parent().children("td:eq(7)").text();
		porcentaje_inasistenciassele = $(this).parent().parent().children("td:eq(8)").text();
		asignatura_especificasele = $(this).parent().parent().children("td:eq(9)").text();

		$("#id_criterio_asignadosele").val(id_criterio_asignadosele);
        $("#nombre_gradosele").val(nombre_gradosele);
        $("#nombre_criteriosele").val(nombre_criteriosele);
        $("#codigo_criteriosele").val(codigo_criteriosele);

        ocultardiv_parametros_actualizar();
        mostrardiv_parametros_actualizar(codigo_criteriosele,id_gradosele,numero_areas_asignaturassele,porcentaje_inasistenciassele,asignatura_especificasele);

	});

	$("#btn_actualizar_criterios_promocion").click(function(event){

    	if($("#form_criterios_promocion_actualizar").valid()==true){
       		actualizar_criterios_promocion();

      	}
       	else{
			toastr.warning('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });

    $("#modal_agregar_criterios_promocion").on('hidden.bs.modal', function () {
        $("#form_criterios_promocion")[0].reset();
        ocultardiv_parametros();
        var validator = $("#form_criterios_promocion").validate();
        validator.resetForm();
    });

    $("#modal_actualizar_criterios_promocion").on('hidden.bs.modal', function () {
        $("#form_criterios_promocion_actualizar")[0].reset();
        ocultardiv_parametros_actualizar();
        var validator = $("#form_criterios_promocion_actualizar").validate();
        validator.resetForm();
    });


    $("#form_criterios_promocion").validate({

    	rules:{

			id_grado:{
				required: true	

			},

			id_criterio:{
				required: true	

			},

			numero_areas_asignaturas:{
				required: true,
				digits: true,
				min: 1,
				max: 30	

			},

			porcentaje_inasistencias:{
				required: true,
				digits: true,
				min: 1,
				max: 100

			},

			asignatura_especifica:{
				required: true
				
			}

		}


	});


	$("#form_criterios_promocion_actualizar").validate({

    	rules:{

			numero_areas_asignaturas:{
				required: true,
				digits: true,
				min: 1,
				max: 30	

			},

			porcentaje_inasistencias:{
				required: true,
				digits: true,
				min: 1,
				max: 100

			},

			asignatura_especifica:{
				required: true
				
			}

		}


	});

}


function mostrarcriterios_promocion(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"criterios_promocion_controller/mostrarcriterios_promocion",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.criterios_promocion.length > 0) {

					for (var i = 0; i < registros.criterios_promocion.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.criterios_promocion[i].id_criterio_asignado+"</td><td style='display:none'>"+registros.criterios_promocion[i].id_grado+"</td><td width='130'>"+registros.criterios_promocion[i].nombre_grado+"</td><td style='display:none'>"+registros.criterios_promocion[i].id_criterio+"</td><td width='220'><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.criterios_promocion[i].nombre_criterio+"</textarea></td><td style='display:none'>"+registros.criterios_promocion[i].codigo_criterio+"</td><td style='text-align:center'>"+registros.criterios_promocion[i].numero_areas_asignaturas+"</td><td style='text-align:center'>"+registros.criterios_promocion[i].porcentaje_inasistencias+"</td><td style='display:none'>"+registros.criterios_promocion[i].asignatura_especifica+"</td><td width='220'><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.criterios_promocion[i].nombre_asignatura+"</textarea></td><td style='display:none'>"+registros.criterios_promocion[i].ano_lectivo+"</td><td>"+registros.criterios_promocion[i].nombre_ano_lectivo+"</td><td><a class='btn btn-success' href="+registros.criterios_promocion[i].id_criterio_asignado+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.criterios_promocion[i].id_criterio_asignado+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_criterios_promocion tbody").html(html);
				}
				else{
					html ="<tr><td colspan='9'><p style='text-align:center'>No Hay Criterios De Promoción Asignados..</p></td></tr>";
					$("#lista_criterios_promocion tbody").html(html);
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
				$(".paginacion_criterios_promocion").html(paginador);

			}

	});

}


function llenarcombo_criterios(){

	$.ajax({
		url:base_url+"criterios_promocion_controller/llenarcombo_criterios",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_criterio"]+">"+registros[i]["nombre_criterio"]+"</option>";
				};
				
				$("#criterio1 select").html(html);
		}

	});
}


function llenarcombo_gradosCP(){

	$.ajax({
		url:base_url+"criterios_promocion_controller/llenarcombo_grados",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
				};
				
				$("#gradoCP1 select").html(html);
		}

	});
}


function llenarcombo_asignaturasCP(id_grado){

	$.ajax({
		url:base_url+"criterios_promocion_controller/llenarcombo_asignaturas",
		type:"post",
		data:{id_grado:id_grado},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
				};
				
				$("#asignaturaCP1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_actualizarCP(id_grado,asignatura_especifica){

	$.ajax({
		url:base_url+"criterios_promocion_controller/llenarcombo_asignaturas",
		type:"post",
		data:{id_grado:id_grado},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if(registros[i]["id_asignatura"] == asignatura_especifica){
					
						html +="<option value="+registros[i]["id_asignatura"]+" selected>"+registros[i]["nombre_asignatura"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					}	
				};
				
				$("#asignaturaCP11 select").html(html);
		}

	});
}


function actualizar_criterios_promocion(){

	$.ajax({
		url:base_url+"criterios_promocion_controller/modificar",
		type:"post",
        data:$("#form_criterios_promocion_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_criterios_promocion").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Criterio Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Criterio No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="criterioyaexiste"){
					
					toastr.warning('Criterio Ya Fue Asignado.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('No Se Puede Modificar La Información De Este Criterio; El Año Lectivo En El Que Fue Asignado, Se Encuentra Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_criterios_promocion_actualizar")[0].reset();

				mostrarcriterios_promocion("",1,5);

		}


	});

}


function eliminar_criterios_promocion(valor){

	$.ajax({
		url:base_url+"criterios_promocion_controller/eliminar",
		type:"post",
        data:{id_criterio_asignado:valor},
		success:function(respuesta) {

				
				if (respuesta==="registroeliminado") {
					
					toastr.success('Criterio Eliminado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoeliminado"){
					
					toastr.error('Criterio No Eliminado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('No Se Puede Eliminar Este Criterio; El Año Lectivo En El Que Fue Asignado, Se Encuentra Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}
				
				mostrarcriterios_promocion("",1,5);

		}


	});

}


function mostrardiv_parametros(id_criterio){

	limpiar_parametros();

    if (id_criterio =="") {

    	div = document.getElementById('vacio');
    	div.style.display = '';

    }else if (id_criterio =="1") {

    	div = document.getElementById('1');
    	div.style.display = '';

    }else if (id_criterio =="2") {

    	div = document.getElementById('2');
    	div.style.display = '';
    	
    }else{

    	div = document.getElementById('3');
    	div.style.display = '';

    	id_grado = $("#id_gradoCP").val();
    	llenarcombo_asignaturasCP(id_grado);

    }

}


function ocultardiv_parametros(){

	limpiar_parametros();

	div = document.getElementById('vacio');
    div.style.display = 'none';

	div = document.getElementById('1');
    div.style.display = 'none';

    div = document.getElementById('2');
    div.style.display = 'none';

    div = document.getElementById('3');
    div.style.display = 'none';
}


function limpiar_parametros(){

	$("#numero_areas_asignaturas").val("");
	$("#porcentaje_inasistencias").val("");
	$("#asignaturaCP1 select").html("");

}


function mostrardiv_parametros_actualizar(id_criterio,id_gradosele,numero_areas_asignaturassele,porcentaje_inasistenciassele,asignatura_especificasele){

	limpiar_parametros_actualizar();

    if (id_criterio =="1") {

    	div = document.getElementById('11');
    	div.style.display = '';

    	$("#numero_areas_asignaturassele").val(numero_areas_asignaturassele);

    }else if (id_criterio =="2") {

    	div = document.getElementById('22');
    	div.style.display = '';

    	$("#porcentaje_inasistenciassele").val(porcentaje_inasistenciassele);
    	
    }else{

    	div = document.getElementById('33');
    	div.style.display = '';

    	llenarcombo_asignaturas_actualizarCP(id_gradosele,asignatura_especificasele);
    }

}


function ocultardiv_parametros_actualizar(){

	limpiar_parametros_actualizar();

	div = document.getElementById('11');
    div.style.display = 'none';

    div = document.getElementById('22');
    div.style.display = 'none';

    div = document.getElementById('33');
    div.style.display = 'none';
}


function limpiar_parametros_actualizar(){

	$("#numero_areas_asignaturassele").val("");
	$("#porcentaje_inasistenciassele").val("");
	$("#asignaturaCP11 select").html("");

}