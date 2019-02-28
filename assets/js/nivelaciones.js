$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarnivelaciones("",1,5);
	llenarcombo_cursosNV();


	$("#btn_registrar_nivelacion").click(function(event){

    	if($("#form_nivelaciones").valid()==true){
    		if(validarCampoNivelacionNV()==true){
    			if(confirm("Esta Seguro De Registrar Esta Nivelación.? Este Procedimiento Reemplazara La Nota Del Período.")){
		       		registrar_nivelacion();
		       	}	
	       	}
	       	else{
	       		toastr.warning('Debe Ingresar Una Nivelación.', 'Success Alert', {timeOut: 3000});
	       	}	
      	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
    });


	$("#btn_agregar_nivelacion").click(function(){

		$("#modal_agregar_nivelacion").modal();
       
    });

    $("#btn_buscar_nivelacion").click(function(event){
		
       mostrarnivelaciones("",1,5);
    });

    $("#buscar_nivelacion").keyup(function(event){

    	buscar = $("#buscar_nivelacion").val();
		valorcantidad = $("#cantidad_nivelacion").val();
		mostrarnivelaciones(buscar,1,valorcantidad);
		
    });

    $("#cantidad_nivelacion").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_nivelacion").val();
    	mostrarnivelaciones(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_nivelacion li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_nivelacion").val();
    	valorcantidad = $("#cantidad_nivelacion").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarnivelaciones(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_nivelaciones a",function(event){
		event.preventDefault();
		$("#modal_actualizar_nivelacion").modal();
		id_nivelacionsele = $(this).attr("href");
		cursosele = $(this).parent().parent().children("td:eq(3)").text();
		estudiantesele = $(this).parent().parent().children("td:eq(5)").text();
		periodosele = $(this).parent().parent().children("td:eq(6)").text();
		asignaturasele = $(this).parent().parent().children("td:eq(8)").text();
		profesorsele = $(this).parent().parent().children("td:eq(10)").text();
		calificacionsele = $(this).parent().parent().children("td:eq(11)").text();
		nivelacionsele = $(this).parent().parent().children("td:eq(12)").text();
		observacionessele = $(this).parent().parent().children("td:eq(13)").text();
		fecha_nivelacionsele = $(this).parent().parent().children("td:eq(14)").text();

		$("#id_nivelacionsele").val(id_nivelacionsele);
        $("#cursoseleNV").val(cursosele);
        $("#asignaturaseleNV").val(asignaturasele);
        $("#profesorseleNV").val(profesorsele);
        $("#periodoseleNV").val(periodosele);
        $("#estudianteseleNV").val(estudiantesele);
        $("#calificacionseleNV").val(calificacionsele);
        $("#nivelacionseleNV").val(nivelacionsele);
        $("#observacionesseleNV").val(observacionessele);
        $("#fecha_nivelacionseleNV").val(fecha_nivelacionsele);

	});


    $("#id_cursoNV").change(function(){
    	id_curso = $(this).val();
    	$("#periodoNV").val("");
    	$("#profesor_nivelacion1 select").html("");
    	$("#estudiante_nivelacion1 select").html("");
    	$("#calificacionNV").val("");
    	$("#periodoNV").attr("disabled", "disabled");
    	llenarcombo_asignaturasNV(id_curso);
    });


    $("#id_asignaturaNV").change(function(){
    	$("#periodoNV").val("");
    	$("#estudiante_nivelacion1 select").html("");
    	$("#calificacionNV").val("");

    	id_asignatura = $(this).val();
    	id_curso = $("#id_cursoNV").val();
    	llenarcombo_profesoresNV(id_curso,id_asignatura);

    	if (id_asignatura =="") {
    		$("#periodoNV").attr("disabled", "disabled");
    	}
    	else{
    		$("#periodoNV").removeAttr("disabled");
    	}
    });


    $("#periodoNV").change(function(){
    	$("#estudiante_nivelacion1 select").html("");
    	$("#calificacionNV").val("");

    	periodo = $(this).val();
    	id_curso = $("#id_cursoNV").val();
    	id_asignatura = $("#id_asignaturaNV").val();
    	
    	if (periodo != "" && id_asignatura != "") {
    		llenarcombo_estudiantesNV(id_curso,id_asignatura,periodo);
    	}
    	
    });


    $("#id_estudianteNV").change(function(){
    	id_estudiante = $(this).val();
    	periodo = $("#periodoNV").val();
    	id_curso = $("#id_cursoNV").val();
    	id_asignatura = $("#id_asignaturaNV").val();
    	buscar_notas_estudianteNV(id_estudiante,periodo,id_curso,id_asignatura);
    });


    $("#modal_agregar_nivelacion").on('hidden.bs.modal', function () {
        limpiar_camposNV();
        var validator = $("#form_nivelaciones").validate();
        validator.resetForm();
    });


    $("#form_nivelaciones").validate({

    	rules:{

			id_curso:{
				required: true,
				digits: true
				
			},

			id_asignatura:{
				required: true,
				digits: true
				
			},

			id_profesor:{
				required: true,
				digits: true
				
			},

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			},

			id_estudiante:{
				required: true,
				digits: true	

			},

			calificacion:{
				required: true,
				number: true	

			},

			nivelacion:{
				required: true,
				number: true

			},

			fecha_nivelacion:{
				required: true,
				date: true	

			},

			observaciones:{
				required: true,
				maxlength: 500

			}
		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");



}


function llenarcombo_cursosNV(){

	$.ajax({
		url:base_url+"nivelaciones_controller/llenarcombo_cursos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
				};
				
				$("#curso_nivelacion1 select").html(html);
		}

	});
}


