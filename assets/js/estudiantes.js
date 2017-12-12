$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio


function inicio(){
	mostrarestudiantes("",1,5);
	llenarcombo_departamentos();

	// body...
	// este metodo permite enviar la inf del formulario
	$("body").on("#form_estudiantes").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_estudiantes").valid()==true){

			$.ajax({

				url:$("#form_estudiantes").attr("action"),
				type:$("#form_estudiantes").attr("method"),
				data:$("#form_estudiantes").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					
					if (respuesta==="registroguardado") {

						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#mensajes-error").hide();
						$("#form_estudiantes")[0].reset();


					}
					else if(respuesta==="registro no guardado"){
					
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						$("#mensajes-error").hide();
							

					}
					else if(respuesta==="estudianteyaexiste"){
						
						toastr.success('Ya Fue Registrado', 'Success Alert', {timeOut: 5000});
						$("#mensajes-error").hide();
							

					}
					else{
						$("#mensajes-error").show();
						$("#mensajes-error").html(respuesta);
					}
					mostrarestudiantes("",1,5);

						
						
				}

			});
		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 2000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("body").on("keyup", "#id_buscar",function(event){

		buscar = $("#id_buscar").val();
		valorcantidad = $("#cantidad").val();
		mostrarestudiantes(buscar,1,valorcantidad);
	});
   

    $("body").on("click","#btn_buscar",function(event){
		//alert("pulso");
       mostrarestudiantes("",1,5);
    });


    $("body").on("click","#lista_estudiantes a",function(event){
		event.preventDefault();
		$("#myModal").modal();
		id_personasele = $(this).attr("href");
		idsele = $(this).parent().parent().children("td:eq(2)").text();
		tipo_idsele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		fecha_expedicionsele = $(this).parent().parent().children("td:eq(4)").text();
		departamento_expedicionsele = $(this).parent().parent().children("td:eq(5)").text();
		municipio_expedicionsele = $(this).parent().parent().children("td:eq(6)").text();
		nombressele = $(this).parent().parent().children("td:eq(7)").text();
		apellido1sele = $(this).parent().parent().children("td:eq(8)").text();
		apellido2sele = $(this).parent().parent().children("td:eq(9)").text();
		sexosele = $(this).parent().parent().children("td:eq(10)").text();
		fecha_nacimientosele = $(this).parent().parent().children("td:eq(11)").text();
		lugar_nacimientosele = $(this).parent().parent().children("td:eq(12)").text();
		tipo_sangresele = $(this).parent().parent().children("td:eq(13)").text();
		epssele = $(this).parent().parent().children("td:eq(14)").text();
		poblacionsele = $(this).parent().parent().children("td:eq(15)").text();
		telefonosele = $(this).parent().parent().children("td:eq(16)").text();
		correosele = $(this).parent().parent().children("td:eq(17)").text();
		direccionsele = $(this).parent().parent().children("td:eq(18)").text();
		barriosele = $(this).parent().parent().children("td:eq(19)").text();
		institucion_procedenciasele = $(this).parent().parent().children("td:eq(20)").text();
		discapacidadsele = $(this).parent().parent().children("td:eq(21)").text();

		identificacion_padresele = $(this).parent().parent().children("td:eq(22)").text();
		nombres_padresele = $(this).parent().parent().children("td:eq(23)").text();
		apellidos_padresele = $(this).parent().parent().children("td:eq(24)").text();
		ocupacion_padresele = $(this).parent().parent().children("td:eq(25)").text();
		telefono_padresele = $(this).parent().parent().children("td:eq(26)").text();
		telefono_trabajo_padresele = $(this).parent().parent().children("td:eq(27)").text();
		direccion_trabajo_padresele = $(this).parent().parent().children("td:eq(28)").text();

		identificacion_madresele = $(this).parent().parent().children("td:eq(29)").text();
		nombres_madresele = $(this).parent().parent().children("td:eq(30)").text();
		apellidos_madresele = $(this).parent().parent().children("td:eq(31)").text();
		ocupacion_madresele = $(this).parent().parent().children("td:eq(32)").text();
		telefono_madresele = $(this).parent().parent().children("td:eq(33)").text();
		telefono_trabajo_madresele = $(this).parent().parent().children("td:eq(34)").text();
		direccion_trabajo_madresele = $(this).parent().parent().children("td:eq(35)").text();

		//alert(municipio_expedicionsele);

		llenarcombo_municipios(departamento_expedicionsele,municipio_expedicionsele);
		$("#id_personasele").val(id_personasele);
        $("#idsele").val(idsele);
        $("#tipo_idsele").val(tipo_idsele);
        $("#fecha_expedicionsele").val(fecha_expedicionsele);
        $("#departamento_expedicionsele").val(departamento_expedicionsele);
        $("#municipio_expedicionsele").val(municipio_expedicionsele);
        $("#nombressele").val(nombressele);
        $("#apellido1sele").val(apellido1sele);
        $("#apellido2sele").val(apellido2sele);
        $("#sexosele").val(sexosele);
        $("#fecha_nacimientosele").val(fecha_nacimientosele);
        $("#lugar_nacimientosele").val(lugar_nacimientosele);
        $("#tipo_sangresele").val(tipo_sangresele);
        $("#epssele").val(epssele);
        $("#poblacionsele").val(poblacionsele);
        $("#telefonosele").val(telefonosele);
        $("#correosele").val(correosele);
        $("#direccionsele").val(direccionsele);
        $("#barriosele").val(barriosele);
        $("#institucion_procedenciasele").val(institucion_procedenciasele);
        $("#discapacidadsele").val(discapacidadsele);

        $("#identificacion_padresele").val(identificacion_padresele);
        $("#nombres_padresele").val(nombres_padresele);
        $("#apellidos_padresele").val(apellidos_padresele);
        $("#ocupacion_padresele").val(ocupacion_padresele);
        $("#telefono_padresele").val(telefono_padresele);
        $("#telefono_trabajo_padresele").val(telefono_trabajo_padresele);
        $("#direccion_trabajo_padresele").val(direccion_trabajo_padresele);

        $("#identificacion_madresele").val(identificacion_madresele);
        $("#nombres_madresele").val(nombres_madresele);
        $("#apellidos_madresele").val(apellidos_madresele);
        $("#ocupacion_madresele").val(ocupacion_madresele);
        $("#telefono_madresele").val(telefono_madresele);
        $("#telefono_trabajo_madresele").val(telefono_trabajo_madresele);
        $("#direccion_trabajo_madresele").val(direccion_trabajo_madresele);
        desbloquear_cajas_texto();

	});

	$("body").on("click","#lista_estudiantes button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar(idsele);

		}

	});

    $("body").on("click", "#btn_actualizar", function(event){
    	if($("#form_estudiantes_actualizar").valid()==true){
       		actualizar();
       		bloquear_cajas_texto();

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 2000});
		}
       
    });

    $("body").on("click", ".paginacion li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#id_buscar").val();
    	valorcantidad = $("#cantidad").val();
		mostrarestudiantes(buscar,numero_pagina,valorcantidad);


    });

    $("#cantidad").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#id_buscar").val();
    	mostrarestudiantes(buscar,1,valorcantidad);
    });

    $("#departamento_expedicion").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipios(id_departamento,null);
    	$("#municipio_expedicion").removeAttr("disabled");
    });

    $("#departamento_expedicionsele").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipios(id_departamento,null);
    	$("#municipio_expedicionsele").removeAttr("disabled");
    });

    
	$("#form_estudiantes").validate({

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

			fecha_expedicion:{
				required: true,
				date: true
				
			},

			departamento_expedicion:{
				required: true
				
				
			},

			municipio_expedicion:{
				required: true
				
				
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

			sexo:{
				required: true,
				maxlength: 15
				
			},

			fecha_nacimiento:{
				required: true,
				date: true
				
			},

			lugar_nacimiento:{
				required: true,
				maxlength: 50	

			},

			tipo_sangre:{
				required: true,
				maxlength: 2,
					

			},

			eps:{
				required: true,
				maxlength: 50	

			},

			poblacion:{
				required: true,
				maxlength: 50	

			},

			telefono:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			correo:{
				required: true,
				email: true,
				maxlength: 50	

			},

			direccion:{
				required: true,
				maxlength: 50	

			},

			barrio:{
				required: true,
				maxlength: 40	

			},

			institucion_procedencia:{
				required: true,
				maxlength: 50	

			},

			discapacidad:{
				required: true,
				maxlength: 50	

			},

			identificacion_padre:{
				required: true,
				maxlength: 10,
				digits: true

			},

			nombres_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellidos_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			ocupacion_padre:{
				required: true,
				maxlength: 50	

			},

			telefono_padre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			telefono_trabajo_padre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_trabajo_padre:{
				required: true,
				maxlength: 50	

			},

			identificacion_madre:{
				required: true,
				maxlength: 10,
				digits: true

			},

			nombres_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellidos_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			ocupacion_madre:{
				required: true,
				maxlength: 50	

			},

			telefono_madre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			telefono_trabajo_madre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_trabajo_madre:{
				required: true,
				maxlength: 50	

			}



		}


	});

	$("#form_estudiantes_actualizar").validate({

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

			fecha_expedicion:{
				required: true,
				date: true
				
			},

			departamento_expedicion:{
				required: true
				
				
			},

			municipio_expedicion:{
				required: true
				
				
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

			sexo:{
				required: true,
				maxlength: 15
				
			},

			fecha_nacimiento:{
				required: true,
				date: true
				
			},

			lugar_nacimiento:{
				required: true,
				maxlength: 50	

			},

			tipo_sangre:{
				required: true,
				maxlength: 2,
					

			},

			eps:{
				required: true,
				maxlength: 50	

			},

			poblacion:{
				required: true,
				maxlength: 50	

			},

			telefono:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			correo:{
				required: true,
				email: true,
				maxlength: 50	

			},

			direccion:{
				required: true,
				maxlength: 50	

			},

			barrio:{
				required: true,
				maxlength: 40	

			},

			institucion_procedencia:{
				required: true,
				maxlength: 50	

			},

			discapacidad:{
				required: true,
				maxlength: 50	

			},

			identificacion_padre:{
				required: true,
				maxlength: 10,
				digits: true

			},

			nombres_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellidos_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			ocupacion_padre:{
				required: true,
				maxlength: 50	

			},

			telefono_padre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			telefono_trabajo_padre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_trabajo_padre:{
				required: true,
				maxlength: 50	

			},

			identificacion_madre:{
				required: true,
				maxlength: 10,
				digits: true

			},

			nombres_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellidos_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			ocupacion_madre:{
				required: true,
				maxlength: 50	

			},

			telefono_madre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			telefono_trabajo_madre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_trabajo_madre:{
				required: true,
				maxlength: 50	

			}



		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");




}



function mostrarestudiantes(valor,pagina,cantidad){

	$.ajax({
		//url:"http://localhost/siescolar/estudiantes_controller/mostrarestudiantes",
		url:base_url+"estudiantes_controller/mostrarestudiantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				
				//alert(""+respuesta);
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html="";
				for (var i = 0; i < registros.estudiantes.length; i++) {
					html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.estudiantes[i].id_persona+"</td><td>"+registros.estudiantes[i].identificacion+"</td><td style='display:none'>"+registros.estudiantes[i].tipo_id+"</td><td style='display:none'>"+registros.estudiantes[i].fecha_expedicion+"</td><td style='display:none'>"+registros.estudiantes[i].id_departamento+"</td><td style='display:none'>"+registros.estudiantes[i].id_municipio+"</td><td>"+registros.estudiantes[i].nombres+"</td><td>"+registros.estudiantes[i].apellido1+"</td><td>"+registros.estudiantes[i].apellido2+"</td><td>"+registros.estudiantes[i].sexo+"</td><td>"+registros.estudiantes[i].fecha_nacimiento+"</td><td style='display:none'>"+registros.estudiantes[i].lugar_nacimiento+"</td><td style='display:none'>"+registros.estudiantes[i].tipo_sangre+"</td><td style='display:none'>"+registros.estudiantes[i].eps+"</td><td style='display:none'>"+registros.estudiantes[i].poblacion+"</td><td>"+registros.estudiantes[i].telefono+"</td><td>"+registros.estudiantes[i].email+"</td><td>"+registros.estudiantes[i].direccion+"</td><td style='display:none'>"+registros.estudiantes[i].barrio+"</td><td style='display:none'>"+registros.estudiantes[i].institucion_procedencia+"</td><td style='display:none'>"+registros.estudiantes[i].discapacidad+"</td><td style='display:none'>"+registros.estudiantes[i].identificacion_padre+"</td><td style='display:none'>"+registros.estudiantes[i].nombres_padre+"</td><td style='display:none'>"+registros.estudiantes[i].apellidos_padre+"</td><td style='display:none'>"+registros.estudiantes[i].ocupacion_padre+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_padre+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_trabajo_padre+"</td><td style='display:none'>"+registros.estudiantes[i].direccion_trabajo_padre+"</td><td style='display:none'>"+registros.estudiantes[i].identificacion_madre+"</td><td style='display:none'>"+registros.estudiantes[i].nombres_madre+"</td><td style='display:none'>"+registros.estudiantes[i].apellidos_madre+"</td><td style='display:none'>"+registros.estudiantes[i].ocupacion_madre+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_madre+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_trabajo_madre+"</td><td style='display:none'>"+registros.estudiantes[i].direccion_trabajo_madre+"</td><td><a class='btn btn-success' href="+registros.estudiantes[i].id_persona+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.estudiantes[i].id_persona+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				html +="</table>";
				$("#lista_estudiantes tbody").html(html);

				linkseleccionado = Number(pagina);
				//total de registros
			    totalregistros = registros.totalregistros;
				//cantidad de registros por pagina
				cantidadregistros = registros.cantidad;
				//numero de links o paginas dependiendo de la cantidad de registros y el numero a mostrar
				numerolinks = Math.ceil(totalregistros/cantidadregistros);

				paginador="<ul class='pagination'>";

				//PAGINACION SIN BOTON SIGUIENTE--------------------------------------------------------
				/*for (var i = 1; i <= numerolinks ; i++) {
					if (i==linkseleccionado)
						paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
					else
						paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
					//paginador +="<li><a>HOKA</a></li>";

				};
				paginador +="</ul>";
				$(".paginacion").html(paginador);*/

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
				$(".paginacion").html(paginador);

			}

	});

}


function actualizar(){

	$.ajax({
		url:base_url+"estudiantes_controller/modificar",
		type:"post",
        data:$("#form_estudiantes_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#myModal").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_estudiantes_actualizar")[0].reset();

				mostrarestudiantes("",1,5);

		}


	});

}

function eliminar(valor){

	$.ajax({
		url:base_url+"estudiantes_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				//alert(respuesta);
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarestudiantes("",1,5);

				


		}


	});



}

