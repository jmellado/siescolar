$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostraracudientesf("",1,5);


	$("#form_cargar_fotoAC").submit(function (event) {
		
		event.preventDefault();
		var formData = new FormData($("#form_cargar_fotoAC")[0]);

		if($("#form_cargar_fotoAC").valid()==true){

			$.ajax({

				url:$("#form_cargar_fotoAC").attr("action"),
				type:$("#form_cargar_fotoAC").attr("method"),
				data:formData,
				cache:false,
				contentType:false,
				processData:false,   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Fotografia Registrada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						actualizar_fotografia_acudiente();
						$("#form_cargar_fotoAC")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Fotografia No Registrada.', 'Success Alert', {timeOut: 3000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
					
					$("#modal_cargar_fotoAC").modal('hide');
						
						
				}

			});

		}else{

			toastr.warning('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_buscar_acudientef").click(function(event){
		
       	buscar = $("#buscar_acudientef").val();
		valorcantidad = $("#cantidad_acudientef").val();
		mostraracudientesf(buscar,1,valorcantidad);

    });

    $("#buscar_acudientef").keyup(function(event){

    	buscar = $("#buscar_acudientef").val();
		valorcantidad = $("#cantidad_acudientef").val();
		mostraracudientesf(buscar,1,valorcantidad);
		
    });

    $("#cantidad_acudientef").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_acudientef").val();
    	mostraracudientesf(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_acudientef li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_acudientef").val();
    	valorcantidad = $("#cantidad_acudientef").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostraracudientesf(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_acudientesf a",function(event){
		event.preventDefault();
		$("#modal_cargar_fotoAC").modal();
		id_personasele = $(this).attr("href");
		identificacionsele = $(this).parent().parent().children("td:eq(3)").text();
		nombressele = $(this).parent().parent().children("td:eq(4)").text();
		apellido1sele = $(this).parent().parent().children("td:eq(5)").text();
		apellido2sele = $(this).parent().parent().children("td:eq(6)").text();
		
		$("#id_personasele").val(id_personasele);
        $("#nombressele").val(nombressele);
        $("#identificacionsele").val(identificacionsele);
        $("#apellido1sele").val(apellido1sele);
        $("#apellido2sele").val(apellido2sele);

        $("#nombre_acudientesele").val(nombressele+" "+apellido1sele+" "+apellido2sele);

	});

	$("#modal_cargar_fotoAC").on('hidden.bs.modal', function () {
        $("#form_cargar_fotoAC")[0].reset();
        var validator = $("#form_cargar_fotoAC").validate();
        validator.resetForm();
    });


	$("#form_cargar_fotoAC").validate({

    	rules:{

    		id_persona:{
				required: true

			},

			foto_acudiente:{
				required: true

			}

		}

	});


}


function mostraracudientesf(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"fotografias_controller/mostraracudientes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.acudientes.length > 0) {

					for (var i = 0; i < registros.acudientes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.acudientes[i].id_persona+"</td><td><img src='"+base_url+"uploads/imagenes/fotos/"+registros.acudientes[i].id_persona+".jpg?"+Date.now()+"' id='"+registros.acudientes[i].id_persona+"' alt='Foto Acudiente' class='img-responsive' style='width: 110px; height: 140px; text-align: center;'/></td><td>"+registros.acudientes[i].identificacion+"</td><td>"+registros.acudientes[i].nombres+"</td><td>"+registros.acudientes[i].apellido1+"</td><td>"+registros.acudientes[i].apellido2+"</td><td>"+registros.acudientes[i].telefono+"</td><td><a class='btn btn-success' href="+registros.acudientes[i].id_persona+" title='Cargar Fotografia'><i class='fa fa-upload'></i></a></td></tr>";
					};
					
					$("#lista_acudientesf tbody").html(html);
				}
				else{
					html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Acudientes Registrados..</p></td></tr>";
					$("#lista_acudientesf tbody").html(html);
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
				$(".paginacion_acudientef").html(paginador);

			}

	});

}

//Esta funcion permite actualizar la url de la foto de una persona
//añadiendo ?Date.now(), con el fin de hacerle creer a la cache del navegador que es una nueva foto
function actualizar_fotografia_acudiente(){

	idfoto = $("#id_personasele").val();

	var img=document.getElementById(idfoto);
	img.src="";
	img.src=base_url+"uploads/imagenes/fotos/"+idfoto+".jpg?"+Date.now();

}