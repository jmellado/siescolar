$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_persona = $("#id_persona").val();
	mostrarcargas_academicas("",1,5,id_persona);


    /*$("#btn_buscar_cargas_academicas").click(function(event){
		
       mostrarcargas_academicas("",1,5,id_persona);
    });

    $("#buscar_cargas_academicas").keyup(function(event){

    	buscar = $("#buscar_cargas_academicas").val();
		valorcantidad = $("#cantidad_cargas_academicas").val();
		mostrarcargas_academicas(buscar,1,valorcantidad,id_persona);
		
    });*/

    $("#cantidad_cargas_academicas").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_cargas_academicas").val();
    	mostrarcargas_academicas(buscar,1,valorcantidad,id_persona);
    });

    $("body").on("click", ".paginacion_cargas_academicas li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	buscar = $("#buscar_cargas_academicas").val();
    	valorcantidad = $("#cantidad_cargas_academicas").val();

    	if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
    		
			mostrarcargas_academicas(buscar,numero_pagina,valorcantidad,id_persona);
		}	


    });



}


function mostrarcargas_academicas(valor,pagina,cantidad,id_persona){

	$.ajax({
		url:base_url+"cargas_academicas_controller/mostrarcargas_academicasprofesor",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_persona:id_persona},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				var total_h = document.getElementById('total_horas');
				total_horas = 0;

				html ="";

				if (registros.cargas_academicas.length > 0) {

					for (var i = 0; i < registros.cargas_academicas.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_carga_academica+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_profesor+"</td><td style='display:none'>"+registros.cargas_academicas[i].nombres+" "+registros.cargas_academicas[i].apellido1+" "+registros.cargas_academicas[i].apellido2+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_curso+"</td><td>"+registros.cargas_academicas[i].nombre_grado+" "+registros.cargas_academicas[i].nombre_grupo+" "+registros.cargas_academicas[i].jornada+"</td><td style='display:none'>"+registros.cargas_academicas[i].id_asignatura+"</td><td>"+registros.cargas_academicas[i].nombre_asignatura+"</td><td>"+registros.cargas_academicas[i].intensidad_horaria+"</td><td style='display:none'>"+registros.cargas_academicas[i].ano_lectivo+"</td><td>"+registros.cargas_academicas[i].nombre_ano_lectivo+"</td><td style='display:none'><a class='btn btn-success' href="+registros.cargas_academicas[i].id_carga_academica+"><i class='fa fa-edit'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.cargas_academicas[i].id_carga_academica+"><i class='fa fa-trash'></i></button></td></tr>";
						total_horas = parseInt(total_horas) + parseInt(registros.cargas_academicas[i].intensidad_horaria);
					};
					
					$("#lista_cargas_academicas tbody").html(html);
					$("#th").show();
					total_h.innerHTML = total_horas;

				}else{

					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Datos Disponibles..</p></td></tr>";
					$("#lista_cargas_academicas tbody").html(html);
					$("#th").hide();
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
				$(".paginacion_cargas_academicas").html(paginador);

			}

	});

}
