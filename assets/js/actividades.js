$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_persona = $("#id_persona").val();
	mostraractividades("",1,5,id_persona);
	llenarcombo_cursos_profesorA(id_persona);


	// este metodo permite enviar la inf del formulario
	$("#form_actividades").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejecute la accion del boton del formulario
		if($("#form_actividades").valid()==true){

			$.ajax({

				url:$("#form_actividades").attr("action"),
				type:$("#form_actividades").attr("method"),
				data:$("#form_actividades").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Actividad Guardada Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_actividades")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Actividad No Guardada.', 'Success Alert', {timeOut: 5000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostraractividades("",1,5,id_persona);	
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_agregar_actividad").click(function(){

		$("#modal_agregar_actividad").modal();
       
    });

    $("#id_cursoA").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_asignaturas_profesorA(id_persona,id_curso);

    });

    $("#btn_buscar_actividad").click(function(event){
		
       mostraractividades("",1,5,id_persona);
    });

    $("#buscar_actividad").keyup(function(event){

    	buscar = $("#buscar_actividad").val();
		valorcantidad = $("#cantidad_actividad").val();
		mostraractividades(buscar,1,valorcantidad,id_persona);
		
    });

    $("#cantidad_actividad").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_actividad").val();
    	mostraractividades(buscar,1,valorcantidad,id_persona);
    });

    $("body").on("click", ".paginacion_actividad li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_actividad").val();
    	valorcantidad = $("#cantidad_actividad").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
    		
			mostraractividades(buscar,numero_pagina,valorcantidad,id_persona);
		}	


    });

    $("body").on("click","#lista_actividades a",function(event){
		event.preventDefault();
		$("#modal_actualizar_actividad").modal();
		id_actividadsele = $(this).attr("href");
		descripcion_actividadsele = $(this).parent().parent().children("td:eq(2)").text();
		periodosele = $(this).parent().parent().children("td:eq(3)").text();
		cursosele = $(this).parent().parent().children("td:eq(5)").text();
		asignaturasele = $(this).parent().parent().children("td:eq(7)").text();
		
		$("#id_actividadsele").val(id_actividadsele);
        $("#periodoseleA").val(periodosele);
        $("#cursoseleA").val(cursosele);
        $("#asignaturaseleA").val(asignaturasele);
        $("#descripcion_actividadseleA").val(descripcion_actividadsele);

	});

	$("#btn_actualizar_actividad").click(function(event){

    	if($("#form_actividades_actualizar").valid()==true){
       		actualizar_actividad();

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });

    $("body").on("click","#lista_actividades button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Esta Actividad.?")){
			eliminar_actividad(idsele);

		}

	});

    $("#modal_agregar_actividad").on('hidden.bs.modal', function () {
        $("#form_actividades")[0].reset();
        $("#form_actividades").valid()==true;
    });

    $("#modal_actualizar_actividad").on('hidden.bs.modal', function () {
        $("#form_actividades_actualizar")[0].reset();
        $("#form_actividades_actualizar").valid()==true;
    });


    $("#form_actividades").validate({

    	rules:{

			id_profesor:{
				required: true,
				digits: true	

			},

			periodo:{
				required: true,
				maxlength: 8

			},

			id_curso:{
				required: true,
				digits: true

			},

			id_asignatura:{
				required: true,
				digits: true	

			},

			descripcion_actividad:{
				required: true,
				maxlength: 300	

			}


		}


	});

	$("#form_actividades_actualizar").validate({

    	rules:{

			descripcion_actividad:{
				required: true,
				maxlength: 300	

			}


		}


	});

	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//======================== Funciones Para La Calificacion De Actividades =================================


	$("#btn_consultar_actividades").click(function(){

		if ($("#form_consultar_actividades").valid()==true) {
			
	    	periodo = $("#periodoCA").val();
			id_curso = $("#id_cursoCA").val();
			id_asignatura = $("#id_asignaturaCA").val();

			mostrardiv_actividades();
			mostraractividadesCA("",1,5,id_persona,periodo,id_curso,id_asignatura);
		}


	});


	$("#id_cursoCA").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_asignaturas_profesorA(id_persona,id_curso);
    	ocultardiv_actividades();
    });


    $("#id_asignaturaCA").change(function(){
    	ocultardiv_actividades();
    });


    $("#periodoCA").change(function(){
    	ocultardiv_actividades();
    });


	$("#form_consultar_actividades").validate({

    	rules:{

			periodo:{
				required: true,
				maxlength: 8

			},

			id_curso:{
				required: true,
				digits: true

			},

			id_asignatura:{
				required: true,
				digits: true	

			}

		}


	});


	$("#cantidad_actividadCA").change(function(){
		periodo = $("#periodoCA").val();
		id_curso = $("#id_cursoCA").val();
		id_asignatura = $("#id_asignaturaCA").val();

    	valorcantidad = $(this).val();
    	mostraractividadesCA("",1,valorcantidad,id_persona,periodo,id_curso,id_asignatura);
    });


    $("body").on("click", ".paginacion_actividadCA li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	valorcantidad = $("#cantidad_actividadCA").val();

    	periodo = $("#periodoCA").val();
		id_curso = $("#id_cursoCA").val();
		id_asignatura = $("#id_asignaturaCA").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
    		
			mostraractividadesCA("",numero_pagina,valorcantidad,id_persona,periodo,id_curso,id_asignatura);
		}	


    });


    $("body").on("click","#lista_actividadesCA button",function(event){
		event.preventDefault();
		$("#modal_ingresar_notas_actividad").modal();
		id_actividadsele = $(this).attr("value");
		descripcion_actividadsele = $(this).parent().parent().children("td:eq(2)").text();
		periodosele = $(this).parent().parent().children("td:eq(3)").text();
		id_cursosele = $(this).parent().parent().children("td:eq(4)").text();
		cursosele = $(this).parent().parent().children("td:eq(5)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();
		asignaturasele = $(this).parent().parent().children("td:eq(7)").text();
		
		$("#id_actividadseleCA").val(id_actividadsele);
        $("#periodoseleCA").val(periodosele);
        $("#id_cursoseleCA").val(id_cursosele);
        $("#cursoseleCA").val(cursosele);
        $("#id_asignaturaseleCA").val(id_asignaturasele);
        $("#asignaturaseleCA").val(asignaturasele);
        $("#descripcion_actividadseleCA").val(descripcion_actividadsele);
       
        mostrarnotasactividad("",1,5,id_cursosele,id_actividadsele);

	});


	$("#btn_registrar_nota_actividad").click(function(event){

		if(validarCampoNotaCA() == true){

			$.ajax({

				url:$("#form_notas_actividad_insertar").attr("action"),
				type:$("#form_notas_actividad_insertar").attr("method"),
				data:$("#form_notas_actividad_insertar").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Notas Registradas Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						id_curso = $("#id_cursoseleCA").val();
						id_actividad = $("#id_actividadseleCA").val();
						mostrarnotasactividad("",1,5,id_cursosele,id_actividadsele);
					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Notas No Registradas.', 'Success Alert', {timeOut: 5000});
		
					}
					else if(respuesta==="nohayestudiantes"){
						
						toastr.warning('No Hay Información Por Registrar.', 'Success Alert', {timeOut: 5000});
							
					}
					else if(respuesta==="notasincorrectas"){
						
						toastr.warning('Las Notas Ingresadas Son Incorrectas.', 'Success Alert', {timeOut: 3000});	

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
	
						
				}

			});

		}else{

			toastr.warning('Faltan Notas Por Ingresar.', 'Success Alert', {timeOut: 3000});
		}
       
    });


    $("#cantidad_nota_actividad").change(function(){
		
		id_curso = $("#id_cursoseleCA").val();
		id_actividad = $("#id_actividadseleCA").val();

    	valorcantidad = $(this).val();
    	mostrarnotasactividad("",1,valorcantidad,id_curso,id_actividad);
    });


    $("body").on("click", ".paginacion_nota_actividad li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	valorcantidad = $("#cantidad_nota_actividad").val();

		id_curso = $("#id_cursoseleCA").val();
		id_actividad = $("#id_actividadseleCA").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
    		
			mostrarnotasactividad("",numero_pagina,valorcantidad,id_curso,id_actividad);
		}	


    });


    //======================== Funciones Para La Consulta De Notas =================================


    $("#btn_consultar_notas").click(function(){

		if ($("#form_consultar_notas").valid()==true) {
			
	    	periodo = $("#periodoCN").val();
			id_curso = $("#id_cursoCN").val();
			id_asignatura = $("#id_asignaturaCN").val();

			mostrardiv_notas();
			mostrarnotasasignatura("",1,5,id_persona,periodo,id_curso,id_asignatura);
		}


	});


	$("#id_cursoCN").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_asignaturas_profesorA(id_persona,id_curso);
    	ocultardiv_notas();
    });


    $("#id_asignaturaCN").change(function(){
    	ocultardiv_notas();
    });


    $("#periodoCN").change(function(){
    	ocultardiv_notas();
    });


	$("#form_consultar_notas").validate({

    	rules:{

			periodo:{
				required: true,
				maxlength: 8

			},

			id_curso:{
				required: true,
				digits: true

			},

			id_asignatura:{
				required: true,
				digits: true	

			}

		}


	});


	$("body").on("click","#lista_notas_asignatura button",function(event){
		event.preventDefault();
		$("#modal_ver_notas_actividades").modal();
		id_estudiantesele = $(this).attr("value");
		periodosele = $(this).parent().parent().children("td:eq(3)").text();
		id_cursosele = $(this).parent().parent().children("td:eq(4)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();
       
        mostrarnotasactividades("",1,5,id_cursosele,id_asignaturasele,periodosele,id_estudiantesele);

	});

}


