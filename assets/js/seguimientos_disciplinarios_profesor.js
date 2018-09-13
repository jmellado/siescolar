$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_persona = $("#id_persona").val();
	llenarcombo_cursos_profesorSG(id_persona);
	llenarcombo_tipos_causalesSG();
	llenarcombo_acciones_pedagogicasSG();
	mostrarseguimientos("",1,5,id_persona);


	// este metodo permite enviar la inf del formulario
	$("#form_seguimientos_disciplinarios").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejecute la accion del boton del formulario
		if($("#form_seguimientos_disciplinarios").valid()==true){

			$.ajax({

				url:$("#form_seguimientos_disciplinarios").attr("action"),
				type:$("#form_seguimientos_disciplinarios").attr("method"),
				data:$("#form_seguimientos_disciplinarios").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Seguimiento Guardado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_seguimientos_disciplinarios")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Seguimiento No Guardado.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="seguimientoyaexiste"){
						
						toastr.warning('Seguimiento Ya Registrado.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#id_cursoSG").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_asignaturas_profesorSG(id_persona,id_curso);
    	$("#estudiantes_seguimientos1 select").html("");

    });


    $("#id_asignaturaSG").change(function(){
    	id_curso = $("#id_cursoSG").val();
    	llenarcombo_estudiantesSG(id_curso);
    });


    $("#id_tipo_causalSG").change(function(){
    	id_tipo_causal = $(this).val();
    	llenarcombo_causalesSG(id_tipo_causal);
    });


    $("#btn_cancelar_seguimiento").click(function(event){
       	$("#form_seguimientos_disciplinarios")[0].reset();
       	$('#id_cursoSG-error').hide();
       	$('#id_asignaturaSG-error').hide();
       	$('#id_estudianteSG-error').hide();
       	$('#id_tipo_causalSG-error').hide();
       	$('#id_causalSG-error').hide();
       	$('#fecha_causalSG-error').hide();
       	$('#descripcion_situacionSG-error').hide();
       	$('#id_accion_pedagogicaSG-error').hide();
       	$('#descripcion_accionSG-error').hide();
       	$('#compromiso_estudianteSG-error').hide();
    });


    $("#form_seguimientos_disciplinarios").validate({

    	rules:{

			id_profesor:{
				required: true,
				maxlength: 15	

			},

			id_curso:{
				required: true,
				maxlength: 15

			},

			id_asignatura:{
				required: true,
				maxlength: 15	

			},

			id_estudiante:{
				required: true,
				maxlength: 15	

			},

			id_tipo_causal:{
				required: true,
				maxlength: 15	

			},

			id_causal:{
				required: true,
				maxlength: 15	

			},

			fecha_causal:{
				required: true,
				date: true	

			},

			descripcion_situacion:{
				required: true,
				maxlength: 500	

			},

			id_accion_pedagogica:{
				required: true,
				maxlength: 15	

			},

			descripcion_accion:{
				required: true,
				maxlength: 500	

			},

			compromiso_estudiante:{
				required: true,
				maxlength: 500	

			}


		}


	});

	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//**************** FUNCIONES PARA LA VISTA CONSULTAR *************************+

	$("#btn_buscar_seguimiento").click(function(event){
		
       mostrarseguimientos("",1,5,id_persona);
    });

    $("#buscar_seguimiento").keyup(function(event){

    	buscar = $("#buscar_seguimiento").val();
		valorcantidad = $("#cantidad_seguimiento").val();
		mostrarseguimientos(buscar,1,valorcantidad,id_persona);
		
    });

    $("#cantidad_seguimiento").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_seguimiento").val();
    	mostrarseguimientos(buscar,1,valorcantidad,id_persona);
    });

    $("body").on("click", ".paginacion_seguimiento li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_seguimiento").val();
    	valorcantidad = $("#cantidad_seguimiento").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
    		
			mostrarseguimientos(buscar,numero_pagina,valorcantidad,id_persona);
		}	


    });

    $("body").on("click","#lista_seguimientos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_seguimiento").modal();
		id_seguimientosele = $(this).attr("href");
		cursosele = $(this).parent().parent().children("td:eq(3)").text();
		asignaturasele = $(this).parent().parent().children("td:eq(5)").text();
		estudiantesele = $(this).parent().parent().children("td:eq(7)").text();
		id_tipo_causalseleSG = $(this).parent().parent().children("td:eq(8)").text();
		id_causalseleSG = $(this).parent().parent().children("td:eq(10)").text();
		descripcion_situacionseleSG = $(this).parent().parent().children("td:eq(12)").text();
		fecha_causalseleSG = $(this).parent().parent().children("td:eq(13)").text();
		id_accion_pedagogicaseleSG = $(this).parent().parent().children("td:eq(14)").text();
		descripcion_accionseleSG = $(this).parent().parent().children("td:eq(15)").text();
		compromiso_estudianteseleSG = $(this).parent().parent().children("td:eq(16)").text();
		observacionesseleSG = $(this).parent().parent().children("td:eq(17)").text();
		estado_seguimientoseleSG = $(this).parent().parent().children("td:eq(18)").text();

		llenarcombo_causalesSG(id_tipo_causalseleSG,id_causalseleSG);
		$("#id_seguimientosele").val(id_seguimientosele);
		$("#cursosele").val(cursosele);
        $("#asignaturasele").val(asignaturasele);
        $("#estudiantesele").val(estudiantesele);
        $("#id_tipo_causalseleSG").val(id_tipo_causalseleSG);
        $("#descripcion_situacionseleSG").val(descripcion_situacionseleSG);
        $("#fecha_causalseleSG").val(fecha_causalseleSG);
        $("#id_accion_pedagogicaseleSG").val(id_accion_pedagogicaseleSG);
        $("#descripcion_accionseleSG").val(descripcion_accionseleSG);
        $("#compromiso_estudianteseleSG").val(compromiso_estudianteseleSG);
        $("#observacionesseleSG").val(observacionesseleSG);

	});

	$("#id_tipo_causalseleSG").change(function(){
    	id_tipo_causal = $(this).val();
    	llenarcombo_causalesSG(id_tipo_causal,null);
    });

    $("#modal_actualizar_seguimiento").on('hidden.bs.modal', function () {
        $("#form_seguimientos_actualizar")[0].reset();
        $("#form_seguimientos_actualizar").valid()==true;
    });

    $("#btn_actualizar_seguimiento").click(function(event){

    	if($("#form_seguimientos_actualizar").valid()==true){
       		actualizar_seguimiento_disciplinario();

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}
		
       
    });


    $("#btn_cerrar_seguimiento").click(function(event){
		
		if($("#id_tipo_causalseleSG").val() !="" && $("#id_causalseleSG").val() !="" && $("#fecha_causalseleSG").val() !="" && $("#descripcion_situacionseleSG").val() !="" && $("#id_accion_pedagogicaseleSG").val() !="" && $("#descripcion_accionseleSG").val() !="" && $("#compromiso_estudianteseleSG").val() !="" && $("#observacionesseleSG").val() !=""){
			
			id_seguimiento = $("#id_seguimientosele").val();

			if(confirm("Esta Seguro De Cerrar Este Seguimiento.?")){
				cerrar_seguimiento_disciplinario(id_seguimiento);
			}
		}
		else{

			toastr.warning('Formulario Incorrecto; Debe Diligenciar Todos Los Campos Vacios.', 'Success Alert', {timeOut: 3000});
		}
       
    });


    $("#form_seguimientos_actualizar").validate({

    	rules:{

			id_tipo_causal:{
				required: true,
				maxlength: 15	

			},

			id_causal:{
				required: true,
				maxlength: 15	

			},

			fecha_causal:{
				required: true,
				date: true	

			},

			descripcion_situacion:{
				required: true,
				maxlength: 500	

			},

			id_accion_pedagogica:{
				required: true,
				maxlength: 15	

			},

			descripcion_accion:{
				required: true,
				maxlength: 500	

			},

			compromiso_estudiante:{
				required: true,
				maxlength: 500	

			}


		}


	});

	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_cursos_profesorSG(valor){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/llenarcombo_cursos_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_seguimientos1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorSG(valor,valor2){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_curso:valor2},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_seguimientos1 select").html(html);
		}

	});
}


