$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_eleccionesV();
	llenarcombo_cursosV();
	mostrarvotantes("",1,5);

	$("#form_votantes").submit(function (event) {
		
		event.preventDefault(); 
		if($("#form_votantes").valid()==true){

			$.ajax({

				url:$("#form_votantes").attr("action"),
				type:$("#form_votantes").attr("method"),
				data:$("#form_votantes").serialize(),   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Votantes Registrados Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_votantes")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Votantes No Registrados.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="nohaycursos"){
						
						toastr.warning('Debe Seleccionar Un Curso.', 'Success Alert', {timeOut: 5000});
							

					}
					else if(respuesta==="registrodenegado"){
						
						toastr.warning('No Se Pueden Registrar Más Votantes; Ya Existen Votos Registrados Para Esta Elección.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarvotantes("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_agregar_votante").click(function(){

		$("#modal_agregar_votante").modal();
       
    });


    $("#btn_buscar_votante").click(function(event){
		
       mostrarvotantes("",1,5);
    });


    $("#buscar_votante").keyup(function(event){

    	buscar = $("#buscar_votante").val();
		valorcantidad = $("#cantidad_votante").val();
		mostrarvotantes(buscar,1,valorcantidad);
		
    });


    $("#cantidad_votante").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_votante").val();
    	mostrarvotantes(buscar,1,valorcantidad);
    });


    $("body").on("click","#lista_votantes button",function(event){
		event.preventDefault();
		id_eleccionsele = $(this).attr("value");
		
		if(confirm("Si Elimina Esta Elección, Se Eliminaran Todos Los Cursos Aptos Para Votar Que Fueron Asociados.Esta Seguro De Eliminar Esta Elección.?")){
			eliminar_votante(id_eleccionsele);

		}

	});


	$("body").on("click","#lista_votantes a",function(event){
		event.preventDefault();
		$("#modal_cursos_votantes").modal();
		id_eleccionsele = $(this).attr("href");
		mostrarcursos_votantes(id_eleccionsele);
	});


	$("body").on("click","#lista_cursos_votantes button",function(event){
		event.preventDefault();
		id_eleccionsele = $(this).attr("value");
		id_cursosele = $(this).parent().parent().children("td:eq(3)").text();
		
		if(confirm("Esta Seguro De Eliminar Este Curso Votante.?")){
			eliminarcurso_votante(id_eleccionsele,id_cursosele);

		}

	});


	$("#modal_agregar_votante").on('hidden.bs.modal', function () {
        $("#form_votantes")[0].reset();
        $("#form_votantes").valid()==true;
    });


	$("#form_votantes").validate({

    	rules:{

			id_eleccion:{
				required: true

			},

			id_curso:{
				required: true
					

			}


		}

	});


}


function mostrarvotantes(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"elecciones_controller/mostrarvotantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.votantes.length > 0) {

					for (var i = 0; i < registros.votantes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.votantes[i].id_eleccion+"</td><td>"+registros.votantes[i].nombre_eleccion+"</td><td style='display:none'>"+registros.votantes[i].descripcion+"</td><td><a class='btn btn-success' href="+registros.votantes[i].id_eleccion+" title='Ver Cursos Asociados'><i class='fa fa-th-large'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.votantes[i].id_eleccion+" title='Eliminar Elección'><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_votantes tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Elecciones Con Votantes..</p></td></tr>";
					$("#lista_votantes tbody").html(html);
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
				$(".paginacion_votante").html(paginador);

			}

	});

}


function llenarcombo_eleccionesV(){

	$.ajax({
		url:base_url+"elecciones_controller/llenarcombo_elecciones",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_eleccion"]+">"+registros[i]["nombre_eleccion"]+"</option>";
				};
				
				$("#eleccionV1 select").html(html);
		}

	});
}


function llenarcombo_cursosV(){

	$.ajax({
		url:base_url+"elecciones_controller/llenarcombo_cursos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
				};
				
				$("#cursosV1 select").html(html);
		}

	});
}


function eliminar_votante(valor){

	$.ajax({
		url:base_url+"elecciones_controller/eliminar_votante",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 3000});
				mostrarvotantes("",1,5);

		}


	});



}


function mostrarcursos_votantes(valor){

	$.ajax({
		url:base_url+"elecciones_controller/mostrarcursos_votantes",
		type:"post",
		data:{id_buscar:valor},
		success:function(respuesta) {
				
				registros = JSON.parse(respuesta);  

				html ="";

				if (registros.votantes.length > 0) {

					for (var i = 0; i < registros.votantes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.votantes[i].id_eleccion+"</td><td>"+registros.votantes[i].nombre_eleccion+"</td><td style='display:none'>"+registros.votantes[i].id_curso+"</td><td>"+registros.votantes[i].nombre_grado+" "+registros.votantes[i].nombre_grupo+" "+registros.votantes[i].jornada+"</td><td><button type='button' class='btn btn-danger' value="+registros.votantes[i].id_eleccion+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_cursos_votantes tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Elecciones Con Votantes..</p></td></tr>";
					$("#lista_cursos_votantes tbody").html(html);
				}

			}

	});

}


function eliminarcurso_votante(valor,valor2){

	$.ajax({
		url:base_url+"elecciones_controller/eliminarcurso_votante",
		type:"post",
        data:{id:valor,id_curso:valor2},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 3000});
				$("#modal_cursos_votantes").modal("hide");
				mostrarvotantes("",1,5);

		}


	});



}