function mostraractividades(valor,pagina,cantidad,id_persona){

	$.ajax({
		url:base_url+"actividades_controller/mostraractividades",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.actividades.length > 0) {

					for (var i = 0; i < registros.actividades.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.actividades[i].id_actividad+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.actividades[i].descripcion_actividad+"</textarea></td></td><td>"+registros.actividades[i].periodo+"</td><td style='display:none'>"+registros.actividades[i].id_curso+"</td><td>"+registros.actividades[i].nombre_grado+" "+registros.actividades[i].nombre_grupo+" "+registros.actividades[i].jornada+"</td><td style='display:none'>"+registros.actividades[i].id_asignatura+"</td><td>"+registros.actividades[i].nombre_asignatura+"</td><td><a class='btn btn-success' href="+registros.actividades[i].id_actividad+" title='Actualizar Información De La Actividad'><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.actividades[i].id_actividad+" title='Eliminar Actividad'><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_actividades tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Actividades Registradas..</p></td></tr>";
					$("#lista_actividades tbody").html(html);
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
				$(".paginacion_actividad").html(paginador);

			}

	});

}


function llenarcombo_cursos_profesorA(valor){

	$.ajax({
		url:base_url+"actividades_controller/llenarcombo_cursos_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_actividades1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorA(valor,valor2){

	$.ajax({
		url:base_url+"actividades_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_curso:valor2},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_actividades1 select").html(html);
		}

	});
}


