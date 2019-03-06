$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio


function inicio(){
	mostrarprofesores("",1,5);
	llenarcombo_paisesP();
	llenarcombo_paisesNP();
	llenarcombo_paisesRP();
	
	// body...
	// este metodo permite enviar la inf del formulario
	$("#form_profesores").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_profesores").valid()==true){

			$.ajax({

				url:$("#form_profesores").attr("action"),
				type:$("#form_profesores").attr("method"),
				data:$("#form_profesores").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					
					if (respuesta==="registroguardado") {
						
						toastr.success('Profesor Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_profesores")[0].reset();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Profesor No Registrado.', 'Success Alert', {timeOut: 5000});
						
							
					}
					else if(respuesta==="profesoryaexiste"){
						
						toastr.warning('El Profesor Ya Se Encuentra Registrado.', 'Success Alert', {timeOut: 5000});
						
							
					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarprofesores("",1,5);

						
						
				}

			});
		}else{
			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_profesores").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_profesor").click(function(){

		$("#modal_agregar_profesor").modal();
       
    });

    $("#btn_buscar_profesor").click(function(event){
		
       mostrarprofesores("",1,5);
    });

    $("#buscar_profesor").keyup(function(event){

    	buscar = $("#buscar_profesor").val();
		valorcantidad = $("#cantidad_profesor").val();
		mostrarprofesores(buscar,1,valorcantidad);
		
    });

    $("#cantidad_profesor").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_profesor").val();
    	mostrarprofesores(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_profesor li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_profesor").val();
    	valorcantidad = $("#cantidad_profesor").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarprofesores(buscar,numero_pagina,valorcantidad);
		}	

    });

    $("body").on("click","#lista_profesores button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("Esta Seguro De Eliminar Este Profesor.?")){
			eliminar_profesor(idsele);

		}

	});


    $("body").on("click","#lista_profesores a",function(event){
		event.preventDefault();
		$("#modal_actualizar_profesor").modal();
		id_personasele = $(this).attr("href");
		identificacionsele = $(this).parent().parent().children("td:eq(2)").text();
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
		telefonosele = $(this).parent().parent().children("td:eq(16)").text();
		correosele = $(this).parent().parent().children("td:eq(17)").text();
		direccionsele = $(this).parent().parent().children("td:eq(18)").text();
		barriosele = $(this).parent().parent().children("td:eq(19)").text();
		pais_residenciasele = $(this).parent().parent().children("td:eq(20)").text();
		departamento_residenciasele = $(this).parent().parent().children("td:eq(21)").text();
		municipio_residenciasele = $(this).parent().parent().children("td:eq(22)").text();
		estratosele = $(this).parent().parent().children("td:eq(23)").text();

		titulosele = $(this).parent().parent().children("td:eq(24)").text();
		escalafonsele = $(this).parent().parent().children("td:eq(25)").text();
		fecha_vinculacionsele = $(this).parent().parent().children("td:eq(26)").text();
		tipo_vinculacionsele = $(this).parent().parent().children("td:eq(27)").text();
		decretosele = $(this).parent().parent().children("td:eq(28)").text();
		
		//alert(barriosele);
		llenarcombo_departamentosP(pais_expedicionsele,departamento_expedicionsele);
		llenarcombo_departamentosNP(pais_nacimientosele,departamento_nacimientosele);
		llenarcombo_departamentosRP(pais_residenciasele,departamento_residenciasele);

		llenarcombo_municipiosP(departamento_expedicionsele,municipio_expedicionsele);
		llenarcombo_municipiosNP(departamento_nacimientosele,municipio_nacimientosele);
		llenarcombo_municipiosRP(departamento_residenciasele,municipio_residenciasele);

		$("#id_personasele").val(id_personasele);
        $("#identificacionsele").val(identificacionsele);
        $("#tipo_idsele").val(tipo_idsele);
        $("#fecha_expedicionsele").val(fecha_expedicionsele);
        $("#pais_expedicionseleP").val(pais_expedicionsele);
        $("#departamento_expedicionseleP").val(departamento_expedicionsele);
        $("#municipio_expedicionseleP").val(municipio_expedicionsele);
        $("#nombressele").val(nombressele);
        $("#apellido1sele").val(apellido1sele);
        $("#apellido2sele").val(apellido2sele);
        $("#sexosele").val(sexosele);
        $("#fecha_nacimientosele").val(fecha_nacimientosele);
        $("#pais_nacimientoseleP").val(pais_nacimientosele);
        $("#departamento_nacimientoseleP").val(departamento_nacimientosele);
        $("#municipio_nacimientoseleP").val(municipio_nacimientosele);
        $("#telefonosele").val(telefonosele);
        $("#correosele").val(correosele);
        $("#direccionsele").val(direccionsele);
        $("#barriosele").val(barriosele);
        $("#pais_residenciaseleP").val(pais_residenciasele);
        $("#departamento_residenciaseleP").val(departamento_residenciasele);
        $("#municipio_residenciaseleP").val(municipio_residenciasele);
        $("#estratosele").val(estratosele);

        $("#titulosele").val(titulosele);
        $("#escalafonsele").val(escalafonsele);
        $("#fecha_vinculacionsele").val(fecha_vinculacionsele);
        $("#tipo_vinculacionsele").val(tipo_vinculacionsele);
        $("#decretosele").val(decretosele);
        //desbloquear_cajas_texto();

	});

	
   $("#btn_actualizar_profesor").click(function(event){

    	if($("#form_profesores_actualizar").valid()==true){
       		actualizar_profesor();
       	
        }
        else{
			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
			//alert($("#form_profesores_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


   $("#pais_expedicionP").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosP(id_pais,null);
    	$("#municipio_expedicionP1 select").html("");
    });

    $("#departamento_expedicionP").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosP(id_departamento,null);
    });

    $("#pais_expedicionseleP").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosP(id_pais,null);
    	$("#municipio_expedicionP1 select").html("");
    });

    $("#departamento_expedicionseleP").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosP(id_departamento,null);
    });

    $("#pais_nacimientoP").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosNP(id_pais,null);
    	$("#municipio_nacimientoP1 select").html("");
    });

    $("#departamento_nacimientoP").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosNP(id_departamento,null);
    });

    $("#pais_nacimientoseleP").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosNP(id_pais,null);
    	$("#municipio_nacimientoP1 select").html("");
    });

    $("#departamento_nacimientoseleP").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosNP(id_departamento,null);
    });

    $("#pais_residenciaP").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosRP(id_pais,null);
    	$("#municipio_residenciaP1 select").html("");
    });

    $("#departamento_residenciaP").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosRP(id_departamento,null);
    });

    $("#pais_residenciaseleP").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosRP(id_pais,null);
    	$("#municipio_residenciaP1 select").html("");
    });

    $("#departamento_residenciaseleP").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosRP(id_departamento,null);
    });


   $("#modal_agregar_profesor").on('hidden.bs.modal', function () {
        $("#form_profesores")[0].reset();
        $("#form_profesores").valid()==true;
    });


    $("#modal_actualizar_profesor").on('hidden.bs.modal', function () {
        $("#form_profesores_actualizar")[0].reset();
        $("#form_profesores_actualizar").valid()==true;

        $("#departamento_expedicionP1 select").html("");
        $("#departamento_nacimientoP1 select").html("");
        $("#departamento_residenciaP1 select").html("");

        $("#municipio_expedicionP1 select").html("");
        $("#municipio_nacimientoP1 select").html("");
        $("#municipio_residenciaP1 select").html("");
    });

   	
	$("#form_profesores").validate({

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
				maxlength: 50	

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

			titulo:{
				required: true,
				maxlength: 100	

			},

			escalafon:{
				required: true,
				maxlength: 3	

			},

			fecha_vinculacion:{
				required: true,
				date: true

			},

			tipo_vinculacion:{
				required: true,
				maxlength: 50

			}


		}


	});

	$("#form_profesores_actualizar").validate({

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
				maxlength: 50	

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

			titulo:{
				required: true,
				maxlength: 100	

			},

			escalafon:{
				required: true,
				maxlength: 3	

			},

			fecha_vinculacion:{
				required: true,
				date: true

			},

			tipo_vinculacion:{
				required: true,
				maxlength: 50

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");

	/*$("#form_profesores").validate({
    	ignore: ""
	});*/

	/*$.validator.setDefaults({
    		ignore: "",
	});*/

}



function mostrarprofesores(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"profesores_controller/mostrarprofesores",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.profesores.length > 0) {

					for (var i = 0; i < registros.profesores.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.profesores[i].id_persona+"</td><td>"+registros.profesores[i].identificacion+"</td><td style='display:none'>"+registros.profesores[i].tipo_id+"</td><td style='display:none'>"+registros.profesores[i].fecha_expedicion+"</td><td style='display:none'>"+registros.profesores[i].pais_expedicion+"</td><td style='display:none'>"+registros.profesores[i].departamento_expedicion+"</td><td style='display:none'>"+registros.profesores[i].municipio_expedicion+"</td><td>"+registros.profesores[i].nombres+"</td><td>"+registros.profesores[i].apellido1+"</td><td>"+registros.profesores[i].apellido2+"</td><td>"+registros.profesores[i].sexo+"</td><td>"+registros.profesores[i].fecha_nacimiento+"</td><td style='display:none'>"+registros.profesores[i].pais_nacimiento+"</td><td style='display:none'>"+registros.profesores[i].departamento_nacimiento+"</td><td style='display:none'>"+registros.profesores[i].municipio_nacimiento+"</td><td>"+registros.profesores[i].telefono+"</td><td>"+registros.profesores[i].email+"</td><td>"+registros.profesores[i].direccion+"</td><td style='display:none'>"+registros.profesores[i].barrio+"</td><td style='display:none'>"+registros.profesores[i].pais_residencia+"</td><td style='display:none'>"+registros.profesores[i].departamento_residencia+"</td><td style='display:none'>"+registros.profesores[i].municipio_residencia+"</td><td style='display:none'>"+registros.profesores[i].estrato+"</td><td style='display:none'>"+registros.profesores[i].titulo+"</td><td style='display:none'>"+registros.profesores[i].escalafon+"</td><td style='display:none'>"+registros.profesores[i].fecha_vinculacion+"</td><td style='display:none'>"+registros.profesores[i].tipo_vinculacion+"</td><td style='display:none'>"+registros.profesores[i].decreto_nombramiento+"</td><td style='display:none'>"+registros.profesores[i].estado_profesor+"</td><td><a class='btn btn-success' href="+registros.profesores[i].id_persona+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.profesores[i].id_persona+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_profesores tbody").html(html);
				}
				else{
					html ="<tr><td colspan='12'><p style='text-align:center'>No Hay Profesores Registrados..</p></td></tr>";
					$("#lista_profesores tbody").html(html);
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
				$(".paginacion_profesor").html(paginador);

			}

	});

}


