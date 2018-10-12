$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarusuarios("",1,5);


	$("#form_usuarios").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_usuarios").valid()==true){

			$.ajax({

				url:$("#form_usuarios").attr("action"),
				type:$("#form_usuarios").attr("method"),
				data:$("#form_usuarios").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Usuario Registrado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_usuarios")[0].reset();

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Usuario No Registrado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="usuarioyaexiste"){
						
						toastr.warning('El N° De Identificación Corresponde A Un Usuario Ya Registrado.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					
					mostrarusuarios("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 2000});
			
		}

	});


	$("#btn_agregar_usuario").click(function(){

		$("#modal_agregar_usuario").modal();
       
    });

	$("#btn_buscar_usuario").click(function(event){
		
       mostrarusuarios("",1,5);
    });

    $("#buscar_usuario").keyup(function(event){

    	buscar = $("#buscar_usuario").val();
		valorcantidad = $("#cantidad_usuario").val();
		mostrarusuarios(buscar,1,valorcantidad);
		
    });

    $("#cantidad_usuario").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_usuario").val();
    	mostrarusuarios(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_usuario li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_usuario").val();
    	valorcantidad = $("#cantidad_usuario").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarusuarios(buscar,numero_pagina,valorcantidad);
		}

    });

    $("body").on("click","#lista_usuarios a",function(event){
		event.preventDefault();
		$("#modal_actualizar_usuario").modal();
		id_usuariosele = $(this).attr("href");
		identificacionsele = $(this).parent().parent().children("td:eq(3)").text();
		nombressele = $(this).parent().parent().children("td:eq(4)").text();
		apellidossele = $(this).parent().parent().children("td:eq(5)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		rolsele = $(this).parent().parent().children("td:eq(6)").text();
		estado_usuariosele = $(this).parent().parent().children("td:eq(8)").text();
		
		$("#id_usuariosele").val(id_usuariosele);
		$("#identificacionsele_u").val(identificacionsele);
        $("#nombressele_u").val(nombressele);
        $("#apellidossele_u").val(apellidossele);
        $("#rolsele_u").val(rolsele);
        $("#estado_usuariosele").val(estado_usuariosele);

	});


	$("#btn_actualizar_usuario").click(function(event){

    	if($("#form_usuarios_actualizar").valid()==true){
       		actualizar_usuario();

       	}
       	else{
			toastr.error('Formulario Incorrecto', 'Success Alert', {timeOut: 2000});
		}
		
       
    });


    $("#modal_agregar_usuario").on('hidden.bs.modal', function () {
        $("#form_usuarios")[0].reset();
        $("#form_usuarios").valid()==true;
    });


    $("#form_usuarios").validate({

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

			rol:{
				required: true,
				maxlength: 1	

			}

		}


	});


    $("#form_usuarios_actualizar").validate({

    	rules:{

			id_usuario:{
				required: true,
				digits: true

			},

			estado_usuario:{
				required: true,
				maxlength: 1

			}

		}


	});

}


function mostrarusuarios(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"usuarios_controller/mostrarusuarios",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.usuarios.length > 0) {

					for (var i = 0; i < registros.usuarios.length; i++) {

						if (registros.usuarios[i].acceso == 1) {estado = "Activo"}
						if (registros.usuarios[i].acceso == 0) {estado = "Inactivo"}
							
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.usuarios[i].id_usuario+"</td><td style='display:none'>"+registros.usuarios[i].id_persona+"</td><td>"+registros.usuarios[i].identificacion+"</td><td>"+registros.usuarios[i].nombres+"</td><td>"+registros.usuarios[i].apellido1+" "+registros.usuarios[i].apellido2+"</td><td>"+registros.usuarios[i].nombre_rol+"</td><td>"+registros.usuarios[i].username+"</td><td style='display:none'>"+registros.usuarios[i].acceso+"</td><td>"+estado+"</td><td><a class='btn btn-success' href="+registros.usuarios[i].id_usuario+"><i class='fa fa-edit'></i></a></td></tr>";
					};
					
					$("#lista_usuarios tbody").html(html);
				}
				else{
					html ="<tr><td colspan='8'><p style='text-align:center'>Resultados No Encontrados..</p></td></tr>";
					$("#lista_usuarios tbody").html(html);
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
				$(".paginacion_usuario").html(paginador);

			}

	});

}


function actualizar_usuario(){

	$.ajax({
		url:base_url+"usuarios_controller/modificar",
		type:"post",
        data:$("#form_usuarios_actualizar").serialize(),
		success:function(respuesta) {


				$("#modal_actualizar_usuario").modal('hide');
				if (respuesta==="registroactualizado") {
						
					toastr.success('Usuario Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Usuario No Actualizado.', 'Success Alert', {timeOut: 3000});	

				}
				
				$("#form_usuarios_actualizar")[0].reset();

				mostrarusuarios("",1,5);

		}


	});

}


