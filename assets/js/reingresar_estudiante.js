$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarreingresos("",1,5);


	$("#btn_registrar_reingreso").click(function(event){

    	if($("#form_reingresos").valid()==true){

			if(confirm("Esta Seguro De Reingresar Al Estudiante.?")){

	       		registrar_reingreso();
	       	}
	       		
      	}
       	else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
    });


	$("#btn_agregar_reingreso").click(function(){

		$("#modal_agregar_reingreso").modal();
       
    });


    $("#btn_buscar_reingreso").click(function(event){
		
       mostrarreingresos("",1,5);
    });

    $("#buscar_reingreso").keyup(function(event){

    	buscar = $("#buscar_reingreso").val();
		valorcantidad = $("#cantidad_reingreso").val();
		mostrarreingresos(buscar,1,valorcantidad);
		
    });

    $("#cantidad_reingreso").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_reingreso").val();
    	mostrarreingresos(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_reingreso li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_reingreso").val();
    	valorcantidad = $("#cantidad_reingreso").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarreingresos(buscar,numero_pagina,valorcantidad);
		}


    });


    $("body").on("click","#lista_reingresos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_reingreso").modal();
		id_reingresosele = $(this).attr("href");
		cursosele = $(this).parent().parent().children("td:eq(3)").text();
		estudiantesele = $(this).parent().parent().children("td:eq(5)").text();
		observacionessele = $(this).parent().parent().children("td:eq(6)").text();
		fecha_reingresosele = $(this).parent().parent().children("td:eq(7)").text();
		jornadasele = $(this).parent().parent().children("td:eq(8)").text();

		$("#id_reingresosele").val(id_reingresosele);
        $("#cursoseleRI").val(cursosele);
        $("#estudianteseleRI").val(estudiantesele);
        $("#observacionesseleRI").val(observacionessele);
        $("#fecha_reingresoseleRI").val(fecha_reingresosele);
        $("#jornadaseleRI").val(jornadasele);

	});


	$("#btn_buscar_estudianteRI").click(function(event){
    	
    	if($("#identificacionRI").val()==""){

    		toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});
       	}
       	else{

       		id = $("#identificacionRI").val();
       		buscar_estudianteRI(id);
		}
		
       
    });


    $("#identificacionRI").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacionRI").val()==""){

	        	toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{

	       		id = $("#identificacionRI").val();
       			buscar_estudianteRI(id);
	       	}
    	}
		
    });


    $("#jornadaRI").change(function(){
    	jornada = $(this).val();
    	llenarcombo_cursosRI(jornada);
    });


    $("#modal_agregar_reingreso").on('hidden.bs.modal', function () {
        $("#form_reingresos")[0].reset();
        limpiar_camposRI();
        bloquear_cajas_textoRI();
        $("#identificacionRI").val("");
        var validator = $("#form_reingresos").validate();
        validator.resetForm();
    });


    $("#form_reingresos").validate({

    	rules:{

    		id_estudiante:{
				required: true,
				digits: true

				
			},

			jornada:{
				required: true,
				maxlength: 30
					

			},

			id_curso:{
				required: true,
				digits: true

				
			},

			id_acudiente:{
				required: true,
				digits: true	


			},

			parentesco:{
				required: true,
				maxlength: 30
					

			},

			observaciones:{
				required: true,
				maxlength: 500

			}

		}


	});


	//2) ============== Reingresar Estudiantes Retirados En El Año Actual ================


	$("#btn_registrar_reingreso2").click(function(event){

    	if($("#form_reingresos2").valid()==true){

			if(confirm("Esta Seguro De Reingresar Al Estudiante.?")){

	       		registrar_reingreso2();
	       	}
	       		
      	}
       	else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
    });


    $("#btn_agregar_reingreso2").click(function(){

		$("#modal_agregar_reingreso2").modal();
       
    });


    $("#btn_buscar_estudianteRI2").click(function(event){
    	
    	if($("#identificacionRI2").val()==""){

    		toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});
       	}
       	else{

       		id = $("#identificacionRI2").val();
       		buscar_estudianteRI2(id);
		}
		
       
    });


    $("#identificacionRI2").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacionRI2").val()==""){

	        	toastr.warning('Favor Digite Un Número De Identificación.', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{

	       		id = $("#identificacionRI2").val();
       			buscar_estudianteRI2(id);
	       	}
    	}
		
    });


    $("#modal_agregar_reingreso2").on('hidden.bs.modal', function () {
        $("#form_reingresos2")[0].reset();
        limpiar_camposRI2();
        bloquear_cajas_textoRI2();
        $("#identificacionRI2").val("");
        var validator = $("#form_reingresos2").validate();
        validator.resetForm();
    });


    $("#form_reingresos2").validate({

    	rules:{

    		id_estudiante:{
				required: true,
				digits: true

				
			},

			jornada:{
				required: true,
				maxlength: 30
					

			},

			nombre_jornada:{
				required: true,
				maxlength: 30
					

			},

			id_curso:{
				required: true,
				digits: true

				
			},

			nombre_curso:{
				required: true

				
			},

			id_acudiente:{
				required: true,
				digits: true	


			},

			parentesco:{
				required: true,
				maxlength: 30
					

			},

			observaciones:{
				required: true,
				maxlength: 500

			}

		}


	});



}


