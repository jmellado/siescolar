$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	$("#btn_consultar_NE").click(function(event){

    	if($("#form_consultar_notasE").valid()==true){

    		periodo = $("#periodoNA").val();
    		id_estudiante = $("#id_persona").val();

    		$("#lista_asignaturasNE tbody").html("");
    		mostrardiv_consultarnotasE();
    		mostrarasignaturasNE("",1,5,periodo,id_estudiante);

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#periodoNE").change(function(){
    	ocultardiv_consultarnotasE();
    });


    $("#form_consultar_notasE").validate({

    	rules:{

			periodo:{
				required: true,
				maxlength: 8

			}


		}


	});


    $("body").on("click","#lista_asignaturasNE button",function(event){
        event.preventDefault();
        $("#modal_ver_actividades").modal();
        periodosele = $("#periodoNE").val();

        id_asignaturasele = $(this).attr("value");
        id_estudiantesele = $(this).parent().parent().children("td:eq(1)").text();
        id_cursosele = $(this).parent().parent().children("td:eq(2)").text();
        nombreasignaturasele = $(this).parent().parent().children("td:eq(4)").text();
       
        mostraractividadesNE("",1,5,id_cursosele,id_asignaturasele,periodosele,id_estudiantesele);

    });





}



function mostrarasignaturasNE(valor,pagina,cantidad,periodo,id_estudiante){

    $.ajax({
        url:base_url+"consultas_controller/mostrarasignaturasNE",
        type:"post",
        data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,periodo:periodo,id_estudiante:id_estudiante},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                //------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
                registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

                html ="";

                if (registros.asignaturas.length > 0) {

                    for (var i = 0; i < registros.asignaturas.length; i++) {
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.asignaturas[i].id_estudiante+"</td><td style='display:none'>"+registros.asignaturas[i].id_curso+"</td><td style='display:none'>"+registros.asignaturas[i].id_asignatura+"</td><td>"+registros.asignaturas[i].nombre_asignatura+"</td><td><button type='button' class='btn btn-warning' value="+registros.asignaturas[i].id_asignatura+" title='Ver Notas Por Actividades'><i class='fa fa-eye'></i></button></tr>";
                    };
                    
                    $("#lista_asignaturasNE tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Asignaturas Matriculadas..</p></td></tr>";
                    $("#lista_asignaturasNE tbody").html(html);
                }   

            }

    });

}


function mostraractividadesNE(valor,pagina,cantidad,id_curso,id_asignatura,periodo,id_estudiante){

    $.ajax({
        url:base_url+"consultas_controller/mostraractividadesNE",
        type:"post",
        data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso,id_asignatura:id_asignatura,periodo:periodo,id_estudiante:id_estudiante},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                //------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
                
                registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

                html ="";

                if (registros.notas.length > 0) {

                    for (var i = 0; i < registros.notas.length; i++) {
                        
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.notas[i].id_persona+"</td><td style='display:none'>"+registros.notas[i].identificacion+"</td><td style='display:none'>"+registros.notas[i].nombres+" "+registros.notas[i].apellido1+" "+registros.notas[i].apellido2+"</td><td><textarea class='form-control' cols='30' rows='2' readonly style='resize:none'>"+registros.notas[i].descripcion_actividad+"</textarea></td><td align='center'>"+registros.notas[i].nota+"</td></tr>";
                    };
                    
                    $("#lista_actividadesNE tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Actividades Registradas..</p></td></tr>";
                    $("#lista_actividadesNE tbody").html(html);
                }

            }

    });

}




function mostrardiv_consultarnotasE(){

    div = document.getElementById('div-consultarnotasE');
    div.style.display = '';

}

function ocultardiv_consultarnotasE(){

    div = document.getElementById('div-consultarnotasE');
    div.style.display = 'none';
}