function llenarcombo_asignaturasNV(id_curso){

	$.ajax({
		url:base_url+"nivelaciones_controller/llenarcombo_asignaturas",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {
				//alert(""+respuesta);
				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
				};
				
				$("#asignatura_nivelacion1 select").html(html);
		}

	});
}


function llenarcombo_profesoresNV(id_curso,id_asignatura){

	$.ajax({
		url:base_url+"nivelaciones_controller/llenarcombo_profesores",
		type:"post",
		data:{id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_persona"]+" selected>"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
				};
				
				$("#profesor_nivelacion1 select").html(html);
		}

	});
}


function llenarcombo_estudiantesNV(id_curso,id_asignatura,periodo){

	$.ajax({
		url:base_url+"nivelaciones_controller/llenarcombo_estudiantes",
		type:"post",
		data:{id_curso:id_curso,id_asignatura:id_asignatura,periodo:periodo},
		success:function(respuesta) {
				
				var registros = eval(respuesta);

				html = "<option value=''></option>";

				if (registros.length > 0) {

					for (var i = 0; i < registros.length; i++) {
						
						html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					};
					
					$("#estudiante_nivelacion1 select").html(html);
				}
				else{
					$("#estudiante_nivelacion1 select").html(html);
					toastr.warning('No hay Estudiantes Pendientes Por Nivelación, Para Este Período Y Asignatura.', 'Success Alert', {timeOut: 3000});
				}
		}

	});
}


//Esta funcion me permite por cada estudiante obtener la calificacion de una asignatura en un determinado periodo
function buscar_notas_estudianteNV(id_estudiante,periodo,id_curso,id_asignatura){

	p = periodo;
	$.ajax({
		url:base_url+"nivelaciones_controller/buscar_notas_estudiante",
		type:"post",
		data:{id_estudiante:id_estudiante,periodo:periodo,id_curso:id_curso,id_asignatura:id_asignatura},
		success:function(respuesta) {
				

				if(respuesta==="no"){

					limpiarcampo_calificacion();
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						if(p=="Primero"){
							calificacion = registros[i]["p1"];
							$("#calificacionNV").val(calificacion);
						}
						if(p=="Segundo"){
							calificacion = registros[i]["p2"];
							$("#calificacionNV").val(calificacion);
						}
						if(p=="Tercero"){
							calificacion = registros[i]["p3"];
							$("#calificacionNV").val(calificacion);
						}
						if(p=="Cuarto"){
							calificacion = registros[i]["p4"];
							$("#calificacionNV").val(calificacion);
						}

					};
				}	
				
		
		}

	});
}


