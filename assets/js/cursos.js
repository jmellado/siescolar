$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarcursos("",1,5);
	llenarcombo_directores();
	//llenarcombo_salones();
	//llenarcombo_grados();
	//llenarcombo_grupos();

	// este metodo permite enviar la inf del formulario
	$("#form_cursos").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		desbloquear_CampoAnoLectivo();

		if($("#form_cursos").valid()==true){

			$.ajax({

				url:$("#form_cursos").attr("action"),
				type:$("#form_cursos").attr("method"),
				data:$("#form_cursos").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Registro Guardado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_cursos")[0].reset();
						//llenarcombo_salones();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Registro No Guardado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="salon ya existe"){
						
						toastr.warning('El Salon Seleccionado Ya Fue Asignado.', 'Success Alert', {timeOut: 5000});
							

					}
					else if(respuesta==="gradogrupo ya existe"){
						
						toastr.warning('El Grado y Grupo Seleccionados Ya Estan Registrados.', 'Success Alert', {timeOut: 5000});
							

					}
					else if(respuesta==="director ya existe"){
						
						toastr.warning('El Director Seleccionado Ya Tiene Un Curso Asignado.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					bloquear_CampoAnoLectivo();
					mostrarcursos("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			bloquear_CampoAnoLectivo();
		}

	});


	$("#btn_agregar_curso").click(function(){

		$("#modal_agregar_curso").modal();
       
    });

    $("#btn_buscar_curso").click(function(event){
		
       mostrarcursos("",1,5);
    });

    $("#buscar_curso").keyup(function(event){

    	buscar = $("#buscar_curso").val();
		valorcantidad = $("#cantidad_curso").val();
		mostrarcursos(buscar,1,valorcantidad);
		
    });

    $("#cantidad_curso").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_curso").val();
    	mostrarcursos(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_curso li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_curso").val();
    	valorcantidad = $("#cantidad_curso").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarcursos(buscar,numero_pagina,valorcantidad);
		}	

    });

    $("body").on("click","#lista_cursos button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("Esta Seguro De Eliminar Este Curso.?")){
			eliminar_curso(idsele);

		}

	});

	$("body").on("click","#lista_cursos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_curso").modal();

		id_cursosele = $(this).attr("href");
		id_gradosele = $(this).parent().parent().children("td:eq(2)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		id_gruposele = $(this).parent().parent().children("td:eq(3)").text();
		id_salonsele = $(this).parent().parent().children("td:eq(4)").text();
		gradosele = $(this).parent().parent().children("td:eq(5)").text();
		gruposele = $(this).parent().parent().children("td:eq(6)").text();
		directorsele = $(this).parent().parent().children("td:eq(8)").text();
		cupo_maximosele = $(this).parent().parent().children("td:eq(10)").text();
		jornadasele = $(this).parent().parent().children("td:eq(11)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(12)").text();
		anolectivosele = $(this).parent().parent().children("td:eq(13)").text();

		llenarcombo_salones_actualizar(ano_lectivosele,id_salonsele);

		$("#id_cursosele").val(id_cursosele);
        $("#id_gradosele").val(id_gradosele);
        $("#gradosele").val(gradosele);
        $("#id_gruposele").val(id_gruposele);
        $("#gruposele").val(gruposele);
        $("#id_salonsele").val(id_salonsele);
        $("#directorsele").val(directorsele);
        $("#cupo_maximosele").val(cupo_maximosele);
        $("#jornadasele").val(jornadasele);
        $("#jornada-sele").val(jornadasele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#anolectivosele").val(anolectivosele);

	});

	
    $("#btn_actualizar_curso").click(function(event){

    	if($("#form_cursos_actualizar").valid()==true){

       		actualizar_curso();

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			//alert($("#form_cursos_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


    $("#modal_agregar_curso").on('hidden.bs.modal', function () {
        $("#form_cursos")[0].reset();
        $("#form_cursos").valid()==true;
    });


    $("#modal_actualizar_curso").on('hidden.bs.modal', function () {
        $("#form_cursos_actualizar")[0].reset();
        $("#form_cursos_actualizar").valid()==true;
    });



	$("#form_cursos").validate({

    	rules:{

			id_grado:{
				required: true,
				maxlength: 30

			},

			id_grupo:{
				required: true,
				maxlength: 15
				
			},

			id_salon:{
				required: true,
				maxlength: 15

			},

			director:{
				required: true,
				maxlength: 15

			},

			cupo_maximo:{
				required: true,
				maxlength: 2,
				digits: true,
				range: [1, 99]

			},

			jornada:{
				required: true,
				maxlength: 30,	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			}

		}


	});

	$("#form_cursos_actualizar").validate({

    	rules:{

			id_grado:{
				required: true,
				maxlength: 30

			},

			id_grupo:{
				required: true,
				maxlength: 15
				
			},

			id_salon:{
				required: true,
				maxlength: 15

			},

			director:{
				required: true,
				maxlength: 15

			},

			cupo_maximo:{
				required: true,
				maxlength: 2,
				digits: true,
				range: [1, 99]

			},

			jornada:{
				required: true,
				maxlength: 30,	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrarcursos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"cursos_controller/mostrarcursos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.cursos.length > 0) {

					for (var i = 0; i < registros.cursos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.cursos[i].id_curso+"</td><td style='display:none'>"+registros.cursos[i].id_grado+"</td><td style='display:none'>"+registros.cursos[i].id_grupo+"</td><td style='display:none'>"+registros.cursos[i].id_salon+"</td><td>"+registros.cursos[i].nombre_grado+"</td><td>"+registros.cursos[i].nombre_grupo+"</td><td>"+registros.cursos[i].nombre_salon+"</td><td style='display:none'>"+registros.cursos[i].director+"</td><td>"+registros.cursos[i].nombres+" "+registros.cursos[i].apellido1+"</td><td>"+registros.cursos[i].cupo_maximo+"</td><td>"+registros.cursos[i].jornada+"</td><td style='display:none'>"+registros.cursos[i].ano_lectivo+"</td><td>"+registros.cursos[i].nombre_ano_lectivo+"</td><td><a class='btn btn-success' href="+registros.cursos[i].id_curso+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.cursos[i].id_curso+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_cursos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='10'><p style='text-align:center'>No Hay Cursos Registrados..</p></td></tr>";
					$("#lista_cursos tbody").html(html);
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
				$(".paginacion_curso").html(paginador);

			}

	});

}


function eliminar_curso(valor){

	$.ajax({
		url:base_url+"cursos_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarcursos("",1,5);
				//llenarcombo_salones();

		}


	});



}

function actualizar_curso(){

	$.ajax({
		url:base_url+"cursos_controller/modificar",
		type:"post",
        data:$("#form_cursos_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_curso").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Curso Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Curso No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="cuponovalido"){
					
					toastr.warning('El Cupo Ingresado No Satisface El Número De Alumnos Actualmente Matriculados En Este Curso.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="directoryaexiste"){
					
					toastr.warning('El Director Seleccionado Ya Tiene Asignado Un Curso.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="salonyaexiste"){
					
					toastr.warning('El Aula Seleccionada Ya Fue Asignada.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="anolectivocerrado"){
					
					toastr.warning('La Información Corresponde A Un Año Lectivo Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_cursos_actualizar")[0].reset();

				mostrarcursos("",1,5);

		}


	});

}

//------------------------------FUNCIONES PARA LA GESTION DE CURSOS--------------------------------------------------------


function llenarcombo_salones(){

	$.ajax({
		url:base_url+"cursos_controller/llenarcombo_salones",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_salon"]+">"+registros[i]["nombre_salon"]+"</option>";
				};
				
				$("#salon1 select").html(html);
		}

	});
}

function llenarcombo_grados(){

	$.ajax({
		url:base_url+"cursos_controller/llenarcombo_grados",
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

function llenarcombo_grupos(){

	$.ajax({
		url:base_url+"cursos_controller/llenarcombo_grupos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grupo"]+">"+registros[i]["nombre_grupo"]+"</option>";
				};
				
				$("#grupo1 select").html(html);
		}

	});
}

function llenarcombo_directores(){

	$.ajax({
		url:base_url+"cursos_controller/llenarcombo_directores",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_persona"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
				};
				
				$("#director1 select").html(html);
		}

	});
}


function llenarcombo_salones_actualizar(ano_lectivo,id_salonsele){

	$.ajax({
		url:base_url+"cursos_controller/llenarcombo_salones_actualizar",
		type:"post",
		data:{ano_lectivo:ano_lectivo},
		success:function(respuesta) {
				
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if(registros[i]["id_salon"] == id_salonsele){
					
						html +="<option value="+registros[i]["id_salon"]+" selected>"+registros[i]["nombre_salon"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["id_salon"]+">"+registros[i]["nombre_salon"]+"</option>";
					}
				};
				
				$("#salon11 select").html(html);
		}

	});
}

function bloquear_CampoAnoLectivo(){

	$("#ano_lectivo").attr("disabled", "disabled");
}

function desbloquear_CampoAnoLectivo(){

	$("#ano_lectivo").removeAttr("disabled");
}

