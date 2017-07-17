$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrargrupos("",1,5);
	llenarcombo_anos_lectivos();

	// este metodo permite enviar la inf del formulario
	$("#form_grupos").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_grupos").valid()==true){

			$.ajax({

				url:$("#form_grupos").attr("action"),
				type:$("#form_grupos").attr("method"),
				data:$("#form_grupos").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_grupos")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="grupo ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrargrupos("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_grupo").click(function(){

		$("#modal_agregar_grupo").modal();
       
    });

    $("#btn_buscar_grupo").click(function(event){
		
       mostrargrupos("",1,5);
    });

    $("#buscar_grupo").keyup(function(event){

    	buscar = $("#buscar_grupo").val();
		valorcantidad = $("#cantidad_grupo").val();
		mostrargrupos(buscar,1,valorcantidad);
		
    });

    $("#cantidad_grupo").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_grupo").val();
    	mostrargrupos(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_grupo li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_grupo").val();
    	valorcantidad = $("#cantidad_grupo").val();
		mostrargrupos(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_grupos button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_grupo(idsele);

		}

	});

	$("body").on("click","#lista_grupos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_grupo").modal();
		id_gruposele = $(this).attr("href");
		nombre_gruposele = $(this).parent().parent().children("td:eq(1)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(2)").text();
		estado_gruposele = $(this).parent().parent().children("td:eq(4)").text();
		
		//alert(municipio_expedicionsele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_gruposele").val(id_gruposele);
        $("#nombre_gruposele").val(nombre_gruposele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#estado_gruposele").val(estado_gruposele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_grupo").click(function(event){

    	if($("#form_grupos_actualizar").valid()==true){
       	actualizar_grupo();
       	//bloquear_cajas_texto();

       }
       else{
			alert("formulario incorrecto");
			alert($("#form_grupos_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });






	$("#form_grupos, #form_grupos_actualizar").validate({

    	rules:{

			nombre_grupo:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_grupo:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrargrupos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"grupos_controller/mostrargrupos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.grupos.length; i++) {
					html +="<tr><td>"+registros.grupos[i].id_grupo+"</td><td>"+registros.grupos[i].nombre_grupo+"</td><td style='display:none'>"+registros.grupos[i].ano_lectivo+"</td><td>"+registros.grupos[i].nombre_ano_lectivo+"</td><td>"+registros.grupos[i].estado_grupo+"</td><td><a class='btn btn-success' href="+registros.grupos[i].id_grupo+">editar</a></td><td><button type='button' class='btn btn-danger' value="+registros.grupos[i].id_grupo+">eliminar</button></td></tr>";
				};
				
				$("#lista_grupos tbody").html(html);

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
				$(".paginacion_grupo").html(paginador);

			}

	});

}


function eliminar_grupo(valor){

	$.ajax({
		url:base_url+"grupos_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrargrupos("",1,5);

		}


	});



}

function actualizar_grupo(){

	$.ajax({
		url:base_url+"grupos_controller/modificar",
		type:"post",
        data:$("#form_grupos_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_grupo").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_grupos_actualizar")[0].reset();

				mostrargrupos("",1,5);

		}


	});

}

function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"grupos_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivo1 select").html(html);
		}

	});
}