$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarsalones("",1,5);
	//llenarcombo_anos_lectivos();

	// este metodo permite enviar la inf del formulario
	$("#form_salones").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_salones").valid()==true){

			$.ajax({

				url:$("#form_salones").attr("action"),
				type:$("#form_salones").attr("method"),
				data:$("#form_salones").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_salones")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="salon ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarsalones("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_salon").click(function(){

		$("#modal_agregar_salon").modal();
       
    });

    $("#btn_buscar_salon").click(function(event){
		
       mostrarsalones("",1,5);
    });

    $("#buscar_salon").keyup(function(event){

    	buscar = $("#buscar_salon").val();
		valorcantidad = $("#cantidad_salon").val();
		mostrarsalones(buscar,1,valorcantidad);
		
    });

    $("#cantidad_salon").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_salon").val();
    	mostrarsalones(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_salon li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_salon").val();
    	valorcantidad = $("#cantidad_salon").val();
		mostrarsalones(buscar,numero_pagina,valorcantidad);


    });

    $("body").on("click","#lista_salones button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		//alert("boton eliminar"+idsele);
		if(confirm("esta seguro de eliminar el registro?")){
			eliminar_salon(idsele);

		}

	});

	$("body").on("click","#lista_salones a",function(event){
		event.preventDefault();
		$("#modal_actualizar_salon").modal();
		id_salonsele = $(this).attr("href");
		nombre_salonsele = $(this).parent().parent().children("td:eq(1)").text();
		observacionsele = $(this).parent().parent().children("td:eq(2)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		cupo_maximosele = $(this).parent().parent().children("td:eq(3)").text();
		ano_lectivosele = $(this).parent().parent().children("td:eq(4)").text();
		estado_salonsele = $(this).parent().parent().children("td:eq(6)").text();
		
		//alert(municipio_expedicionsele);

		//llenarcombo_municipios(departamento_expedicionsele);
		$("#id_salonsele").val(id_salonsele);
        $("#nombre_salonsele").val(nombre_salonsele);
        $("#observacionsele").val(observacionsele);
        $("#cupo_maximosele").val(cupo_maximosele);
        $("#ano_lectivosele").val(ano_lectivosele);
        $("#estado_salonsele").val(estado_salonsele);
        
        //desbloquear_cajas_texto();

	});

	
    $("#btn_actualizar_salon").click(function(event){

    	if($("#form_salones_actualizar").valid()==true){
       	actualizar_salon();
       	//bloquear_cajas_texto();

       }
       else{
			alert("formulario incorrecto");
			alert($("#form_salones_actualizar").validate().numberOfInvalids()+"errores");
		}
		
       
    });






	$("#form_salones").validate({

    	rules:{

			nombre_salon:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			observacion:{
				required: true,
				maxlength: 30,
				//lettersonly: true	

			},

			cupo_maximo:{
				required: true,
				maxlength: 2,
				digits: true

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_salon:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});

	$("#form_salones_actualizar").validate({

    	rules:{

			nombre_salon:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			observacion:{
				required: true,
				maxlength: 30,
				//lettersonly: true	

			},

			cupo_maximo:{
				required: true,
				maxlength: 2,
				digits: true

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_salon:{
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


function mostrarsalones(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"salones_controller/mostrarsalones",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.salones.length; i++) {
					html +="<tr><td>"+registros.salones[i].id_salon+"</td><td>"+registros.salones[i].nombre_salon+"</td><td>"+registros.salones[i].observacion+"</td><td>"+registros.salones[i].cupo_maximo+"</td><td style='display:none'>"+registros.salones[i].ano_lectivo+"</td><td>"+registros.salones[i].nombre_ano_lectivo+"</td><td>"+registros.salones[i].estado_salon+"</td><td><a class='btn btn-success' href="+registros.salones[i].id_salon+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.salones[i].id_salon+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				
				$("#lista_salones tbody").html(html);

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
				$(".paginacion_salon").html(paginador);

			}

	});

}


function eliminar_salon(valor){

	$.ajax({
		url:base_url+"salones_controller/eliminar",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarsalones("",1,5);

		}


	});



}

function actualizar_salon(){

	$.ajax({
		url:base_url+"salones_controller/modificar",
		type:"post",
        data:$("#form_salones_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_salon").modal('hide');
				//toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
				toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				$("#form_salones_actualizar")[0].reset();

				mostrarsalones("",1,5);

		}


	});

}

//------------------------------FUNCIONES PARA LA GESTION SALONES POR GRUPOS--------------------------------------------------------

function inicio2(){

	llenarcombo_salones();
	llenarcombo_grados();
	llenarcombo_grupos();


	$("#btn_agregar_salon_grupo").click(function(){

		$("#modal_agregar_salon_grupo").modal();
       
    });




}

function llenarcombo_salones(){

	$.ajax({
		url:base_url+"salones_grupos_controller/llenarcombo_salones",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_salon"]+">"+registros[i]["nombre_salon"]+"</option>";
				};
				
				$("#salon1 select").html(html);
		}

	});
}

function llenarcombo_grados(){

	$.ajax({
		url:base_url+"salones_grupos_controller/llenarcombo_grados",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
				};
				
				$("#grado1 select").html(html);
		}

	});
}

function llenarcombo_grupos(){

	$.ajax({
		url:base_url+"salones_grupos_controller/llenarcombo_grupos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grupo"]+">"+registros[i]["nombre_grupo"]+"</option>";
				};
				
				$("#grupo1 select").html(html);
		}

	});
}

function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"salones_controller/llenarcombo_anos_lectivos",
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