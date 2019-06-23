$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostraradministradores("",1,5);


	$("#form_administradores").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_administradores").valid()==true){

			$.ajax({

				url:$("#form_administradores").attr("action"),
				type:$("#form_administradores").attr("method"),
				data:$("#form_administradores").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Administrador Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_administradores")[0].reset();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Administrador No Registrado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="administradoryaexiste"){
						
						toastr.warning('El N° De Identificación Corresponde A Un Administrador Ya Registrado.', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="estudianteactivo"){
						
						toastr.warning('Administrador No Registrado, El N° De Identificación Corresponde A Un Estudiante Activo.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					
					buscar = $("#buscar_administrador").val();
					valorcantidad = $("#cantidad_administrador").val();
					mostraradministradores(buscar,1,valorcantidad);

						
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 2000});
			
		}

	});


	$("#btn_agregar_administrador").click(function(){

		$("#modal_agregar_administrador").modal();
       
    });

	$("#btn_buscar_administrador").click(function(event){
		
    	mostraradministradores("",1,5);
    });

    $("#buscar_administrador").keyup(function(event){

    	buscar = $("#buscar_administrador").val();
		valorcantidad = $("#cantidad_administrador").val();
		mostraradministradores(buscar,1,valorcantidad);
		
    });

    $("#cantidad_administrador").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_administrador").val();
    	mostraradministradores(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_administrador li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_administrador").val();
    	valorcantidad = $("#cantidad_administrador").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostraradministradores(buscar,numero_pagina,valorcantidad);
		}

    });

    $("body").on("click","#lista_administradores button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Este Administrador.?")){
			eliminar_administrador(idsele);

		}

	});

    $("body").on("click","#lista_administradores a",function(event){
		event.preventDefault();
		$("#modal_actualizar_administrador").modal();
		id_personasele = $(this).attr("href");
		identificacionsele = $(this).parent().parent().children("td:eq(2)").text();
		tipo_idsele = $(this).parent().parent().children("td:eq(3)").text();
		nombressele = $(this).parent().parent().children("td:eq(4)").text();
		apellido1sele = $(this).parent().parent().children("td:eq(5)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		apellido2sele = $(this).parent().parent().children("td:eq(6)").text();
		telefonosele = $(this).parent().parent().children("td:eq(7)").text();
		correosele = $(this).parent().parent().children("td:eq(8)").text();
		direccionsele = $(this).parent().parent().children("td:eq(9)").text();
		barriosele = $(this).parent().parent().children("td:eq(10)").text();
		
		$("#id_personasele_ad").val(id_personasele);
		$("#identificacionsele_ad").val(identificacionsele);
		$("#tipo_idsele_ad").val(tipo_idsele);
        $("#nombressele_ad").val(nombressele);
        $("#apellido1sele_ad").val(apellido1sele);
        $("#apellido2sele_ad").val(apellido2sele);
        $("#telefonosele_ad").val(telefonosele);
        $("#correosele_ad").val(correosele);
        $("#direccionsele_ad").val(direccionsele);
        $("#barriosele_ad").val(barriosele);

	});


	$("#btn_actualizar_administrador").click(function(event){

    	if($("#form_administradores_actualizar").valid()==true){
       		actualizar_administrador();

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 2000});
		}
		
       
    });


    $("#modal_agregar_administrador").on('hidden.bs.modal', function () {
        $("#form_administradores")[0].reset();
        bloquear_cajas_texto_ad();
        desbloquear_boton_registrar_ad();
        var validator = $("#form_administradores").validate();
        validator.resetForm();
    });


    $("#modal_actualizar_administrador").on('hidden.bs.modal', function () {
        $("#form_administradores_actualizar")[0].reset();
        var validator = $("#form_administradores_actualizar").validate();
        validator.resetForm();
    });


    $("#identificacion_ad").blur(function(){

    	if($("#identificacion_ad").val()==""){
			
		}
		else{

			validar_identificacion_personaAD($(this).val());
		}
       
    });


    $("#form_administradores").validate({

    	rules:{

			identificacion:{
				required: true,
				maxlength: 11,
				digits: true

			},

			tipo_id:{
				required: true,
				maxlength: 2
				
			},

			nombres:{
				required: true,
				maxlength: 40,
				lettersonly: true	

			},

			apellido1:{
				required: true,
				maxlength: 15,
				lettersonly: true	

			},

			apellido2:{
				required: true,
				maxlength: 15,
				lettersonly: true	

			},

			telefono:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			correo:{
				required: true,
				email: true,
				maxlength: 45	

			},

			direccion:{
				required: true,
				maxlength: 45	

			},

			barrio:{
				required: true,
				maxlength: 45	

			}

		}


	});


    $("#form_administradores_actualizar").validate({

    	rules:{

			identificacion:{
				required: true,
				maxlength: 11,
				digits: true

			},

			tipo_id:{
				required: true,
				maxlength: 2
				
			},

			nombres:{
				required: true,
				maxlength: 40,
				lettersonly: true	

			},

			apellido1:{
				required: true,
				maxlength: 15,
				lettersonly: true	

			},

			apellido2:{
				required: true,
				maxlength: 15,
				lettersonly: true	

			},

			telefono:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			correo:{
				required: true,
				email: true,
				maxlength: 45	

			},

			direccion:{
				required: true,
				maxlength: 45	

			},

			barrio:{
				required: true,
				maxlength: 45	

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostraradministradores(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"administradores_controller/mostraradministradores",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.administradores.length > 0) {

					for (var i = 0; i < registros.administradores.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.administradores[i].id_persona+"</td><td>"+registros.administradores[i].identificacion+"</td><td style='display:none'>"+registros.administradores[i].tipo_id+"</td><td>"+registros.administradores[i].nombres+"</td><td>"+registros.administradores[i].apellido1+"</td><td>"+registros.administradores[i].apellido2+"</td><td>"+registros.administradores[i].telefono+"</td><td style='display:none'>"+registros.administradores[i].email+"</td><td style='display:none'>"+registros.administradores[i].direccion+"</td><td style='display:none'>"+registros.administradores[i].barrio+"</td><td><a class='btn btn-success' href="+registros.administradores[i].id_persona+" title='Actualizar Información Del Administrador.'><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.administradores[i].id_persona+" title='Eliminar Administrador.'><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_administradores tbody").html(html);
				}
				else{
					html ="<tr><td colspan='8'><p style='text-align:center'>Resultados No Encontrados..</p></td></tr>";
					$("#lista_administradores tbody").html(html);
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
				$(".paginacion_administrador").html(paginador);

			}

	});

}


function eliminar_administrador(valor){

	$.ajax({
		url:base_url+"administradores_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});

				buscar = $("#buscar_administrador").val();
				valorcantidad = $("#cantidad_administrador").val();
				mostraradministradores(buscar,1,valorcantidad);

		}


	});



}


function actualizar_administrador(){

	$.ajax({
		url:base_url+"administradores_controller/modificar",
		type:"post",
        data:$("#form_administradores_actualizar").serialize(),
		success:function(respuesta) {


				$("#modal_actualizar_administrador").modal('hide');
				if (respuesta==="registroactualizado") {
						
					toastr.success('Información Del Administrador Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Información Del Administrador No Actualizada.', 'Success Alert', {timeOut: 3000});	

				}
				else if(respuesta==="administradoryaexiste"){
					
					toastr.warning('El Administrador Ya Se Encuentra Registrado.', 'Success Alert', {timeOut: 3000});	

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}
				
				$("#form_administradores_actualizar")[0].reset();

				buscar = $("#buscar_administrador").val();
				valorcantidad = $("#cantidad_administrador").val();
				mostraradministradores(buscar,1,valorcantidad);

		}


	});

}


//================= FUNCIONES PARA VALIDAR PERSONA EXISTENTE ====================


function validar_identificacion_personaAD(valor){

	$.ajax({
		url:base_url+"administradores_controller/validar_identificacion",
		type:"post",
		data:{identificacion:valor},
		success:function(respuesta) {
				
				
				if (respuesta==="ok") {
						
					desbloquear_cajas_texto_ad();
					desbloquear_boton_registrar_ad();
					limpiar_cajas_texto_ad();

				}
				else if(respuesta==="administradoryaexiste"){
					bloquear_cajas_texto_ad();
					bloquear_boton_registrar_ad();
					limpiar_cajas_texto_ad();
					toastr.warning('El N° De Identificación Corresponde A Un Administrador Ya Registrado.', 'Success Alert', {timeOut: 3000});
						
				}
				else if(respuesta==="estudianteactivo"){
					bloquear_cajas_texto_ad();
					bloquear_boton_registrar_ad();
					limpiar_cajas_texto_ad();
					toastr.warning('El N° De Identificación Corresponde A Un Estudiante Activo.', 'Success Alert', {timeOut: 3000});
						
				}
				else{
					
					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						tipo_id = registros[i]["tipo_id"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];
						telefono = registros[i]["telefono"];
						correo = registros[i]["email"];
						direccion = registros[i]["direccion"];
						barrio = registros[i]["barrio"];

						$("#tipo_id_ad").val(tipo_id);
	        			$("#nombres_ad").val(nombres);
	        			$("#apellido1_ad").val(apellido1);
	        			$("#apellido2_ad").val(apellido2);
	        			$("#telefono_ad").val(telefono);
	        			$("#correo_ad").val(correo);
	        			$("#direccion_ad").val(direccion);
	        			$("#barrio_ad").val(barrio);
	        			bloquear_cajas_texto_ad();
	        			desbloquear_boton_registrar_ad();
	        			
					};

				}

		
		}

	});
}


