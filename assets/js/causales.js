$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrarcausales("",1,5);
	llenarcombo_tipos_causales();

	// este metodo permite enviar la inf del formulario
	$("#form_causales").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_causales").valid()==true){

			$.ajax({

				url:$("#form_causales").attr("action"),
				type:$("#form_causales").attr("method"),
				data:$("#form_causales").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Causal Registrada Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
						$("#form_causales")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Causal No Registrada.', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="causalyaexiste"){
						
						toastr.warning('Causal Ya Registrada.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					mostrarcausales("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_causal").click(function(){

		$("#modal_agregar_causal").modal();
       
    });

    $("#btn_buscar_causal").click(function(event){
		
       mostrarcausales("",1,5);
    });

    $("#buscar_causal").keyup(function(event){

    	buscar = $("#buscar_causal").val();
		valorcantidad = $("#cantidad_causal").val();
		mostrarcausales(buscar,1,valorcantidad);
		
    });

    $("#cantidad_causal").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_causal").val();
    	mostrarcausales(buscar,1,valorcantidad);
    });

    $("body").on("click", ".paginacion_causal li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_causal").val();
    	valorcantidad = $("#cantidad_causal").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrarcausales(buscar,numero_pagina,valorcantidad);
		}


    });

    $("body").on("click","#lista_causales button",function(event){
		event.preventDefault();
		idsele = $(this).attr("value");
		
		if(confirm("Esta Seguro De Eliminar Esta Causal.?")){
			eliminar_causal(idsele);

		}

	});

	$("body").on("click","#lista_causales a",function(event){
		event.preventDefault();
		$("#modal_actualizar_causal").modal();
		id_causalsele = $(this).attr("href");
		causalsele = $(this).parent().parent().children("td:eq(2)").text();
		id_tipo_causalsele = $(this).parent().parent().children("td:eq(3)").text();

		$("#id_causalsele").val(id_causalsele);
		$("#causalsele").val(causalsele);
        $("#id_tipo_causalsele").val(id_tipo_causalsele);
	});


	$("#btn_actualizar_causal").click(function(event){

    	if($("#form_causales_actualizar").valid()==true){
       		actualizar_causal();
      	}
       	else{
			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
		}
       
    });


    $("#modal_agregar_causal").on('hidden.bs.modal', function () {
        $("#form_causales")[0].reset();
        $("#form_causales").valid()==true;
    });


    $("#modal_actualizar_causal").on('hidden.bs.modal', function () {
        $("#form_causales_actualizar")[0].reset();
        $("#form_causales_actualizar").valid()==true;
    });


    $("#form_causales").validate({

    	rules:{

    		causal:{
				required: true,
				maxlength: 500

			},

			id_tipo_causal:{
				required: true

			}

		}


	});

	$("#form_causales_actualizar").validate({

    	rules:{

    		causal:{
				required: true,
				maxlength: 500

			},

			id_tipo_causal:{
				required: true	

			}

		}


	});


}


function mostrarcausales(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"causales_controller/mostrarcausales",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.causales.length > 0) {

					for (var i = 0; i < registros.causales.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.causales[i].id_causal+"</td><td><textarea class='form-control' cols='40' rows='2' readonly style='resize:none'>"+registros.causales[i].causal+"</textarea></td><td style='display:none'>"+registros.causales[i].id_tipo_causal+"</td><td>"+registros.causales[i].tipo_causal+"</td><td><a class='btn btn-success' href="+registros.causales[i].id_causal+"><i class='fa fa-edit'></i></a></td><td><button type='button' class='btn btn-danger' value="+registros.causales[i].id_causal+"><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_causales tbody").html(html);
				}
				else{
					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Causales Registradas..</p></td></tr>";
					$("#lista_causales tbody").html(html);
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
				$(".paginacion_causal").html(paginador);

			}

	});

}


function actualizar_causal(){

	$.ajax({
		url:base_url+"causales_controller/modificar_causal",
		type:"post",
        data:$("#form_causales_actualizar").serialize(),
		success:function(respuesta) {
				
				//alert(respuesta);
				$("#modal_actualizar_causal").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Causal Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Causal No Actualizada.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="causalyaexiste"){
					
					toastr.warning('Causal Ya Registrada.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="causalenseguimientos"){
					
					toastr.warning('No Se Puede Modificar Esta Causal; Actualmente Se Encuentra Asociada A Un Seguimiento.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_causales_actualizar")[0].reset();

				mostrarcausales("",1,5);

		}


	});

}


function eliminar_causal(valor){

	$.ajax({
		url:base_url+"causales_controller/eliminar_causal",
		type:"post",
        data:{id:valor},
		success:function(respuesta) {
				
				
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				mostrarcausales("",1,5);

		}


	});

}


function llenarcombo_tipos_causales(){

	$.ajax({
		url:base_url+"causales_controller/llenarcombo_tipos_causales",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_tipo_causal"]+">"+registros[i]["tipo_causal"]+"</option>";
					
				};
				
				$("#tipocausal1 select").html(html);
		}

	});
}