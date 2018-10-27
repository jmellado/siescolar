$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

    id_acudiente = $("#id_persona").val();
	llenarcombo_acudidosNA(id_acudiente);


	$("#btn_consultar_NA").click(function(event){

    	if($("#form_consultar_notasA").valid()==true){

    		periodo = $("#periodoNA").val();
    		id_acudido = $("#id_acudidoNA").val();

    		$("#lista_asignaturasNA tbody").html("");
    		mostrardiv_consultarnotasA();
    		mostrarasignaturasNA("",1,5,periodo,id_acudido);

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#periodoNA").change(function(){
    	ocultardiv_consultarnotasA();
    });

    $("#id_acudidoNA").change(function(){
    	ocultardiv_consultarnotasA();
    });


    $("#form_consultar_notasA").validate({

    	rules:{

			periodo:{
				required: true,
				maxlength: 8

			},

            id_acudido:{
                required: true,
                maxlength: 15   

            }


		}


	});


    $("body").on("click","#lista_asignaturasNA button",function(event){
        event.preventDefault();
        $("#modal_ver_actividades").modal();
        periodosele = $("#periodoNA").val();

        id_asignaturasele = $(this).attr("value");
        id_estudiantesele = $(this).parent().parent().children("td:eq(1)").text();
        id_cursosele = $(this).parent().parent().children("td:eq(2)").text();
        nombreasignaturasele = $(this).parent().parent().children("td:eq(4)").text();
       
        mostraractividadesNA("",1,5,id_cursosele,id_asignaturasele,periodosele,id_estudiantesele);

    });





}



function llenarcombo_acudidosNA(id_acudiente){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_acudidos",
        type:"post",
        data:{id_acudiente:id_acudiente},
        success:function(respuesta) {
               
                var registros = eval(respuesta);

                html = "<option value=''></option>";

                if (registros.length > 0) {

                    for (var i = 0; i < registros.length; i++) {
                        
                        html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
                    };
                    
                    $("#acudidos_notasA1 select").html(html);
                }
                else{
                    $("#acudidos_notasA1 select").html(html);
                    toastr.warning('No Tiene Acudidos.', 'Success Alert', {timeOut: 3000});
                }
        }

    });
}


function mostrarasignaturasNA(valor,pagina,cantidad,periodo,id_acudiente){

    $.ajax({
        url:base_url+"consultas_controller/mostrarasignaturasNA",
        type:"post",
        data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,periodo:periodo,id_acudiente:id_acudiente},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                //------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
                registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

                html ="";

                if (registros.asignaturas.length > 0) {

                    for (var i = 0; i < registros.asignaturas.length; i++) {
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.asignaturas[i].id_estudiante+"</td><td style='display:none'>"+registros.asignaturas[i].id_curso+"</td><td style='display:none'>"+registros.asignaturas[i].id_asignatura+"</td><td>"+registros.asignaturas[i].nombre_asignatura+"</td><td><button type='button' class='btn btn-warning' value="+registros.asignaturas[i].id_asignatura+" title='Ver Notas Por Actividades'><i class='fa fa-eye'></i></button></tr>";
                    };
                    
                    $("#lista_asignaturasNA tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Asignaturas Matriculadas..</p></td></tr>";
                    $("#lista_asignaturasNA tbody").html(html);
                }   

            }

    });

}


function mostraractividadesNA(valor,pagina,cantidad,id_curso,id_asignatura,periodo,id_estudiante){

    $.ajax({
        url:base_url+"consultas_controller/mostraractividadesNA",
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
                    
                    $("#lista_actividadesNA tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Actividades Registradas..</p></td></tr>";
                    $("#lista_actividadesNA tbody").html(html);
                }

            }

    });

}




function mostrardiv_consultarnotasA(){

    div = document.getElementById('div-consultarnotasA');
    div.style.display = '';

}

function ocultardiv_consultarnotasA(){

    div = document.getElementById('div-consultarnotasA');
    div.style.display = 'none';
}