function mostrarreingresos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"matriculas_controller/mostrarreingresos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.reingresos.length > 0) {

					for (var i = 0; i < registros.reingresos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.reingresos[i].id_reingreso+"</td><td style='display:none'>"+registros.reingresos[i].id_curso+"</td><td>"+registros.reingresos[i].nombre_grado+" "+registros.reingresos[i].nombre_grupo+" "+registros.reingresos[i].jornada+"</td><td style='display:none'>"+registros.reingresos[i].id_estudiante+"</td><td>"+registros.reingresos[i].nombresest+" "+registros.reingresos[i].apellido1est+" "+registros.reingresos[i].apellido2est+"</td><td style='display:none'>"+registros.reingresos[i].observaciones+"</td><td>"+registros.reingresos[i].fecha_reingreso+"</td><td style='display:none'>"+registros.reingresos[i].jornada+"</td><td style='display:none'>"+registros.reingresos[i].ano_lectivo+"</td><td>"+registros.reingresos[i].nombre_ano_lectivo+"</td><td><a class='btn btn-success' href="+registros.reingresos[i].id_reingreso+" title='Ver Reingreso'><i class='fa fa-eye'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.reingresos[i].id_reingreso+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_reingresos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Estudiantes Reingresados..</p></td></tr>";
					$("#lista_reingresos tbody").html(html);
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
				$(".paginacion_reingreso").html(paginador);

			}

	});

}


function buscar_estudianteRI(identificacion){

	$.ajax({
		url:base_url+"matriculas_controller/buscar_estudianteRI",
		type:"post",
		data:{identificacion:identificacion},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				
				if(respuesta==="estudiantenoexiste"){

					toastr.warning('Estudiante No Registrado.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos")[0].reset();
					limpiar_camposRI();
					bloquear_cajas_textoRI();
				}
				else if(respuesta==="estudiantenoretirado"){

					toastr.warning('El N° De Identificación Corresponde A Un Estudiante No Retirado.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos")[0].reset();
					limpiar_camposRI();
					bloquear_cajas_textoRI();
				}
				else if(respuesta==="matriculaexiste"){

					toastr.info('El Estudiante Tiene Una Matricula Registrada En El Año Lectivo Actual.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos")[0].reset();
					limpiar_camposRI();
					bloquear_cajas_textoRI();
				}
				else if(respuesta==="anionoexiste"){
						
					toastr.info('No Se Encontró Un Año Lectivo Activo.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos")[0].reset();
					limpiar_camposRI();
					bloquear_cajas_textoRI();		
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						id_estudiante = registros[i]["id_persona"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];

						$("#id_estudianteRI").val(id_estudiante);
	        			$("#nombresRI").val(nombres);
	        			$("#apellido1RI").val(apellido1);
	        			$("#apellido2RI").val(apellido2);

	        			desbloquear_cajas_textoRI();
	        			llenarcombo_cursosRI($("#jornadaRI").val());
						llenarcombo_acudientesRI("");
						
					};
				}	
				
		
		}

	});
}


function llenarcombo_cursosRI(jornada){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#curso_reingreso1 select").html(html);
		}

	});

}


function llenarcombo_acudientesRI(){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_acudientes",
		type:"post",
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_persona"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					
				};
				
				$("#acudiente_reingreso1 select").html(html);
		}

	});

}


