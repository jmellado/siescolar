$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_persona = $("#id_persona").val();

	mostrarlogros("",1,5,id_persona);
	llenarcombo_grados_profesor(id_persona,null);

	// este metodo permite enviar la inf del formulario
	$("#form_logros").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_logros").valid()==true){

			$.ajax({

				url:$("#form_logros").attr("action"),
				type:$("#form_logros").attr("method"),
				data:$("#form_logros").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						//$("#form_logros")[0].reset();
						$("#descripcion_logro").val("");
						//llenarcombo_grados_profesor($id_persona,null);
						//llenarcombo_asignaturas_profesor("","",null);

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="grado ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarlogros("",1,5,id_persona);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_logro").click(function(){
		
		$("#modal_agregar_logro").modal();
       
    });

    $("#btn_buscar_logro").click(function(event){
	   event.preventDefault();
       mostrarlogros("",1,5,id_persona);
    });

    $("#buscar_logro").keyup(function(event){

    	buscar = $("#buscar_logro").val();
		valorcantidad = $("#cantidad_logro").val();
		mostrarlogros(buscar,1,valorcantidad,id_persona);
		
    });

    $("#cantidad_logro").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_logro").val();
    	mostrarlogros(buscar,1,valorcantidad,id_persona);
    });

    $("body").on("click", ".paginacion_logro li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_logro").val();
    	valorcantidad = $("#cantidad_logro").val();
    	
    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
			
			mostrarlogros(buscar,numero_pagina,valorcantidad,id_persona);
		}

    });

    $("body").on("click","#lista_logros button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("Esta Seguro De Eliminar Este Logro.?")){
			eliminar_logro(idsele);

		}

	});

	$("body").on("click","#lista_logros a",function(event){
		event.preventDefault();
		$("#modal_actualizar_logro").modal();
		id_logrosele = $(this).attr("href");
		nombre_logrosele = $(this).parent().parent().children("td:eq(2)").text();
		descripcion_logrosele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		periodosele = $(this).parent().parent().children("td:eq(4)").text();
		id_personasele = $(this).parent().parent().children("td:eq(5)").text();
		id_gradosele = $(this).parent().parent().children("td:eq(6)").text();
		id_asignaturasele = $(this).parent().parent().children("td:eq(8)").text();
		//ano_lectivosele = $(this).parent().parent().children("td:eq(4)").text();

		llenarcombo_grados_profesor(id_personasele,id_gradosele);
		llenarcombo_asignaturas_profesor(id_personasele,id_gradosele,id_asignaturasele);

		$("#id_logrosele").val(id_logrosele);
        $("#nombre_logrosele").val(nombre_logrosele);
        $("#descripcion_logrosele").val(descripcion_logrosele);
        $("#periodosele").val(periodosele);
        $("#id_personasele").val(id_personasele);
        $("#periodosele").val(periodosele);
        $("#id_grado_logrossele").val(id_gradosele);
        $("#id_asignatura_logrossele").val(id_asignaturasele);
        

	});

	
    $("#btn_actualizar_logro").click(function(event){

    	if($("#form_logros_actualizar").valid()==true){
       	actualizar_logro();
       	//bloquear_cajas_texto();

       }
       else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_logros_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });


    $("#id_grado_logros").change(function(){
    	id_grado = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_asignaturas_profesor(id_persona,id_grado,null);

    });


    $("#id_grado_logrossele").change(function(){
    	id_grado = $(this).val();
    	id_persona = $("#id_personasele").val();
    	llenarcombo_asignaturas_profesor(id_persona,id_grado,null);
    	
    });






	$("#form_logros").validate({

    	rules:{

			descripcion_logro:{
				required: true,
				maxlength: 200
				//lettersonly: true	

			},

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			id_persona:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_asignatura:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			}

		}


	});

	$("#form_logros_actualizar").validate({

    	rules:{

			descripcion_logro:{
				required: true,
				maxlength: 200
				//lettersonly: true	

			},

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			id_persona:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			id_asignatura:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrarlogros(valor,pagina,cantidad,id_persona){

	$.ajax({
		url:base_url+"logros_controller/mostrarlogros_profesor",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.logros.length > 0) {

					for (var i = 0; i < registros.logros.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.logros[i].id_logro+"</td><td>"+registros.logros[i].nombre_logro+"</td><td><textarea class='form-control' cols='80' rows='3' readonly style='resize:none'>"+registros.logros[i].descripcion_logro+"</textarea></td><td>"+registros.logros[i].periodo+"</td><td style='display:none'>"+registros.logros[i].id_profesor+"</td><td style='display:none'>"+registros.logros[i].id_grado+"</td><td>"+registros.logros[i].nombre_grado+"</td><td style='display:none'>"+registros.logros[i].id_asignatura+"</td><td>"+registros.logros[i].nombre_asignatura+"</td><td style='display:none'>"+registros.logros[i].ano_lectivo+"</td><td>"+registros.logros[i].nombre_ano_lectivo+"</td><td><a class='btn btn-success' href="+registros.logros[i].id_logro+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.logros[i].id_logro+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_logros tbody").html(html);
				}
				else{
					html ="<tr><td colspan='9'><p style='text-align:center'>No Hay Logros Registrados..</p></td></tr>";
					$("#lista_logros tbody").html(html);
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
				$(".paginacion_logro").html(paginador);

			}

	});

}


function eliminar_logro(valor){

	$.ajax({
		url:base_url+"logros_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarlogros("",1,5,id_persona);

		}


	});



}

function actualizar_logro(){

	$.ajax({
		url:base_url+"logros_controller/modificar",
		type:"post",
        data:$("#form_logros_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_logro").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_logros_actualizar")[0].reset();

				mostrarlogros("",1,5,id_persona);

		}


	});

}


function llenarcombo_grados_profesor(valor,valor2){

	$.ajax({
		url:base_url+"logros_controller/llenarcombo_grados_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_grado"]==valor2){
						html +="<option value="+registros[i]["id_grado"]+" selected>"+registros[i]["nombre_grado"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
					}
				};
				
				$("#grados_logros1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesor(valor,valor2,valor3){

	$.ajax({
		url:base_url+"logros_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_grado:valor2},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_asignatura"]==valor3){
						html +="<option value="+registros[i]["id_asignatura"]+" selected>"+registros[i]["nombre_asignatura"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					}
				};
				
				$("#asignaturas_logros1 select").html(html);
		}

	});
}