function eliminar_actividad(valor){

	$.ajax({
		url:base_url+"actividades_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 3000});
				mostraractividades("",1,5,id_persona);

		}


	});



}


function actualizar_actividad(){

	$.ajax({
		url:base_url+"actividades_controller/modificar",
		type:"post",
        data:$("#form_actividades_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_actividad").modal('hide');
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Actividad Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Actividad No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_actividades_actualizar")[0].reset();

				mostraractividades("",1,5,id_persona);

		}


	});

}


//======================== Funciones Para La Calificacion De Actividades =================================


function mostrardiv_actividades(){

	div = document.getElementById('div_actividades');
    div.style.display = '';
}

function ocultardiv_actividades(){

	div = document.getElementById('div_actividades');
    div.style.display = 'none';
}


//esta funcion me permite obtener las activades creadas por un profesor, por periodo, curso y asignatura
function mostraractividadesCA(valor,pagina,cantidad,id_persona,periodo,id_curso,id_asignatura){

	$.ajax({
		url:base_url+"actividades_controller/mostraractividadesCA",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona,periodo:periodo,id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.actividades.length > 0) {

					for (var i = 0; i < registros.actividades.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.actividades[i].id_actividad+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.actividades[i].descripcion_actividad+"</textarea></td></td><td>"+registros.actividades[i].periodo+"</td><td style='display:none'>"+registros.actividades[i].id_curso+"</td><td>"+registros.actividades[i].nombre_grado+" "+registros.actividades[i].nombre_grupo+" "+registros.actividades[i].jornada+"</td><td style='display:none'>"+registros.actividades[i].id_asignatura+"</td><td>"+registros.actividades[i].nombre_asignatura+"</td><td><button type='button' class='btn btn-warning' value="+registros.actividades[i].id_actividad+" title='Calificar Actividad'><i class='fa  fa-caret-right'></i>&nbsp;Calificar</button></td></tr>";
					};
					
					$("#lista_actividadesCA tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Actividades Registradas..</p></td></tr>";
					$("#lista_actividadesCA tbody").html(html);
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
				$(".paginacion_actividadCA").html(paginador);

			}

	});

}