//Validar el Ingreso de solo numeros
function validar_solonumerosAD(e){
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


//Cajas De Texto Del Fomulario Registrar Administradores
function bloquear_cajas_texto_ad(){

	$("#tipo_id_ad").attr("readonly", "readonly");
	$("#nombres_ad").attr("readonly", "readonly");
    $("#apellido1_ad").attr("readonly", "readonly");
    $("#apellido2_ad").attr("readonly", "readonly");
    $("#telefono_ad").attr("readonly", "readonly");
    $("#correo_ad").attr("readonly", "readonly");
    $("#direccion_ad").attr("readonly", "readonly");
    $("#barrio_ad").attr("readonly", "readonly");
}


//Cajas De Texto Del Fomulario Registrar Administradores
function desbloquear_cajas_texto_ad(){

	$("#tipo_id_ad").removeAttr("readonly");
	$("#nombres_ad").removeAttr("readonly");
    $("#apellido1_ad").removeAttr("readonly");
    $("#apellido2_ad").removeAttr("readonly");
    $("#telefono_ad").removeAttr("readonly");
    $("#correo_ad").removeAttr("readonly");
    $("#direccion_ad").removeAttr("readonly");
    $("#barrio_ad").removeAttr("readonly");
}


function limpiar_cajas_texto_ad(){

	$("#tipo_id_ad").val("");
	$("#nombres_ad").val("");
    $("#apellido1_ad").val("");
    $("#apellido2_ad").val("");
    $("#telefono_ad").val("");
    $("#correo_ad").val("");
    $("#direccion_ad").val("");
    $("#barrio_ad").val("");
}


function bloquear_boton_registrar_ad(){

	$("#btn_registrar_administrador").attr("disabled", "disabled");

}


function desbloquear_boton_registrar_ad(){

	$("#btn_registrar_administrador").removeAttr("disabled");

}