function registrar_nivelacion(){

	$("#id_profesorNV").removeAttr("disabled");

	$.ajax({

		url:$("#form_nivelaciones").attr("action"),
		type:$("#form_nivelaciones").attr("method"),
		data:$("#form_nivelaciones").serialize(),   //captura la info de la cajas de texto
		success:function(respuesta) {

			
			if (respuesta==="registroguardado") {
				
				toastr.success('Nivelación Registrada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
				//$("#form_nivelaciones")[0].reset();
				limpiar_camposNV();

			}
			else if(respuesta==="registronoguardado"){
				
				toastr.error('Nivelación No Registrada.', 'Success Alert', {timeOut: 3000});
				

			}
			else if(respuesta==="nivelacionyaexiste"){
				
				toastr.warning('Nivelación Ya Registrada.', 'Success Alert', {timeOut: 3000});
					

			}
			else if(respuesta==="nivelacionincorrecta"){
				
				toastr.warning('La Nivelación Ingresada Es Incorrecta.', 'Success Alert', {timeOut: 3000});
					

			}
			else if(respuesta==="situaciondefinida"){
				
				toastr.info('Nivelación No Registrada; El Estudiante Se Encuentra Con Situación Académica Definida.', 'Success Alert', {timeOut: 3000});
					

			}
			else{

				toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				
			}

			mostrarnivelaciones("",1,5);
			
				
				
		}

	});

}


function mostrarnivelaciones(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"nivelaciones_controller/mostrarnivelaciones",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.nivelaciones.length > 0) {

					for (var i = 0; i < registros.nivelaciones.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.nivelaciones[i].id_nivelacion+"</td><td style='display:none'>"+registros.nivelaciones[i].id_curso+"</td><td>"+registros.nivelaciones[i].nombre_grado+" "+registros.nivelaciones[i].nombre_grupo+" "+registros.nivelaciones[i].jornada+"</td><td style='display:none'>"+registros.nivelaciones[i].id_estudiante+"</td><td>"+registros.nivelaciones[i].nombresest+" "+registros.nivelaciones[i].apellido1est+" "+registros.nivelaciones[i].apellido2est+"</td><td>"+registros.nivelaciones[i].periodo+"</td><td style='display:none'>"+registros.nivelaciones[i].id_asignatura+"</td><td>"+registros.nivelaciones[i].nombre_asignatura+"</td><td style='display:none'>"+registros.nivelaciones[i].id_profesor+"</td><td style='display:none'>"+registros.nivelaciones[i].nombrespf+" "+registros.nivelaciones[i].apellido1pf+" "+registros.nivelaciones[i].apellido2pf+"</td><td style='display:none'>"+registros.nivelaciones[i].nota+"</td><td style='display:none'>"+registros.nivelaciones[i].nivelacion+"</td><td style='display:none'>"+registros.nivelaciones[i].observaciones+"</td><td>"+registros.nivelaciones[i].fecha_nivelacion+"</td><td style='display:none'>"+registros.nivelaciones[i].ano_lectivo+"</td><td>"+registros.nivelaciones[i].nombre_ano_lectivo+"</td><td><a class='btn btn-success' href="+registros.nivelaciones[i].id_nivelacion+"><i class='fa fa-eye'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.nivelaciones[i].id_nivelacion+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_nivelaciones tbody").html(html);
				}
				else{
					html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Nivelaciones Registradas..</p></td></tr>";
					$("#lista_nivelaciones tbody").html(html);
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
				$(".paginacion_nivelacion").html(paginador);

			}

	});

}


function limpiarcampo_calificacion(){

	$("#calificacionNV").val("");

}


function valida_nivelacionNV(e){
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


function validarCampoNivelacionNV(){

	var resn=[];
    var resy=[];
    var vacio = "";

    var notas = document.getElementsByName("nivelacion");
    
	if(notas[0].value != vacio){

		resy.push("si")
	}
	else{
		resn.push("no");
	}

   	if(resy.length > 0){

		//alert("ok");
		return true;
	}
	else{
		//alert("no");
		return false;
	}

}


function limpiar_camposNV(){

	$("#id_cursoNV").val("");
	$("#asignatura_nivelacion1 select").html("");
	$("#profesor_nivelacion1 select").html("");
	$("#periodoNV").val("");
	$("#estudiante_nivelacion1 select").html("");
	$("#calificacionNV").val("");
	$("#nivelacionNV").val("");
	$("#fecha_nivelacionNV").val("");
	$("#observacionesNV").val("");

	$("#id_profesorNV").attr("disabled", "disabled");
	$("#periodoNV").attr("disabled", "disabled");

}