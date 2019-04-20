$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostraracudientes("",1,5);

	// este metodo permite enviar la inf del formulario
	$("#form_acudientes").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_acudientes").valid()==true){

			$.ajax({

				url:$("#form_acudientes").attr("action"),
				type:$("#form_acudientes").attr("method"),
				data:$("#form_acudientes").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Acudiente Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_acudientes")[0].reset();
						bloquear_cajas_texto_a();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Acudiente No Registrado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="acudienteyaexiste"){
						
						toastr.warning('Información No Registrada, El N° De Identificación Corresponde A Un Acudiente Ya Registrado.', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="estudianteactivo"){
						
						toastr.warning('Información No Registrada, El N° De Identificación Corresponde A Un Estudiante Activo.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
					
					mostraracudientes("",1,5);

						
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 2000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_acudiente").click(function(){

		$("#modal_agregar_acudiente").modal();
       
    });

    $("#btn_buscar_acudiente").click(function(event){
		
       mostraracudientes("",1,5);
    });

    $("#buscar_acudiente").keyup(function(event){

    	buscar = $("#buscar_acudiente").val();
		valorcantidad = $("#cantidad_acudiente").val();
		mostraracudientes(buscar,1,valorcantidad);
		
    });

    $("#cantidad_acudiente").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_acudiente").val();
    	mostraracudientes(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_acudiente li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_acudiente").val();
    	valorcantidad = $("#cantidad_acudiente").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
			mostraracudientes(buscar,numero_pagina,valorcantidad);
		}	


    });

    $("body").on("click","#lista_acudientes button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Este Acudiente.?")){
			eliminar_acudiente(idsele);

		}

	});

	$("body").on("click","#lista_acudientes a",function(event){
		event.preventDefault();
		$("#modal_actualizar_acudiente").modal();
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
		ocupacionsele = $(this).parent().parent().children("td:eq(11)").text();
		telefono_trabajosele = $(this).parent().parent().children("td:eq(12)").text();
		direccion_trabajosele = $(this).parent().parent().children("td:eq(13)").text();
		estado_acudientesele = $(this).parent().parent().children("td:eq(14)").text();
		
		$("#id_personasele").val(id_personasele);
		$("#identificacionsele").val(identificacionsele);
		//$("#identificacionsele2").val(identificacionsele);
		$("#tipo_idsele").val(tipo_idsele);
        $("#nombressele").val(nombressele);
        $("#apellido1sele").val(apellido1sele);
        $("#apellido2sele").val(apellido2sele);
        $("#telefonosele").val(telefonosele);
        $("#correosele").val(correosele);
        $("#direccionsele").val(direccionsele);
        $("#barriosele").val(barriosele);
        $("#ocupacionsele").val(ocupacionsele);
        $("#telefono_trabajosele").val(telefono_trabajosele);
        $("#direccion_trabajosele").val(direccion_trabajosele);
        $("#estado_acudientesele").val(estado_acudientesele);
        //validar_rol(identificacionsele);

	});

    $("#btn_actualizar_acudiente").click(function(event){

    	if($("#form_acudientes_actualizar").valid()==true){
       		actualizar_acudiente();

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 2000});
		}
		
       
    });

    //Resetear Formulario Al Cerrar El Modal
    $("#modal_agregar_acudiente").on('hidden.bs.modal', function () {
        //alert("Esta accion se ejecuta al cerrar el modal")
        $("#form_acudientes")[0].reset();
        bloquear_cajas_texto_a();
        $("#btn_registrar_acudiente").removeAttr("disabled");
        $("#form_acudientes").valid()==true;
    });


    //Resetear Formulario Al Cerrar El Modal
    $("#modal_actualizar_acudiente").on('hidden.bs.modal', function () {
        $("#form_acudientes_actualizar")[0].reset();
        $("#form_acudientes_actualizar").valid()==true;
    });


    $("#identificacion_a").blur(function(){

    	if($("#identificacion_a").val()==""){
			
		}
		else{

			validar_identificacion_persona($(this).val());
		}
       
    });



	$("#form_acudientes").validate({

    	rules:{

			identificacion:{
				required: true,
				maxlength: 10,
				digits: true

			},

			tipo_id:{
				required: true,
				maxlength: 2
				
			},

			nombres:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido1:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido2:{
				required: true,
				maxlength: 50,
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
				maxlength: 50	

			},

			barrio:{
				required: true,
				maxlength: 40	

			},

			ocupacion:{
				required: true,
				maxlength: 50	

			},

			telefono_trabajo:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_trabajo:{
				required: true,
				maxlength: 50	

			}

		}


	});

	$("#form_acudientes_actualizar").validate({

    	rules:{

			identificacion:{
				required: true,
				maxlength: 10,
				digits: true

			},

			tipo_id:{
				required: true,
				maxlength: 2
				
			},

			nombres:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido1:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido2:{
				required: true,
				maxlength: 50,
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
				maxlength: 50	

			},

			barrio:{
				required: true,
				maxlength: 40	

			},

			ocupacion:{
				required: true,
				maxlength: 50	

			},

			telefono_trabajo:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_trabajo:{
				required: true,
				maxlength: 50	

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostraracudientes(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"acudientes_controller/mostraracudientes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.acudientes.length > 0) {
					for (var i = 0; i < registros.acudientes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.acudientes[i].id_persona+"</td><td>"+registros.acudientes[i].identificacion+"</td><td style='display:none'>"+registros.acudientes[i].tipo_id+"</td><td>"+registros.acudientes[i].nombres+"</td><td>"+registros.acudientes[i].apellido1+"</td><td>"+registros.acudientes[i].apellido2+"</td><td>"+registros.acudientes[i].telefono+"</td><td style='display:none'>"+registros.acudientes[i].email+"</td><td style='display:none'>"+registros.acudientes[i].direccion+"</td><td style='display:none'>"+registros.acudientes[i].barrio+"</td><td style='display:none'>"+registros.acudientes[i].ocupacion+"</td><td style='display:none'>"+registros.acudientes[i].telefono_trabajo+"</td><td style='display:none'>"+registros.acudientes[i].direccion_trabajo+"</td><td style='display:none'>"+registros.acudientes[i].estado_acudiente+"</td><td><a class='btn btn-success' href="+registros.acudientes[i].id_persona+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.acudientes[i].id_persona+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_acudientes tbody").html(html);

				}else{

					html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Datos Disponibles..</p></td></tr>";
					$("#lista_acudientes tbody").html(html);
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
				$(".paginacion_acudiente").html(paginador);

			}

	});

}


function eliminar_acudiente(valor){

	$.ajax({
		url:base_url+"acudientes_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostraracudientes("",1,5);

		}


	});



}

function actualizar_acudiente(){

	$.ajax({
		url:base_url+"acudientes_controller/modificar",
		type:"post",
        data:$("#form_acudientes_actualizar").serialize(),
		success:function(respuesta) {


				$("#modal_actualizar_acudiente").modal('hide');
				if (respuesta==="registroactualizado") {
						
					toastr.success('Información Del Acudiente Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Información Del Acudiente No Actualizada.', 'Success Alert', {timeOut: 3000});	

				}
				else if(respuesta==="acudienteyaexiste"){
					
					toastr.warning('El Acudiente Ya Se Encuentra Registrado.', 'Success Alert', {timeOut: 3000});	

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}
				
				$("#form_acudientes_actualizar")[0].reset();

				mostraracudientes("",1,5);

		}


	});

}


function validar_identificacion_persona(valor){

	$.ajax({
		url:base_url+"acudientes_controller/validar_identificacion",
		type:"post",
		data:{identificacion:valor},
		success:function(respuesta) {
				
				
				if (respuesta==="ok") {
						
					desbloquear_cajas_texto_a();
					limpiar_cajas_texto_a();

				}
				else if(respuesta==="acudienteyaexiste"){
					bloquear_cajas_texto_a();
					limpiar_cajas_texto_a();
					toastr.warning('El N° De Identificación Corresponde A Un Acudiente Ya Registrado.', 'Success Alert', {timeOut: 3000});
						
				}
				else if(respuesta==="estudianteactivo"){
					bloquear_cajas_texto_a();
					limpiar_cajas_texto_a();
					toastr.warning('El N° De Identificación Corresponde A Un Estudiante Activo.', 'Success Alert', {timeOut: 3000});
						
				}
				else{
					
					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						//id_persona = registros[i]["id_persona"];
						tipo_id = registros[i]["tipo_id"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];
						telefono = registros[i]["telefono"];
						correo = registros[i]["email"];
						direccion = registros[i]["direccion"];
						barrio = registros[i]["barrio"];

						//$("#id_persona").val(id_persona);
						$("#tipo_id_a").val(tipo_id);
	        			$("#nombres_a").val(nombres);
	        			$("#apellido1_a").val(apellido1);
	        			$("#apellido2_a").val(apellido2);
	        			$("#telefono_a").val(telefono);
	        			$("#correo_a").val(correo);
	        			$("#direccion_a").val(direccion);
	        			$("#barrio_a").val(barrio);
	        			bloquear_cajas_texto_a();
	        			$("#btn_registrar_acudiente").removeAttr("disabled");
	        			
					};

				}

		
		}

	});
}


