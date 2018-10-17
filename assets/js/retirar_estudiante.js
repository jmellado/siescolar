$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarretiros("",1,5);
	llenarcombo_cursosRT($("#jornadaRT").val());

	// este metodo permite enviar la inf del formulario
	$("#form_retiros").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_retiros").valid()==true){

			$.ajax({

				url:$("#form_retiros").attr("action"),
				type:$("#form_retiros").attr("method"),
				data:$("#form_retiros").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Estudiante Retirado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_retiros")[0].reset();
						$("#estudiante_retiros1 select").html("");

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Estudiante No Retirado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="retiroyaexiste"){
						
						toastr.warning('El Estudiante Ya Se Encuentra Retirado.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
					mostrarretiros("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
		}

	});


	$("#btn_agregar_retiro").click(function(){

		$("#modal_agregar_retiro").modal();
       
    });


    $("#btn_buscar_retiro").click(function(event){
		
       mostrarretiros("",1,5);
    });

    $("#buscar_retiro").keyup(function(event){

    	buscar = $("#buscar_retiro").val();
		valorcantidad = $("#cantidad_retiro").val();
		mostrarretiros(buscar,1,valorcantidad);
		
    });

    $("#cantidad_retiro").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_retiro").val();
    	mostrarretiros(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_retiro li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_retiro").val();
    	valorcantidad = $("#cantidad_retiro").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarretiros(buscar,numero_pagina,valorcantidad);
		}


    });


    $("body").on("click","#lista_retiros a",function(event){
		event.preventDefault();
		$("#modal_actualizar_retiro").modal();
		id_retirosele = $(this).attr("href");
		cursosele = $(this).parent().parent().children("td:eq(3)").text();
		estudiantesele = $(this).parent().parent().children("td:eq(5)").text();
		observacionessele = $(this).parent().parent().children("td:eq(6)").text();
		fecha_retirosele = $(this).parent().parent().children("td:eq(7)").text();
		jornadasele = $(this).parent().parent().children("td:eq(8)").text();

		$("#id_retirosele").val(id_retirosele);
        $("#cursoseleRT").val(cursosele);
        $("#estudianteseleRT").val(estudiantesele);
        $("#observacionesseleRT").val(observacionessele);
        $("#fecha_retiroseleRT").val(fecha_retirosele);
        $("#jornadaseleRT").val(jornadasele);

	});


    $("#jornadaRT").change(function(){

    	$("#estudiante_retiros1 select").html("");

    	jornada = $(this).val();
    	llenarcombo_cursosRT(jornada);
    });


    $("#id_cursoRT").change(function(){
    	id_curso = $(this).val();
    	llenarcombo_estudiantesRT(id_curso);
    });

    $("#modal_agregar_retiro").on('hidden.bs.modal', function () {
        $("#form_retiros")[0].reset();
        $("#estudiante_retiros1 select").html("");
        var validator = $("#form_retiros").validate();
        validator.resetForm();
    });


    $("#form_retiros").validate({

    	rules:{

			id_curso:{
				required: true,
				maxlength: 15,
				digits: true,
				
			},

			id_estudiante:{
				required: true,
				maxlength: 15,
				digits: true	

			},

			fecha_retiro:{
				required: true,
				date: true	

			},

			observaciones:{
				required: true,
				maxlength: 500

			}
		}


	});



}


function llenarcombo_cursosRT(jornada){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursosRT",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#curso_retiros1 select").html(html);
		}

	});

}


function llenarcombo_estudiantesRT(id_curso){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_estudiantesRT",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					
				};
				
				$("#estudiante_retiros1 select").html(html);
		}

	});

}


function mostrarretiros(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"matriculas_controller/mostrarretiros",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.retiros.length > 0) {

					for (var i = 0; i < registros.retiros.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.retiros[i].id_retiro+"</td><td style='display:none'>"+registros.retiros[i].id_curso+"</td><td>"+registros.retiros[i].nombre_grado+" "+registros.retiros[i].nombre_grupo+" "+registros.retiros[i].jornada+"</td><td style='display:none'>"+registros.retiros[i].id_estudiante+"</td><td>"+registros.retiros[i].nombresest+" "+registros.retiros[i].apellido1est+" "+registros.retiros[i].apellido2est+"</td><td style='display:none'>"+registros.retiros[i].observaciones+"</td><td>"+registros.retiros[i].fecha_retiro+"</td><td style='display:none'>"+registros.retiros[i].jornada+"</td><td style='display:none'>"+registros.retiros[i].ano_lectivo+"</td><td>"+registros.retiros[i].nombre_ano_lectivo+"</td><td><a class='btn btn-success' href="+registros.retiros[i].id_retiro+" title='Ver Retiro'><i class='fa fa-eye'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.retiros[i].id_retiro+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_retiros tbody").html(html);
				}
				else{
					html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Estudiantes Retirados..</p></td></tr>";
					$("#lista_retiros tbody").html(html);
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
				$(".paginacion_retiro").html(paginador);

			}

	});

}