function llenarcombo_estudiantesSG(valor){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/llenarcombo_estudiantes",
		type:"post",
		data:{id_curso:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
				};
				
				$("#estudiantes_seguimientos1 select").html(html);
		}

	});
}


function llenarcombo_tipos_causalesSG(){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/llenarcombo_tipos_causales",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_tipo_causal"]+">"+registros[i]["tipo_causal"]+"</option>";
					
				};
				
				$("#tipocausal_seguimientos1 select").html(html);
		}

	});
}


function llenarcombo_causalesSG(valor,valor2){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/llenarcombo_causales",
		type:"post",
		data:{id_tipo_causal:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if (registros[i]["id_causal"]==valor2) {

						html +="<option value="+registros[i]["id_causal"]+" selected>"+registros[i]["causal"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["id_causal"]+">"+registros[i]["causal"]+"</option>";
					}
					
				};
				
				$("#causales_seguimientos1 select").html(html);
		}

	});
}


function mostrarseguimientos(valor,pagina,cantidad,id_persona){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/mostrarseguimientos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.seguimientos.length > 0) {

					for (var i = 0; i < registros.seguimientos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.seguimientos[i].id_seguimiento+"</td><td style='display:none'>"+registros.seguimientos[i].id_curso+"</td><td>"+registros.seguimientos[i].nombre_grado+" "+registros.seguimientos[i].nombre_grupo+" "+registros.seguimientos[i].jornada+"</td><td style='display:none'>"+registros.seguimientos[i].id_asignatura+"</td><td style='display:none'>"+registros.seguimientos[i].nombre_asignatura+"</td><td style='display:none'>"+registros.seguimientos[i].id_estudiante+"</td><td>"+registros.seguimientos[i].nombres+" "+registros.seguimientos[i].apellido1+" "+registros.seguimientos[i].apellido2+"</td><td style='display:none'>"+registros.seguimientos[i].id_tipo_causal+"</td><td>"+registros.seguimientos[i].tipo_causal+"</td><td style='display:none'>"+registros.seguimientos[i].id_causal+"</td><td style='display:none'>"+registros.seguimientos[i].causal+"</td><td style='display:none'>"+registros.seguimientos[i].descripcion_situacion+"</td><td>"+registros.seguimientos[i].fecha_causal+"</td><td style='display:none'>"+registros.seguimientos[i].id_accion_pedagogica+"</td><td style='display:none'>"+registros.seguimientos[i].descripcion_accion_pedagogica+"</td><td style='display:none'>"+registros.seguimientos[i].compromiso_estudiante+"</td><td style='display:none'>"+registros.seguimientos[i].observaciones+"</td><td>"+registros.seguimientos[i].estado_seguimiento+"</td><td><a class='btn btn-success' href="+registros.seguimientos[i].id_seguimiento+"><i class='fa fa-edit'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.seguimientos[i].id_seguimiento+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_seguimientos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Seguimientos Registrados..</p></td></tr>";
					$("#lista_seguimientos tbody").html(html);
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
				$(".paginacion_seguimiento").html(paginador);

			}

	});

}