function mostrarnotasactividad(valor,pagina,cantidad,id_curso,id_actividad){

	$.ajax({
		url:base_url+"actividades_controller/mostrarnotasactividad",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso,id_actividad:id_actividad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.notas.length > 0) {

					for (var i = 0; i < registros.notas.length; i++) {
						
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_estudiante[]' id='id_estudiante' value='"+registros.notas[i].id_estudiante+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='nota[]' id='nota' value='"+registros.notas[i].nota+"' size='2' onKeypress='return valida_nota_actividad(event)'></td></tr>";
					};
					
					$("#lista_notas_actividad tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Estudiantes Registrados..</p></td></tr>";
					$("#lista_notas_actividad tbody").html(html);
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
				$(".paginacion_nota_actividad").html(paginador);

			}

	});

}


function valida_nota_actividad(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9\.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


function validarCampoNotaCA(){

	var resn=[];
    var resy=[];
    var vacio = "";

   	var notas = document.getElementsByName("nota[]");

   	for(i = 0; i < notas.length; i++){

   		if(notas[i].value != vacio){

   			resy.push("si")
   		}
   		else{
   			resn.push("no");
   		}


   	}

   	if(resy.length == notas.length){

		//alert("ok");
		return true;
	}
	else{
		//alert("no");
		return false;
	}

}


//======================== Funciones Para La Consulta De Notas =================================


function mostrardiv_notas(){

	div = document.getElementById('div_notas');
    div.style.display = '';
}

function ocultardiv_notas(){

	div = document.getElementById('div_notas');
    div.style.display = 'none';
}


//esta funcion me permite obtener las notas definitivas de una aisgnatura en un determinado periodo y curso.
function mostrarnotasasignatura(valor,pagina,cantidad,id_persona,periodo,id_curso,id_asignatura){

	$.ajax({
		url:base_url+"actividades_controller/mostrarnotasasignatura",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona,periodo:periodo,id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.notas.length > 0) {

					for (var i = 0; i < registros.notas.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.notas[i].id_estudiante+"</td><td>"+registros.notas[i].apellido1+" "+registros.notas[i].apellido2+" "+registros.notas[i].nombres+"</td><td>"+registros.notas[i].periodo+"</td><td style='display:none'>"+registros.notas[i].id_curso+"</td><td>"+registros.notas[i].nombre_grado+" "+registros.notas[i].nombre_grupo+" "+registros.notas[i].jornada+"</td><td style='display:none'>"+registros.notas[i].id_asignatura+"</td><td>"+registros.notas[i].nombre_asignatura+"</td><td>"+registros.notas[i].nota+"</td><td><button type='button' class='btn btn-warning' value="+registros.notas[i].id_estudiante+" title='Ver Notas Por Actividades'><i class='fa fa-eye'></i></button></td></tr>";
					};
					
					$("#lista_notas_asignatura tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Notas Registradas..</p></td></tr>";
					$("#lista_notas_asignatura tbody").html(html);
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
				$(".paginacion_nota_asignatura").html(paginador);

			}

	});

}


function mostrarnotasactividades(valor,pagina,cantidad,id_curso,id_asignatura,periodo,id_estudiante){

	$.ajax({
		url:base_url+"actividades_controller/mostrarnotasactividades",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso,id_asignatura:id_asignatura,periodo:periodo,id_estudiante:id_estudiante},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.notas.length > 0) {

					for (var i = 0; i < registros.notas.length; i++) {
						
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.notas[i].id_estudiante+"</td><td style='display:none'>"+registros.notas[i].identificacion+"</td><td style='display:none'>"+registros.notas[i].nombres+" "+registros.notas[i].apellido1+" "+registros.notas[i].apellido2+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.notas[i].descripcion_actividad+"</textarea></td><td align='center'>"+registros.notas[i].nota+"</td></tr>";
					};
					
					$("#lista_notas_actividades tbody").html(html);
				}
				else{
					html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Actividades Registradas..</p></td></tr>";
					$("#lista_notas_actividades tbody").html(html);
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
				$(".paginacion_notas_actividades").html(paginador);

			}

	});

}