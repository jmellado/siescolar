$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarprofesoresf("",1,5);


	$("#form_cargar_fotoP").submit(function (event) {
		
		event.preventDefault();
		var formData = new FormData($("#form_cargar_fotoP")[0]);

		if($("#form_cargar_fotoP").valid()==true){

			$.ajax({

				url:$("#form_cargar_fotoP").attr("action"),
				type:$("#form_cargar_fotoP").attr("method"),
				data:formData,
				cache:false,
				contentType:false,
				processData:false,   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Fotografia Registrada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						actualizar_fotografia_profesor();
						$("#form_cargar_fotoP")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Fotografia No Registrada.', 'Success Alert', {timeOut: 3000});
						

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
					
					$("#modal_cargar_fotoP").modal('hide');
						
						
				}

			});

		}else{

			toastr.warning('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#btn_buscar_profesorf").click(function(event){
		
       	buscar = $("#buscar_profesorf").val();
		valorcantidad = $("#cantidad_profesorf").val();
		mostrarprofesoresf(buscar,1,valorcantidad);

    });

    $("#buscar_profesorf").keyup(function(event){

    	buscar = $("#buscar_profesorf").val();
		valorcantidad = $("#cantidad_profesorf").val();
		mostrarprofesoresf(buscar,1,valorcantidad);
		
    });

    $("#cantidad_profesorf").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_profesorf").val();
    	mostrarprofesoresf(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_profesorf li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_profesorf").val();
    	valorcantidad = $("#cantidad_profesorf").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarprofesoresf(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_profesoresf a",function(event){
		event.preventDefault();
		$("#modal_cargar_fotoP").modal();
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

        $("#nombre_profesorsele").val(nombressele+" "+apellido1sele+" "+apellido2sele);

	});

	$("#modal_cargar_fotoP").on('hidden.bs.modal', function () {
        $("#form_cargar_fotoP")[0].reset();
        var validator = $("#form_cargar_fotoP").validate();
        validator.resetForm();
    });


	$("#form_cargar_fotoP").validate({

    	rules:{

    		id_persona:{
				required: true

			},

			foto_estudiante:{
				required: true

			}

		}

	});


}


function mostrarprofesoresf(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"fotografias_controller/mostrarprofesores",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.profesores.length > 0) {

					for (var i = 0; i < registros.profesores.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.profesores[i].id_persona+"</td><td><img src='"+base_url+"uploads/imagenes/fotos/"+registros.profesores[i].id_persona+".jpg?"+Date.now()+"' id='"+registros.profesores[i].id_persona+"' alt='Foto Profesor' class='img-responsive' style='width: 110px; height: 140px; text-align: center;'/></td><td>"+registros.profesores[i].identificacion+"</td><td>"+registros.profesores[i].nombres+"</td><td>"+registros.profesores[i].apellido1+"</td><td>"+registros.profesores[i].apellido2+"</td><td>"+registros.profesores[i].sexo+"</td><td><a class='btn btn-success' href="+registros.profesores[i].id_persona+" title='Cargar Fotografia'><i class='fa fa-upload'></i></a></td></tr>";
					};
					
					$("#lista_profesoresf tbody").html(html);
				}
				else{
					html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Profesores Registrados..</p></td></tr>";
					$("#lista_profesoresf tbody").html(html);
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
				$(".paginacion_profesorf").html(paginador);

			}

	});

}

//Esta funcion permite actualizar la url de la foto de una persona
//añadiendo ?Date.now(), con el fin de hacerle creer a la cache del navegador que es una nueva foto
function actualizar_fotografia_profesor(){

	idfoto = $("#id_personasele").val();

	var img=document.getElementById(idfoto);
	img.src="";
	img.src=base_url+"uploads/imagenes/fotos/"+idfoto+".jpg?"+Date.now();

}