function actualizar_seguimiento_disciplinario(){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/modificar",
		type:"post",
        data:$("#form_seguimientos_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_seguimiento").modal('hide');
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Seguimiento Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Seguimiento No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="seguimientoyacerrado"){
					
					toastr.warning('No Se Puede Actualizar Este Seguimiento, Actualmente Se Encuentra Cerrado.', 'Success Alert', {timeOut: 3000});
					
				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_seguimientos_actualizar")[0].reset();

				mostrarseguimientos("",1,5,id_persona);

		}


	});

}


function llenarcombo_acciones_pedagogicasSG(){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/llenarcombo_acciones_pedagogicas",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_accion_pedagogica"]+">"+registros[i]["accion_pedagogica"]+"</option>";
					
				};
				
				$("#accionespedagogicas_seguimientos1 select").html(html);
		}

	});
}


function cerrar_seguimiento_disciplinario(id_seguimiento){

	$.ajax({
		url:base_url+"seguimientos_disciplinarios_controller/cerrar_seguimiento_disciplinario",
		type:"post",
        data:{id_seguimiento:id_seguimiento},
		success:function(respuesta) {
				
				$("#modal_actualizar_seguimiento").modal('hide');
				
				if (respuesta==="seguimientocerrado") {
					
					toastr.success('Seguimiento Disciplinario Cerrado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="seguimientonocerrado"){
					
					toastr.error('Seguimiento Disciplinario No Cerrado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="seguimientoyacerrado"){
					
					toastr.warning('Ya Se Encuentra Cerrado Este Seguimiento Disciplinario.', 'Success Alert', {timeOut: 3000});
					
				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				mostrarseguimientos("",1,5,id_persona);

		}


	});

}