function eliminar_profesor(valor){

	$.ajax({
		url:base_url+"profesores_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarprofesores("",1,5);

		}


	});



}

function actualizar_profesor(){

	$.ajax({
		url:base_url+"profesores_controller/modificar",
		type:"post",
        data:$("#form_profesores_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_profesor").modal('hide');
				
				if (respuesta==="registroactualizado") {
					
					toastr.success('Información Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Información No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="profesoryaexiste"){
					
					toastr.warning('Profesor Ya Registrado.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_profesores_actualizar")[0].reset();

				mostrarprofesores("",1,5);

		}


	});

}


function llenarcombo_paisesP(){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_paises",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_pais"]+">"+registros[i]["nombre_pais"]+"</option>";
				};
				
				$("#pais_expedicionP1 select").html(html);
		}

	});
}


function llenarcombo_departamentosP(valor,valor2){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_departamentos",
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
				
				$("#departamento_expedicionP1 select").html(html);
		}

	});
}

function llenarcombo_municipiosP(valor,valor2){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_municipios",
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
				$("#municipio_expedicionP1 select").html(html);
		}

	});


}


function llenarcombo_paisesNP(){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_paises",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_pais"]+">"+registros[i]["nombre_pais"]+"</option>";
				};
				
				$("#pais_nacimientoP1 select").html(html);
		}

	});
}


function llenarcombo_departamentosNP(valor,valor2){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_departamentos",
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
				
				$("#departamento_nacimientoP1 select").html(html);
		}

	});
}


function llenarcombo_municipiosNP(valor,valor2){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_municipios",
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
				$("#municipio_nacimientoP1 select").html(html);
		}

	});


}


function llenarcombo_paisesRP(){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_paises",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_pais"]+">"+registros[i]["nombre_pais"]+"</option>";
				};
				
				$("#pais_residenciaP1 select").html(html);
		}

	});
}


function llenarcombo_departamentosRP(valor,valor2){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_departamentos",
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
				
				$("#departamento_residenciaP1 select").html(html);
		}

	});
}


function llenarcombo_municipiosRP(valor,valor2){

	$.ajax({
		url:base_url+"profesores_controller/llenarcombo_municipios",
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
				$("#municipio_residenciaP1 select").html(html);
		}

	});


}