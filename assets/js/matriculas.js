$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarmatriculas("",1,5);
	llenarcombo_salones_grupo();

	// este metodo permite enviar la inf del formulario
	$("#form_matriculas").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_matriculas").valid()==true){

			$.ajax({

				url:$("#form_matriculas").attr("action"),
				type:$("#form_matriculas").attr("method"),
				data:$("#form_matriculas").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Estudiante Matriculado Satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_matriculas")[0].reset();
						$("#identificacion").val("");
						bloquear_cajas_texto();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="matricula ya existe"){
						
						toastr.success('El Estudiante Ya Se Encuentra Matriculado', 'Success Alert', {timeOut: 5000});
						

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarmatriculas("",1,5);
					llenarcombo_salones_grupo();
						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_matricula").click(function(){

		$("#modal_agregar_matricula").modal();
       
    });

    $("#btn_buscar_matricula").click(function(event){
		
       mostrarmatriculas("",1,5);
    });

    $("#buscar_matricula").keyup(function(event){

    	buscar = $("#buscar_matricula").val();
		valorcantidad = $("#cantidad_matricula").val();
		mostrarmatriculas(buscar,1,valorcantidad);
		
    });

    $("#cantidad_matricula").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_matricula").val();
    	mostrarmatriculas(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_matricula li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_matricula").val();
    	valorcantidad = $("#cantidad_matricula").val();
		mostrarmatriculas(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_matriculas button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_matricula(idsele);

		}

	});

	$("body").on("click","#lista_matriculas a",function(event){
		event.preventDefault();
		$("#modal_actualizar_matricula").modal();
		id_matriculasele = $(this).attr("href");
		fecha_matriculasele = $(this).parent().parent().children("td:eq(2)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		id_personasele = $(this).parent().parent().children("td:eq(5)").text()
		id_salonsele = $(this).parent().parent().children("td:eq(9)").text()
		jornadasele = $(this).parent().parent().children("td:eq(12)").text();
		observacionessele = $(this).parent().parent().children("td:eq(13)").text();
		
		//alert(""+observacionessele+fecha_matriculasele+ano_lectivosele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_matriculasele").val(id_matriculasele);
        $("#fecha_matriculasele").val(fecha_matriculasele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#id_personasele").val(id_personasele);
        $("#id_salonsele").val(id_salonsele);
        $("#jornadasele").val(jornadasele);
        $("#observacionessele").val(observacionessele);
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_matricula").click(function(event){

    	if($("#form_matriculas_actualizar").valid()==true){

    		//desbloqueo los campos deshabilitados antes hacer el llamado ajax
    		$("#fecha_matriculasele").removeAttr("disabled");
    		$("#ano_lectivosele").removeAttr("disabled");
       		actualizar_matricula();
        }
        else{
			alert("formulario incorrecto");
			alert($("#form_matriculas_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


    $("#btn_buscar_estudiante").click(function(event){
    	
    	if($("#identificacion").val()==""){

    		toastr.warning('Favor Digite Un Numero De identificacion', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacion").val();
       		buscar_estudiante(id);
		}
		
       
    });


    $("#identificacion").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacion").val()==""){
	        	toastr.warning('Favor Digite Un Numero De identificacion', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacion").val();
       			buscar_estudiante(id);
	       	}
    	}
		
    });






	$("#form_matriculas").validate({

    	rules:{

			id_salon:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 30,
				//lettersonly: true	

			},

			observaciones:{
				required: true,
				maxlength: 80
					

			}

		}


	});

	$("#form_matriculas_actualizar").validate({

    	rules:{

			id_salon:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 30,
				//lettersonly: true	

			},

			observaciones:{
				required: true,
				maxlength: 80
					

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrarmatriculas(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"matriculas_controller/mostrarmatriculas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.matriculas.length; i++) {
					html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.matriculas[i].id_matricula+"</td><td>"+registros.matriculas[i].fecha_matricula+"</td><td style='display:none'>"+registros.matriculas[i].ano_lectivo+"</td><td>"+registros.matriculas[i].nombre_ano_lectivo+"</td><td style='display:none'>"+registros.matriculas[i].id_estudiante+"</td><td>"+registros.matriculas[i].identificacion+"</td><td>"+registros.matriculas[i].nombres+"</td><td>"+registros.matriculas[i].apellido1+"</td><td style='display:none'>"+registros.matriculas[i].id_salon+"</td><td>"+registros.matriculas[i].nombre_grado+"</td><td>"+registros.matriculas[i].nombre_grupo+"</td><td>"+registros.matriculas[i].jornada+"</td><td style='display:none'>"+registros.matriculas[i].observaciones+"</td><td>"+registros.matriculas[i].estado_matricula+"</td><td><a class='btn btn-success' href="+registros.matriculas[i].id_matricula+">editar</a></td><td><button type='button' class='btn btn-danger' value="+registros.matriculas[i].id_matricula+">eliminar</button></td></tr>";
				};
				
				$("#lista_matriculas tbody").html(html);

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
				$(".paginacion_matricula").html(paginador);

			}

	});

}


function eliminar_matricula(valor){

	$.ajax({
		url:base_url+"matriculas_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarmatriculas("",1,5);
				llenarcombo_salones_grupo();
				
		}


	});



}

function actualizar_matricula(){

	$.ajax({
		url:base_url+"matriculas_controller/modificar",
		type:"post",
        data:$("#form_matriculas_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_matricula").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_matriculas_actualizar")[0].reset();

				$("#fecha_matriculasele").attr("disabled", "disabled");
    			$("#ano_lectivosele").attr("disabled", "disabled");
				mostrarmatriculas("",1,5);
				llenarcombo_salones_grupo();

		}


	});

}

function llenarcombo_salones_grupo(){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_salones_grupo",
		type:"post",
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_salon"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+"</option>";
				};
				
				$("#salones_grupo1 select").html(html);
		}

	});
}

function buscar_estudiante(valor){

	$.ajax({
		url:base_url+"matriculas_controller/buscar_estudiante",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				

				if(respuesta==="estudiantenoexiste"){

					toastr.success('Estudiante No Registrado', 'Success Alert', {timeOut: 5000});
					$("#form_matriculas")[0].reset();
					$("#id_persona").val("");
					bloquear_cajas_texto();
				}
				else if(respuesta==="matricula ya existe"){

					toastr.success('El Estudiante Ya Se Encuentra Matriculado', 'Success Alert', {timeOut: 5000});
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						id_persona = registros[i]["id_persona"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];

						$("#id_persona").val(id_persona);
	        			$("#nombres").val(nombres);
	        			$("#apellido1").val(apellido1);
	        			$("#apellido2").val(apellido2);

	        			desbloquear_cajas_texto();
						
						
					};
				}	
				
		
		}

	});
}

function bloquear_cajas_texto(){

	$("#id_salon").attr("disabled", "disabled");
    $("#jornada").attr("disabled", "disabled");
    $("#observaciones").attr("disabled", "disabled");
    $("#btn_registrar_matricula").attr("disabled", "disabled");
}

function desbloquear_cajas_texto(){

	$("#id_salon").removeAttr("disabled");
    $("#jornada").removeAttr("disabled");
    $("#observaciones").removeAttr("disabled");
    $("#btn_registrar_matricula").removeAttr("disabled");

}

function valida(e){
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

