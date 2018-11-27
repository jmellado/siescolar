$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosSA($("#jornadaSA").val());


	$("#btn_consultar_SA").click(function(event){

    	if($("#form_situacionacademica").valid()==true){

    		jornada = $("#jornadaSA").val();
    		id_curso = $("#id_cursoSA").val();

    		$("#lista_situacionacademica tbody").html("");
    		mostrardiv_situacionacademica();
    		mostrarsituacionacademica("",1,5,jornada,id_curso);

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#jornadaSA").change(function(){
    	ocultardiv_situacionacademica();

    	jornada = $("#jornadaSA").val();
    	llenarcombo_cursosSA(jornada);
    });

    $("#id_cursoSA").change(function(){
    	ocultardiv_situacionacademica();
    });


    $("#form_situacionacademica").validate({

    	rules:{


			id_curso:{
				required: true,
				maxlength: 15	

			},

			jornada:{
				required: true,
				maxlength: 30,

			}


		}


	});





}


function llenarcombo_cursosSA(jornada){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursosSA",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_situacion1 select").html(html);
		}

	});

}


function mostrarsituacionacademica(valor,pagina,cantidad,jornada,id_curso){

	$.ajax({
		url:base_url+"matriculas_controller/mostrarsituacionacademica",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,jornada:jornada,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.situacion.length > 0) {

					for (var i = 0; i < registros.situacion.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.situacion[i].id_persona+"</td><td>"+registros.situacion[i].identificacion+"</td><td>"+registros.situacion[i].apellido1+" "+registros.situacion[i].apellido2+" "+registros.situacion[i].nombres+"</td><td style='display:none'>"+registros.situacion[i].id_curso+"</td><td>"+registros.situacion[i].nombre_grado+" "+registros.situacion[i].nombre_grupo+" "+registros.situacion[i].jornada+"</td><td style='text-align: center;'>"+registros.situacion[i].asig_reprobadas+"</td><td style='text-align: center;'>"+registros.situacion[i].total_fallas+"</td><td>"+registros.situacion[i].estado_matricula+"</td></tr>";
					};
					
					$("#lista_situacionacademica tbody").html(html);
				}
				else{
					html ="<tr><td colspan='7'><p style='text-align:center'>No Hay Estudiantes Matriculados..</p></td></tr>";
					$("#lista_situacionacademica tbody").html(html);
				}	

			}

	});

}


function mostrardiv_situacionacademica(){

	div = document.getElementById('div-situacionacademica');
    div.style.display = '';

}

function ocultardiv_situacionacademica(){

	div = document.getElementById('div-situacionacademica');
    div.style.display = 'none';
}