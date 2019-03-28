$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosNP($("#jornadaNP").val());


	$("#btn_consultar_NP").click(function(event){

    	if($("#form_notas_progreso").valid()==true){

    		jornada = $("#jornadaNP").val();
    		id_curso = $("#id_cursoNP").val();
            periodo = $("#periodoNP").val();

    		$("#lista_notasprogreso tbody").html("");
    		ocultardiv_notasprogreso();
    		mostrarnotasprogreso("",1,5,jornada,id_curso,periodo);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#jornadaNP").change(function(){
    	ocultardiv_notasprogreso();
        $("#lista_notasprogreso tbody").html("");

    	jornada = $("#jornadaNP").val();
    	llenarcombo_cursosNP(jornada);
    });

    $("#id_cursoNP").change(function(){
    	ocultardiv_notasprogreso();
        $("#lista_notasprogreso tbody").html("");
    });

    $("#periodoNP").change(function(){
        ocultardiv_notasprogreso();
        $("#lista_notasprogreso tbody").html("");
    });



    $("#form_notas_progreso").validate({

    	rules:{


			jornada:{
				required: true,
				maxlength: 30,

			},

            id_curso:{
                required: true


            },

            periodo:{
                required: true,
                maxlength: 8

            },


		}


	});





}


function llenarcombo_cursosNP(jornada){

    $.ajax({
        url:base_url+"notas_progreso_controller/llenarcombo_cursosNP",
        type:"post",
        data:{jornada:jornada},
        success:function(respuesta) {
                //toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
                var registros = eval(respuesta);

                html = "<option value=''></option>";
                for (var i = 0; i < registros.length; i++) {
                    
                    html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
                    
                };
                
                $("#cursos_notasprogreso1 select").html(html);
        }

    });

}


function mostrarnotasprogreso(valor,pagina,cantidad,jornada,id_curso,periodo){

    $.ajax({
        url:base_url+"notas_progreso_controller/mostrarnotasprogreso",
        type:"post",
        data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,jornada:jornada,id_curso:id_curso,periodo:periodo},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});

                if(respuesta==="nohayestudiantes"){
                    
                    toastr.warning('No Existen Estudiantes Matriculados En El Curso Seleccionado.', 'Success Alert', {timeOut: 3000});

                }
                else{
                
                    registros = JSON.parse(respuesta);

                    html ="";

                    if (registros.notas.length > 0) {

                        for (var i = 0; i < registros.notas.length; i++) {
                            html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.notas[i].id_asignatura+"</td><td width='200'>"+registros.notas[i].nombre_asignatura+"</td><td width='80' style='text-align:center'>"+registros.notas[i].progreso+"%</td></tr>";
                        };
                        
                        $("#lista_notasprogreso tbody").html(html);
                    }
                    else{
                        html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Asignaturas Registradas..</p></td></tr>";
                        $("#lista_notasprogreso tbody").html(html);
                    }

                    mostrardiv_notasprogreso();

                }

            }

    });

}


function mostrardiv_notasprogreso(){

    div = document.getElementById('div-notasprogreso');
    div.style.display = '';

}

function ocultardiv_notasprogreso(){

    div = document.getElementById('div-notasprogreso');
    div.style.display = 'none';
}