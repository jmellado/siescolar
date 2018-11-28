$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	mostrardocumentos("",1,5);


	$("#btn_buscar_documento").click(function(event){
		
       mostrardocumentos("",1,5);
    });


    $("#buscar_documento").keyup(function(event){

    	buscar = $("#buscar_documento").val();
		valorcantidad = $("#cantidad_documento").val();
		mostrardocumentos(buscar,1,valorcantidad);
		
    });


    $("#cantidad_documento").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_documento").val();
    	mostrardocumentos(buscar,1,valorcantidad);
    });


    $("body").on("click", ".paginacion_documento li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_documento").val();
    	valorcantidad = $("#cantidad_documento").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){

			mostrardocumentos(buscar,numero_pagina,valorcantidad);
		}


    });

}


function mostrardocumentos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"documentos_controller/mostrardocumentos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.documentos.length > 0) {

					for (var i = 0; i < registros.documentos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.documentos[i].id_documento+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.documentos[i].descripcion_documento+"</textarea></td><td style='display:none'>"+registros.documentos[i].nombre_documento+"</td><td>"+registros.documentos[i].fecha_subida+"</td><td><a class='btn btn-warning btn-descargar' href='"+base_url+"uploads/documentos/"+registros.documentos[i].nombre_documento+"' title='Descargar Documento' target='_blank'><i class='fa fa-download'></i></a></td></tr>";
					};
					
					$("#lista_documentos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Documentos Registrados..</p></td></tr>";
					$("#lista_documentos tbody").html(html);
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
				$(".paginacion_documento").html(paginador);

			}

	});

}