$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio


function inicio(){
	mostrarprofesores("",1,5);
	
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
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_profesores")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						
							

					}
					else if(respuesta==="profesor ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
						
							

					}
					else{
						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarprofesores("",1,5);

						
						
				}

			});
		}else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
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
		mostrarprofesores(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_profesores button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_profesor(idsele);

		}

	});


    $("body").on("click","#lista_profesores a",function(event){
		event.preventDefault();
		$("#modal_actualizar_profesor").modal();
		id_personasele = $(this).attr("href");
		identificacionsele = $(this).parent().parent().children("td:eq(2)").text();
		tipo_idsele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		nombressele = $(this).parent().parent().children("td:eq(4)").text();
		apellido1sele = $(this).parent().parent().children("td:eq(5)").text();
		apellido2sele = $(this).parent().parent().children("td:eq(6)").text();
		sexosele = $(this).parent().parent().children("td:eq(7)").text();
		fecha_nacimientosele = $(this).parent().parent().children("td:eq(8)").text();
		telefonosele = $(this).parent().parent().children("td:eq(9)").text();
		correosele = $(this).parent().parent().children("td:eq(10)").text();
		direccionsele = $(this).parent().parent().children("td:eq(11)").text();
		perfilsele = $(this).parent().parent().children("td:eq(12)").text();
		escalafonsele = $(this).parent().parent().children("td:eq(13)").text();
		fecha_iniciosele = $(this).parent().parent().children("td:eq(14)").text();
		tipo_contratosele = $(this).parent().parent().children("td:eq(15)").text();
		//alert(municipio_expedicionsele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_personasele").val(id_personasele);
        $("#identificacionsele").val(identificacionsele);
        $("#tipo_idsele").val(tipo_idsele);
        $("#nombressele").val(nombressele);
        $("#apellido1sele").val(apellido1sele);
        $("#apellido2sele").val(apellido2sele);
        $("#sexosele").val(sexosele);
        $("#fecha_nacimientosele").val(fecha_nacimientosele);
        $("#telefonosele").val(telefonosele);
        $("#correosele").val(correosele);
        $("#direccionsele").val(direccionsele);
        $("#perfilsele").val(perfilsele);
        $("#escalafonsele").val(escalafonsele);
        $("#fecha_iniciosele").val(fecha_iniciosele);
        $("#tipo_contratosele").val(tipo_contratosele);
        //desbloquear_cajas_texto();

	});

	
   $("#btn_actualizar_profesor").click(function(event){

    	if($("#form_profesores_actualizar").valid()==true){
       		actualizar_profesor();
       	
        }
        else{
			alert("formulario incorrecto");
			alert($("#form_profesores_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
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

			perfil:{
				required: true,
				maxlength: 40	

			},

			escalafon:{
				required: true,
				maxlength: 50	

			},

			fecha_inicio:{
				required: true,
				date: true

			},

			tipo_contrato:{
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

			perfil:{
				required: true,
				maxlength: 40	

			},

			escalafon:{
				required: true,
				maxlength: 50	

			},

			fecha_inicio:{
				required: true,
				date: true

			},

			tipo_contrato:{
				required: true,
				maxlength: 50

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
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
				for (var i = 0; i < registros.profesores.length; i++) {
					html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.profesores[i].id_persona+"</td><td>"+registros.profesores[i].identificacion+"</td><td style='display:none'>"+registros.profesores[i].tipo_id+"</td><td>"+registros.profesores[i].nombres+"</td><td>"+registros.profesores[i].apellido1+"</td><td>"+registros.profesores[i].apellido2+"</td><td>"+registros.profesores[i].sexo+"</td><td>"+registros.profesores[i].fecha_nacimiento+"</td><td>"+registros.profesores[i].telefono+"</td><td>"+registros.profesores[i].email+"</td><td>"+registros.profesores[i].direccion+"</td><td style='display:none'>"+registros.profesores[i].perfil+"</td><td style='display:none'>"+registros.profesores[i].escalafon+"</td><td style='display:none'>"+registros.profesores[i].fecha_inicio+"</td><td style='display:none'>"+registros.profesores[i].tipo_contrato+"</td><td><a class='btn btn-success' href="+registros.profesores[i].id_persona+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.profesores[i].id_persona+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				
				$("#lista_profesores tbody").html(html);

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
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_profesores_actualizar")[0].reset();

				mostrarprofesores("",1,5);

		}


	});

}