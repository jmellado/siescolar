$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio


function inicio(){
	mostrarestudiantes("",1,5);
	llenarcombo_paises();
	llenarcombo_paisesN();
	llenarcombo_paisesR();

	// body...
	// este metodo permite enviar la inf del formulario
	$("#form_estudiantes").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_estudiantes").valid()==true){

			$.ajax({

				url:$("#form_estudiantes").attr("action"),
				type:$("#form_estudiantes").attr("method"),
				data:$("#form_estudiantes").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					
					if (respuesta==="registroguardado") {

						toastr.success('Estudiante Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#mensajes-error").hide();
						$("#form_estudiantes")[0].reset();
						llenarcombo_municipios("","");
						llenarcombo_municipiosN("","");

					}
					else if(respuesta==="registronoguardado"){
					
						toastr.error('Estudiante No Registrado.', 'Success Alert', {timeOut: 5000});
						//$("#mensajes-error").hide();
							

					}
					else if(respuesta==="estudianteyaexiste"){
						
						toastr.warning('El Estudiante Ya Se Encuentra Registrado.', 'Success Alert', {timeOut: 5000});
						//$("#mensajes-error").hide();
							

					}
					else{
						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						//$("#mensajes-error").show();
						//$("#mensajes-error").html(respuesta);
					}
					mostrarestudiantes("",1,5);

						
						
				}

			});
		}else{

			toastr.success('Formulario incorrecto.', 'Success Alert', {timeOut: 2000});
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
		pais_expedicionsele = $(this).parent().parent().children("td:eq(5)").text();
		departamento_expedicionsele = $(this).parent().parent().children("td:eq(6)").text();
		municipio_expedicionsele = $(this).parent().parent().children("td:eq(7)").text();
		nombressele = $(this).parent().parent().children("td:eq(8)").text();
		apellido1sele = $(this).parent().parent().children("td:eq(9)").text();
		apellido2sele = $(this).parent().parent().children("td:eq(10)").text();
		sexosele = $(this).parent().parent().children("td:eq(11)").text();
		fecha_nacimientosele = $(this).parent().parent().children("td:eq(12)").text();
		pais_nacimientosele = $(this).parent().parent().children("td:eq(13)").text();
		departamento_nacimientosele = $(this).parent().parent().children("td:eq(14)").text();
		municipio_nacimientosele = $(this).parent().parent().children("td:eq(15)").text();
		tipo_sangresele = $(this).parent().parent().children("td:eq(16)").text();
		epssele = $(this).parent().parent().children("td:eq(17)").text();
		poblacionsele = $(this).parent().parent().children("td:eq(18)").text();
		telefonosele = $(this).parent().parent().children("td:eq(19)").text();
		correosele = $(this).parent().parent().children("td:eq(20)").text();
		direccionsele = $(this).parent().parent().children("td:eq(21)").text();
		barriosele = $(this).parent().parent().children("td:eq(22)").text();
		institucion_procedenciasele = $(this).parent().parent().children("td:eq(23)").text();
		grado_cursadosele = $(this).parent().parent().children("td:eq(24)").text();
		aniosele = $(this).parent().parent().children("td:eq(25)").text();
		discapacidadsele = $(this).parent().parent().children("td:eq(26)").text();
		identificacion_padresele = $(this).parent().parent().children("td:eq(27)").text();
		nombres_padresele = $(this).parent().parent().children("td:eq(28)").text();
		apellido1_padresele = $(this).parent().parent().children("td:eq(29)").text();
		apellido2_padresele = $(this).parent().parent().children("td:eq(30)").text();
		ocupacion_padresele = $(this).parent().parent().children("td:eq(31)").text();
		telefono_padresele = $(this).parent().parent().children("td:eq(32)").text();
		direccion_padresele = $(this).parent().parent().children("td:eq(33)").text();
		barrio_padresele = $(this).parent().parent().children("td:eq(34)").text();
		telefono_trabajo_padresele = $(this).parent().parent().children("td:eq(35)").text();
		direccion_trabajo_padresele = $(this).parent().parent().children("td:eq(36)").text();
		identificacion_madresele = $(this).parent().parent().children("td:eq(37)").text();
		nombres_madresele = $(this).parent().parent().children("td:eq(38)").text();
		apellido1_madresele = $(this).parent().parent().children("td:eq(39)").text();
		apellido2_madresele = $(this).parent().parent().children("td:eq(40)").text();
		ocupacion_madresele = $(this).parent().parent().children("td:eq(41)").text();
		telefono_madresele = $(this).parent().parent().children("td:eq(42)").text();
		direccion_madresele = $(this).parent().parent().children("td:eq(43)").text();
		barrio_madresele = $(this).parent().parent().children("td:eq(44)").text();
		telefono_trabajo_madresele = $(this).parent().parent().children("td:eq(45)").text();
		direccion_trabajo_madresele = $(this).parent().parent().children("td:eq(46)").text();
		id_padresele = $(this).parent().parent().children("td:eq(47)").text();
		id_madresele = $(this).parent().parent().children("td:eq(48)").text();

		pais_residenciasele = $(this).parent().parent().children("td:eq(49)").text();
		departamento_residenciasele = $(this).parent().parent().children("td:eq(50)").text();
		municipio_residenciasele = $(this).parent().parent().children("td:eq(51)").text();
		estratosele = $(this).parent().parent().children("td:eq(52)").text();

		//alert(municipio_expedicionsele);
		llenarcombo_departamentos(pais_expedicionsele,departamento_expedicionsele);
		llenarcombo_departamentosN(pais_nacimientosele,departamento_nacimientosele);
		llenarcombo_departamentosR(pais_residenciasele,departamento_residenciasele);

		llenarcombo_municipios(departamento_expedicionsele,municipio_expedicionsele);
		llenarcombo_municipiosN(departamento_nacimientosele,municipio_nacimientosele);
		llenarcombo_municipiosR(departamento_residenciasele,municipio_residenciasele);

		$("#id_personasele").val(id_personasele);
        $("#idsele").val(idsele);
        $("#tipo_idsele").val(tipo_idsele);
        $("#fecha_expedicionsele").val(fecha_expedicionsele);
        $("#pais_expedicionsele").val(pais_expedicionsele);
        $("#departamento_expedicionsele").val(departamento_expedicionsele);
        $("#municipio_expedicionsele").val(municipio_expedicionsele);
        $("#nombressele").val(nombressele);
        $("#apellido1sele").val(apellido1sele);
        $("#apellido2sele").val(apellido2sele);
        $("#sexosele").val(sexosele);
        $("#fecha_nacimientosele").val(fecha_nacimientosele);
        $("#pais_nacimientosele").val(pais_nacimientosele);
        $("#departamento_nacimientosele").val(departamento_nacimientosele);
        $("#municipio_nacimientosele").val(municipio_nacimientosele);
        $("#tipo_sangresele").val(tipo_sangresele);
        $("#epssele").val(epssele);
        $("#poblacionsele").val(poblacionsele);
        $("#telefonosele").val(telefonosele);
        $("#correosele").val(correosele);
        $("#direccionsele").val(direccionsele);
        $("#barriosele").val(barriosele);

        $("#institucion_procedenciasele").val(institucion_procedenciasele);
        $("#discapacidadsele").val(discapacidadsele);
        $("#grado_cursadosele").val(grado_cursadosele);
        $("#aniosele").val(aniosele);

        $("#identificacion_padresele").val(identificacion_padresele);
        $("#nombres_padresele").val(nombres_padresele);
        $("#apellido1_padresele").val(apellido1_padresele);
        $("#apellido2_padresele").val(apellido2_padresele);
        $("#ocupacion_padresele").val(ocupacion_padresele);
        $("#telefono_padresele").val(telefono_padresele);
        $("#direccion_padresele").val(direccion_padresele);
        $("#barrio_padresele").val(barrio_padresele);
        $("#telefono_trabajo_padresele").val(telefono_trabajo_padresele);
        $("#direccion_trabajo_padresele").val(direccion_trabajo_padresele);

        $("#identificacion_madresele").val(identificacion_madresele);
        $("#nombres_madresele").val(nombres_madresele);
        $("#apellido1_madresele").val(apellido1_madresele);
        $("#apellido2_madresele").val(apellido2_madresele);
        $("#ocupacion_madresele").val(ocupacion_madresele);
        $("#telefono_madresele").val(telefono_madresele);
        $("#direccion_madresele").val(direccion_madresele);
        $("#barrio_madresele").val(barrio_madresele);
        $("#telefono_trabajo_madresele").val(telefono_trabajo_madresele);
        $("#direccion_trabajo_madresele").val(direccion_trabajo_madresele);

        $("#id_padresele").val(id_padresele);
        $("#id_madresele").val(id_madresele);

        $("#pais_residenciasele").val(pais_residenciasele);
        $("#departamento_residenciasele").val(departamento_residenciasele);
        $("#municipio_residenciasele").val(municipio_residenciasele);
        $("#estratosele").val(estratosele);
        desbloquear_cajas_texto();

	});

	$("body").on("click","#lista_estudiantes button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Este Estudiante.?")){
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

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
    		
			mostrarestudiantes(buscar,numero_pagina,valorcantidad);
		}

    });

    $("#cantidad").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#id_buscar").val();
    	mostrarestudiantes(buscar,1,valorcantidad);
    });

    $("#pais_expedicion").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentos(id_pais,null);
    	$("#municipio_expedicion1 select").html("");
    });

    $("#departamento_expedicion").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipios(id_departamento,null);
    	//$("#departamento_expedicion").removeAttr("disabled");
    });

    $("#pais_expedicionsele").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentos(id_pais,null);
    	$("#municipio_expedicion1 select").html("");
    });

    $("#departamento_expedicionsele").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipios(id_departamento,null);
    	//$("#departamento_expedicionsele").removeAttr("disabled");
    });

    $("#pais_nacimiento").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosN(id_pais,null);
    	$("#municipio_nacimiento1 select").html("");
    });

    $("#departamento_nacimiento").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosN(id_departamento,null);
    	//$("#departamento_nacimiento").removeAttr("disabled");
    });

    $("#pais_nacimientosele").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosN(id_pais,null);
    	$("#municipio_nacimiento1 select").html("");
    });

    $("#departamento_nacimientosele").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosN(id_departamento,null);
    	//$("#departamento_nacimientosele").removeAttr("disabled");
    });

    $("#pais_residencia").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosR(id_pais,null);
    	$("#municipio_residencia1 select").html("");
    });

    $("#departamento_residencia").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosR(id_departamento,null);
    	//$("#departamento_residencia").removeAttr("disabled");
    });

    $("#pais_residenciasele").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosR(id_pais,null);
    	$("#municipio_residencia1 select").html("");
    });

    $("#departamento_residenciasele").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosR(id_departamento,null);
    	//$("#departamento_residenciasele").removeAttr("disabled");
    });


    $("#myModal").on('hidden.bs.modal', function () {
        $("#form_estudiantes_actualizar")[0].reset();
        $("#form_estudiantes_actualizar").valid()==true;
    });

    
	$("#form_estudiantes").validate({

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

			fecha_expedicion:{
				required: true,
				date: true
				
			},

			pais_expedicion:{
				required: true
				
				
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

			pais_nacimiento:{
				required: true
				
				
			},

			departamento_nacimiento:{
				required: true
				
				
			},

			municipio_nacimiento:{
				required: true
				
				
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

			pais_residencia:{
				required: true
				
				
			},

			departamento_residencia:{
				required: true
				
				
			},

			municipio_residencia:{
				required: true
				
				
			},

			estrato:{
				required: true,
				maxlength: 1
				
			},

			/*institucion_procedencia:{
				required: true,
				maxlength: 50	

			},*/

			discapacidad:{
				required: true,
				maxlength: 50	

			},

			grado_cursado:{
				required: true,
				maxlength: 10	

			},

			/*anio:{
				required: true,
				maxlength: 4,
				digits: true	

			},*/

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

			apellido1_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido2_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			telefono_padre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_padre:{
				required: true,
				maxlength: 50	

			},

			barrio_padre:{
				required: true,
				maxlength: 40	

			},

			ocupacion_padre:{
				required: true,
				maxlength: 50	

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

			apellido1_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido2_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			telefono_madre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_madre:{
				required: true,
				maxlength: 50	

			},

			barrio_madre:{
				required: true,
				maxlength: 40	

			},

			ocupacion_madre:{
				required: true,
				maxlength: 50	

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
				maxlength: 11,
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

			pais_expedicion:{
				required: true
				
				
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

			pais_nacimiento:{
				required: true
				
				
			},

			departamento_nacimiento:{
				required: true
				
				
			},

			municipio_nacimiento:{
				required: true
				
				
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

			pais_residencia:{
				required: true
				
				
			},

			departamento_residencia:{
				required: true
				
				
			},

			municipio_residencia:{
				required: true
				
				
			},

			estrato:{
				required: true,
				maxlength: 1
				
			},

			/*institucion_procedencia:{
				required: true,
				maxlength: 50	

			},*/

			discapacidad:{
				required: true,
				maxlength: 50	

			},

			grado_cursado:{
				required: true,
				maxlength: 10	

			},

			/*anio:{
				required: true,
				maxlength: 4,
				digits: true	

			},*/

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

			apellido1_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido2_padre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			telefono_padre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_padre:{
				required: true,
				maxlength: 50	

			},

			barrio_padre:{
				required: true,
				maxlength: 40	

			},

			ocupacion_padre:{
				required: true,
				maxlength: 50	

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

			apellido1_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			apellido2_madre:{
				required: true,
				maxlength: 50,
				lettersonly: true	

			},

			telefono_madre:{
				required: true,
				maxlength: 10,
				digits: true	

			},

			direccion_madre:{
				required: true,
				maxlength: 50	

			},

			barrio_madre:{
				required: true,
				maxlength: 40	

			},

			ocupacion_madre:{
				required: true,
				maxlength: 50	

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
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
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

				if (registros.estudiantes.length > 0) {

					for (var i = 0; i < registros.estudiantes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.estudiantes[i].id_persona+"</td><td>"+registros.estudiantes[i].identificacion+"</td><td style='display:none'>"+registros.estudiantes[i].tipo_id+"</td><td style='display:none'>"+registros.estudiantes[i].fecha_expedicion+"</td><td style='display:none'>"+registros.estudiantes[i].pais_expedicion+"</td><td style='display:none'>"+registros.estudiantes[i].departamento_expedicion+"</td><td style='display:none'>"+registros.estudiantes[i].municipio_expedicion+"</td><td>"+registros.estudiantes[i].nombres+"</td><td>"+registros.estudiantes[i].apellido1+"</td><td>"+registros.estudiantes[i].apellido2+"</td><td>"+registros.estudiantes[i].sexo+"</td><td>"+registros.estudiantes[i].fecha_nacimiento+"</td><td style='display:none'>"+registros.estudiantes[i].pais_nacimiento+"</td><td style='display:none'>"+registros.estudiantes[i].departamento_nacimiento+"</td><td style='display:none'>"+registros.estudiantes[i].municipio_nacimiento+"</td><td style='display:none'>"+registros.estudiantes[i].tipo_sangre+"</td><td style='display:none'>"+registros.estudiantes[i].eps+"</td><td style='display:none'>"+registros.estudiantes[i].poblacion+"</td><td>"+registros.estudiantes[i].telefono+"</td><td>"+registros.estudiantes[i].email+"</td><td>"+registros.estudiantes[i].direccion+"</td><td style='display:none'>"+registros.estudiantes[i].barrio+"</td><td style='display:none'>"+registros.estudiantes[i].institucion_procedencia+"</td><td style='display:none'>"+registros.estudiantes[i].grado_cursado+"</td><td style='display:none'>"+registros.estudiantes[i].anio+"</td><td style='display:none'>"+registros.estudiantes[i].discapacidad+"</td><td style='display:none'>"+registros.estudiantes[i].identificacion_p+"</td><td style='display:none'>"+registros.estudiantes[i].nombres_p+"</td><td style='display:none'>"+registros.estudiantes[i].apellido1_p+"</td><td style='display:none'>"+registros.estudiantes[i].apellido2_p+"</td><td style='display:none'>"+registros.estudiantes[i].ocupacion_p+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_p+"</td><td style='display:none'>"+registros.estudiantes[i].direccion_p+"</td><td style='display:none'>"+registros.estudiantes[i].barrio_p+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_trabajo_p+"</td><td style='display:none'>"+registros.estudiantes[i].direccion_trabajo_p+"</td><td style='display:none'>"+registros.estudiantes[i].identificacion_m+"</td><td style='display:none'>"+registros.estudiantes[i].nombres_m+"</td><td style='display:none'>"+registros.estudiantes[i].apellido1_m+"</td><td style='display:none'>"+registros.estudiantes[i].apellido2_m+"</td><td style='display:none'>"+registros.estudiantes[i].ocupacion_m+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_m+"</td><td style='display:none'>"+registros.estudiantes[i].direccion_m+"</td><td style='display:none'>"+registros.estudiantes[i].barrio_m+"</td><td style='display:none'>"+registros.estudiantes[i].telefono_trabajo_m+"</td><td style='display:none'>"+registros.estudiantes[i].direccion_trabajo_m+"</td><td style='display:none'>"+registros.estudiantes[i].id_padre+"</td><td style='display:none'>"+registros.estudiantes[i].id_madre+"</td><td style='display:none'>"+registros.estudiantes[i].pais_residencia+"</td><td style='display:none'>"+registros.estudiantes[i].departamento_residencia+"</td><td style='display:none'>"+registros.estudiantes[i].municipio_residencia+"</td><td style='display:none'>"+registros.estudiantes[i].estrato+"</td><td><a class='btn btn-success' href="+registros.estudiantes[i].id_persona+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.estudiantes[i].id_persona+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_estudiantes tbody").html(html);
				}
				else{
					html ="<tr><td colspan='12'><p style='text-align:center'>No Hay Estudiantes Registrados..</p></td></tr>";
					$("#lista_estudiantes tbody").html(html);
				}

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

				if (respuesta==="registroactualizado") {
					
					toastr.success('Información Del Estudiante Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Información Del Estudiante No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="estudianteyaexiste"){
					
					toastr.warning('El Estudiante Ya Se Encuentra Registrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

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


function llenarcombo_paises(){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_paises",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_pais"]+">"+registros[i]["nombre_pais"]+"</option>";
				};
				
				$("#pais_expedicion1 select").html(html);
		}

	});
}

function llenarcombo_departamentos(valor,valor2){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_departamentos",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_departamento"]==valor2){
						html +="<option value="+registros[i]["id_departamento"]+" selected>"+registros[i]["nombre_departamento"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_departamento"]+">"+registros[i]["nombre_departamento"]+"</option>";
					}
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


function llenarcombo_paisesN(){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_paises",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_pais"]+">"+registros[i]["nombre_pais"]+"</option>";
				};
				
				$("#pais_nacimiento1 select").html(html);
		}

	});
}


function llenarcombo_departamentosN(valor,valor2){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_departamentos",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if(registros[i]["id_departamento"]==valor2){
						html +="<option value="+registros[i]["id_departamento"]+" selected>"+registros[i]["nombre_departamento"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_departamento"]+">"+registros[i]["nombre_departamento"]+"</option>";
					}
				};
				
				$("#departamento_nacimiento1 select").html(html);
		}

	});
}


function llenarcombo_municipiosN(valor,valor2){

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
				$("#municipio_nacimiento1 select").html(html);
		}

	});


}


function llenarcombo_paisesR(){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_paises",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_pais"]+">"+registros[i]["nombre_pais"]+"</option>";
				};
				
				$("#pais_residencia1 select").html(html);
		}

	});
}


function llenarcombo_departamentosR(valor,valor2){

	$.ajax({
		url:base_url+"estudiantes_controller/llenarcombo_departamentos",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if(registros[i]["id_departamento"]==valor2){
						html +="<option value="+registros[i]["id_departamento"]+" selected>"+registros[i]["nombre_departamento"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_departamento"]+">"+registros[i]["nombre_departamento"]+"</option>";
					}
				};
				
				$("#departamento_residencia1 select").html(html);
		}

	});
}


function llenarcombo_municipiosR(valor,valor2){

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
				$("#municipio_residencia1 select").html(html);
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