function registrar_reingreso(){

	$.ajax({

		url:$("#form_reingresos").attr("action"),
		type:$("#form_reingresos").attr("method"),
		data:$("#form_reingresos").serialize(),
		success:function(respuesta) {

			//alert(""+respuesta);
			if (respuesta==="registroguardado") {
				
				toastr.success('Estudiante Reingresado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
				$("#form_reingresos")[0].reset();
				$("#identificacionRI").val("");
				limpiar_camposRI();
				bloquear_cajas_textoRI();

			}
			else if(respuesta==="registronoguardado"){
				
				toastr.error('Estudiante No Reingresado.', 'Success Alert', {timeOut: 3000});
				

			}
			else if(respuesta==="pensumnoexiste"){
				
				toastr.info('Estudiante No Matriculado; No Se Encontro Un Pensum Para El Grado Al Que Aspira.', 'Success Alert', {timeOut: 3000});
					

			}
			else{

				toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				
			}
			mostrarreingresos("",1,5);

				
				
		}

	});

}


function validaRI(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


function bloquear_cajas_textoRI(){

	$("#id_cursoRI").attr("disabled", "disabled");
	$("#id_acudienteRI").attr("disabled", "disabled");
	$("#parentescoRI").attr("disabled", "disabled");
    $("#jornadaRI").attr("disabled", "disabled");
    $("#observacionesRI").attr("disabled", "disabled");
    $("#btn_registrar_reingreso").attr("disabled", "disabled");
}


function desbloquear_cajas_textoRI(){

	$("#id_cursoRI").removeAttr("disabled");
	$("#id_acudienteRI").removeAttr("disabled");
	$("#parentescoRI").removeAttr("disabled");
    $("#jornadaRI").removeAttr("disabled");
    $("#observacionesRI").removeAttr("disabled");
    $("#btn_registrar_reingreso").removeAttr("disabled");

}


function limpiar_camposRI(){

	$("#id_estudianteRI").val("");
	$("#curso_reingreso1 select").html("");
	$("#acudiente_reingreso1 select").html("");
}



//2) ============== Reingresar Estudiantes Retirados En El Año Actual ================


function buscar_estudianteRI2(identificacion){

	$.ajax({
		url:base_url+"matriculas_controller/buscar_estudianteRI2",
		type:"post",
		data:{identificacion:identificacion},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				
				if(respuesta==="estudiantenoexiste"){

					toastr.warning('Estudiante No Registrado.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos2")[0].reset();
					limpiar_camposRI2();
					bloquear_cajas_textoRI2();
				}
				else if(respuesta==="estudiantenoretirado"){

					toastr.warning('El N° De Identificación Corresponde A Un Estudiante No Retirado.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos2")[0].reset();
					limpiar_camposRI2();
					bloquear_cajas_textoRI2();
				}
				else if(respuesta==="matriculanoexiste"){

					toastr.info('El Estudiante No Tiene Una Matricula Registrada En El Año Lectivo Actual.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos2")[0].reset();
					limpiar_camposRI2();
					bloquear_cajas_textoRI2();
				}
				else if(respuesta==="anionoexiste"){
						
					toastr.info('No Se Encontró Un Año Lectivo Activo.', 'Success Alert', {timeOut: 3000});
					$("#form_reingresos2")[0].reset();
					limpiar_camposRI2();
					bloquear_cajas_textoRI2();		
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						id_estudiante = registros[i]["id_persona"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];
						id_matricula = registros[i]["id_matricula"];
						jornada = registros[i]["jornada"];
						id_curso = registros[i]["id_curso"];
						nombre_curso = registros[i]["nombre_grado"]+[" "]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"];
						id_acudiente = registros[i]["id_acudiente"];
						parentesco = registros[i]["parentesco"];

						$("#id_estudianteRI2").val(id_estudiante);
	        			$("#nombresRI2").val(nombres);
	        			$("#apellido1RI2").val(apellido1);
	        			$("#apellido2RI2").val(apellido2);
	        			$("#id_matriculaRI2").val(id_matricula);
	        			$("#jornadaRI2").val(jornada);
	        			$("#nombre_jornadaRI2").val(jornada);
	        			$("#id_cursoRI2").val(id_curso);
	        			$("#nombre_cursoRI2").val(nombre_curso);
	        			$("#id_acudienteRI2").val(id_acudiente);
	        			$("#parentescoRI2").val(parentesco);

	        			desbloquear_cajas_textoRI2();
						llenarcombo_acudientesRI2(id_acudiente);
						
					};
				}	
				
		
		}

	});
}


function llenarcombo_acudientesRI2(id_acudiente){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_acudientes",
		type:"post",
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if(registros[i]["id_persona"] == id_acudiente){
					
						html +="<option value="+registros[i]["id_persona"]+" selected>"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					}
					else{

						html +="<option value="+registros[i]["id_persona"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					}	
					
				};
				
				$("#acudiente_reingreso2 select").html(html);
		}

	});

}


function registrar_reingreso2(){

	$.ajax({

		url:$("#form_reingresos2").attr("action"),
		type:$("#form_reingresos2").attr("method"),
		data:$("#form_reingresos2").serialize(),
		success:function(respuesta) {

			//alert(""+respuesta);
			if (respuesta==="registroguardado") {
				
				toastr.success('Estudiante Reingresado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
				$("#form_reingresos2")[0].reset();
				$("#identificacionRI2").val("");
				limpiar_camposRI2();
				bloquear_cajas_textoRI2();

			}
			else if(respuesta==="registronoguardado"){
				
				toastr.error('Estudiante No Reingresado.', 'Success Alert', {timeOut: 3000});
				

			}
			else{

				toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				
			}
			mostrarreingresos("",1,5);

				
				
		}

	});

}


function bloquear_cajas_textoRI2(){

	$("#id_acudienteRI2").attr("disabled", "disabled");
	$("#parentescoRI2").attr("disabled", "disabled");
    $("#observacionesRI2").attr("disabled", "disabled");
    $("#btn_registrar_reingreso2").attr("disabled", "disabled");
}


function desbloquear_cajas_textoRI2(){

	$("#id_acudienteRI2").removeAttr("disabled");
	$("#parentescoRI2").removeAttr("disabled");
    $("#observacionesRI2").removeAttr("disabled");
    $("#btn_registrar_reingreso2").removeAttr("disabled");
}


function limpiar_camposRI2(){

	$("#id_matriculaRI2").val("");
	$("#id_estudianteRI2").val("");
	$("#jornadaRI2").val("");
	$("#id_cursoRI2").val("");
	$("#acudiente_reingreso2 select").html("");
}