function validar_rol(valor){

	$.ajax({
		url:base_url+"acudientes_controller/validar_rol",
		type:"post",
		data:{identificacion:valor},
		success:function(respuesta) {
				
				
				if (respuesta==="si") {
						
					desbloquear_cajas_texto_aa();

				}
				else{
					bloquear_cajas_texto_aa();
						
				}

		
		}

	});
}

//Validar el Ingreso de solo numeros
function validar_solonumeros(e){
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

//Cajas De Texto Del Fomulario Registrar Acudientes
function bloquear_cajas_texto_a(){

	$("#tipo_id_a").attr("readonly", "readonly");
	$("#nombres_a").attr("readonly", "readonly");
    $("#apellido1_a").attr("readonly", "readonly");
    $("#apellido2_a").attr("readonly", "readonly");
    $("#telefono_a").attr("readonly", "readonly");
    $("#correo_a").attr("readonly", "readonly");
    $("#direccion_a").attr("readonly", "readonly");
    $("#barrio_a").attr("readonly", "readonly");
    $("#btn_registrar_acudiente").attr("disabled", "disabled");
}

//Cajas De Texto Del Fomulario Registrar Acudientes
function desbloquear_cajas_texto_a(){

	$("#tipo_id_a").removeAttr("readonly");
	$("#nombres_a").removeAttr("readonly");
    $("#apellido1_a").removeAttr("readonly");
    $("#apellido2_a").removeAttr("readonly");
    $("#telefono_a").removeAttr("readonly");
    $("#correo_a").removeAttr("readonly");
    $("#direccion_a").removeAttr("readonly");
    $("#barrio_a").removeAttr("readonly");
    $("#btn_registrar_acudiente").removeAttr("disabled");
}

//Cajas De Texto Del Fomulario Actualizar Acudientes
function bloquear_cajas_texto_aa(){

	$("#tipo_idsele").attr("readonly", "readonly");
	$("#nombressele").attr("readonly", "readonly");
    $("#apellido1sele").attr("readonly", "readonly");
    $("#apellido2sele").attr("readonly", "readonly");
    $("#telefonosele").attr("readonly", "readonly");
    $("#correosele").attr("readonly", "readonly");
    $("#direccionsele").attr("readonly", "readonly");
    $("#barriosele").attr("readonly", "readonly");
}

//Cajas De Texto Del Fomulario Actualizar Acudientes
function desbloquear_cajas_texto_aa(){

	$("#tipo_idsele").removeAttr("readonly");
	$("#nombressele").removeAttr("readonly");
    $("#apellido1sele").removeAttr("readonly");
    $("#apellido2sele").removeAttr("readonly");
    $("#telefonosele").removeAttr("readonly");
    $("#correosele").removeAttr("readonly");
    $("#direccionsele").removeAttr("readonly");
    $("#barriosele").removeAttr("readonly");
}


function limpiar_cajas_texto_a(){

	$("#tipo_id_a").val("");
	$("#nombres_a").val("");
    $("#apellido1_a").val("");
    $("#apellido2_a").val("");
    $("#telefono_a").val("");
    $("#correo_a").val("");
    $("#direccion_a").val("");
    $("#barrio_a").val("");
    $("#ocupacion_a").val("");
    $("#telefono_trabajo_a").val("");
    $("#direccion_trabajo_a").val("");
}