function llenarcombo_departamentos(){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_departamentos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_departamento"]+">"+registros[i]["nombre_departamento"]+"</option>";
				};
				
				$("#departamento_expedicion1 select").html(html);
		}

	});
}

function llenarcombo_municipios(valor,valor2){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_municipios",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_municipio"]==valor2){
						html +="<option value="+registros[i]["id_municipio"]+" selected>"+registros[i]["nombre_municipio"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_municipio"]+">"+registros[i]["nombre_municipio"]+"</option>";
					}
				};
				$("#municipio_expedicion1 select").html(html);
		}

	});


}



function bloquear_cajas_texto(){

	$("#idsele").attr("disabled", "disabled");
    $("#tipo_idsele").attr("disabled", "disabled");
    $("#fecha_expedicionsele").attr("disabled", "disabled");
    $("#nombressele").attr("disabled", "disabled");
    $("#apellido1sele").attr("disabled", "disabled");
    $("#apellido2sele").attr("disabled", "disabled");
    $("#sexosele").attr("disabled", "disabled");
    $("#fecha_nacimientosele").attr("disabled", "disabled");
    $("#lugar_nacimientosele").attr("disabled", "disabled");
    $("#tipo_sangresele").attr("disabled", "disabled");
    $("#epssele").attr("disabled", "disabled");
    $("#telefonosele").attr("disabled", "disabled");
    $("#correosele").attr("disabled", "disabled");
    $("#direccionsele").attr("disabled", "disabled");
    $("#barriosele").attr("disabled", "disabled");
    $("#institucion_procedenciasele").attr("disabled", "disabled");
    $("#discapacidadsele").attr("disabled", "disabled");
    $("#btn_actualizar").attr("disabled", "disabled");
}

function desbloquear_cajas_texto(){


	$("#idsele").removeAttr("disabled");
    $("#tipo_idsele").removeAttr("disabled");
    $("#fecha_expedicionsele").removeAttr("disabled");
    $("#nombressele").removeAttr("disabled");
    $("#apellido1sele").removeAttr("disabled");
    $("#apellido2sele").removeAttr("disabled");
    $("#sexosele").removeAttr("disabled");
    $("#fecha_nacimientosele").removeAttr("disabled");
    $("#lugar_nacimientosele").removeAttr("disabled");
    $("#tipo_sangresele").removeAttr("disabled");
    $("#epssele").removeAttr("disabled");
    $("#telefonosele").removeAttr("disabled");
    $("#correosele").removeAttr("disabled");
    $("#direccionsele").removeAttr("disabled");
    $("#barriosele").removeAttr("disabled");
    $("#institucion_procedenciasele").removeAttr("disabled");
    $("#discapacidadsele").removeAttr("disabled");
    $("#btn_actualizar").removeAttr("disabled");

}