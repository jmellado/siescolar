$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosNF($("#jornadaNF").val());


	$("#btn_consultar_NF").click(function(event){

    	if($("#form_notas_finales").valid()==true){

    		jornada = $("#jornadaNF").val();
    		id_curso = $("#id_cursoNF").val();
            id_estudiante = $("#id_estudianteNF").val();

    		$("#lista_notasfinales tbody").html("");
    		ocultardiv_notasfinales();
    		mostrarnotasfinales("",1,5,jornada,id_curso,id_estudiante);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#jornadaNF").change(function(){
    	ocultardiv_notasfinales();

    	jornada = $("#jornadaNF").val();
    	llenarcombo_cursosNF(jornada);
    });

    $("#id_cursoNF").change(function(){
    	ocultardiv_notasfinales();

        id_curso = $("#id_cursoNF").val();
        llenarcombo_estudiantesNF(id_curso);
    });


    $("#form_notas_finales").validate({

    	rules:{


			jornada:{
				required: true,
				maxlength: 30,

			},

            id_curso:{
                required: true


            },

            id_estudiante:{
                required: true


            },


		}


	});





}


function llenarcombo_cursosNF(jornada){

    $.ajax({
        url:base_url+"notas_finales_controller/llenarcombo_cursosNF",
        type:"post",
        data:{jornada:jornada},
        success:function(respuesta) {
                //toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
                var registros = eval(respuesta);

                html = "<option value=''></option>";
                for (var i = 0; i < registros.length; i++) {
                    
                    html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
                    
                };
                
                $("#cursos_notasfinales1 select").html(html);
        }

    });

}


function llenarcombo_estudiantesNF(id_curso){

    $.ajax({
        url:base_url+"notas_finales_controller/llenarcombo_estudiantesNF",
        type:"post",
        data:{id_curso:id_curso},
        success:function(respuesta) {
                //toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
                var registros = eval(respuesta);

                html = "<option value=''></option>";
                for (var i = 0; i < registros.length; i++) {
                    
                    html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
                    
                };
                
                $("#estudiantes_notasfinales1 select").html(html);
        }

    });

}


function mostrarnotasfinales(valor,pagina,cantidad,jornada,id_curso,id_estudiante){

    $.ajax({
        url:base_url+"notas_finales_controller/mostrarnotasfinales",
        type:"post",
        data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,jornada:jornada,id_curso:id_curso,id_estudiante:id_estudiante},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                
                registros = JSON.parse(respuesta);

                html ="";

                if (registros.notas.length > 0) {

                    for (var i = 0; i < registros.notas.length; i++) {
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.notas[i].id_nota+"</td><td style='display:none'>"+registros.notas[i].id_asignatura+"</td><td width='200'>"+registros.notas[i].nombre_asignatura+"</td><td width='40' style='text-align:center'>"+registros.notas[i].p1+"</td><td width='40' style='text-align:center'>"+registros.notas[i].p2+"</td><td width='40' style='text-align:center'>"+registros.notas[i].p3+"</td><td width='40' style='text-align:center'>"+registros.notas[i].p4+"</td><td width='80' style='text-align:center'>"+registros.notas[i].nota_final+"</td><td style='display:none'>"+registros.notas[i].id_desempeno+"</td><td width='80' style='text-align:center'>"+registros.notas[i].nombre_desempeno+"</td><td width='80' style='text-align:center'>"+registros.notas[i].fallas+"</td></tr>";
                    };
                    
                    $("#lista_notasfinales tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='9'><p style='text-align:center'>No Hay Asignaturas Registradas..</p></td></tr>";
                    $("#lista_notasfinales tbody").html(html);
                }

                mostrardiv_notasfinales();

            }

    });

}


function mostrardiv_notasfinales(){

    div = document.getElementById('div-notasfinales');
    div.style.display = '';

}

function ocultardiv_notasfinales(){

    div = document.getElementById('div-notasfinales');
    div.style.display = 'none';
}