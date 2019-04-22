$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

    id_acudiente = $("#id_persona").val();
	llenarcombo_acudidosAA(id_acudiente);


	$("#btn_consultar_asistenciasA").click(function(event){

    	if($("#form_consultar_asistenciasA").valid()==true){

    		periodo = $("#periodoAA").val();
    		id_acudido = $("#id_acudidoAA").val();
            id_asignatura = $("#id_asignaturaAA").val();

    		mostrardiv_consultarasistenciasA();
    		mostrarasistenciasA("",1,5,periodo,id_acudido,id_asignatura);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#periodoAA").change(function(){
    	ocultardiv_consultarasistenciasA();
        $("#lista_asistenciasA tbody").html("");
    });

    $("#id_acudidoAA").change(function(){
    	ocultardiv_consultarasistenciasA();
        $("#lista_asistenciasA tbody").html("");

        id_acudido = $(this).val();
        llenarcombo_asignaturasAA(id_acudido);
    });

    $("#id_asignaturaAA").change(function(){
        ocultardiv_consultarasistenciasA();
        $("#lista_asistenciasA tbody").html("");
    });


    $("#form_consultar_asistenciasA").validate({

    	rules:{

			periodo:{
				required: true,
				maxlength: 8

			},

            id_acudido:{
                required: true,
                digits: true   

            },

            id_asignatura:{
                required: true,
                digits: true    

            }

		}


	});


}



function llenarcombo_acudidosAA(id_acudiente){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_acudidosAA",
        type:"post",
        data:{id_acudiente:id_acudiente},
        success:function(respuesta) {
               
                var registros = eval(respuesta);

                html = "<option value=''></option>";

                if (registros.length > 0) {

                    for (var i = 0; i < registros.length; i++) {
                        
                        html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
                    };
                    
                    $("#acudidos_asistenciasA1 select").html(html);
                }
                else{
                    $("#acudidos_asistenciasA1 select").html(html);
                    toastr.warning('No Tiene Acudidos.', 'Success Alert', {timeOut: 3000});
                }
        }

    });
}


function llenarcombo_asignaturasAA(id_acudido){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_asignaturasAA",
        type:"post",
        data:{id_acudido:id_acudido},
        success:function(respuesta) {

                var registros = eval(respuesta);
            
                html = "<option value=''></option>";
                for (var i = 0; i < registros.length; i++) {

                    html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
                    
                };
                
                $("#asignaturas_asistenciasA1 select").html(html);
        }

    });
}


function mostrarasistenciasA(valor,pagina,cantidad,periodo,id_acudido,id_asignatura){

    $.ajax({
        url:base_url+"consultas_controller/mostrarasistenciasA",
        type:"post",
        data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,periodo:periodo,id_acudido:id_acudido,id_asignatura:id_asignatura},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                //------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
                registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

                html ="";

                if (registros.asistencias.length > 0) {

                    for (var i = 0; i < registros.asistencias.length; i++) {
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.asistencias[i].id_asistencia+"</td><td style='display:none'>"+registros.asistencias[i].id_estudiante+"</td><td style='display:none'>"+registros.asistencias[i].id_curso+"</td><td style='display:none'>"+registros.asistencias[i].id_asignatura+"</td><td>"+registros.asistencias[i].nombre_asignatura+"</td><td style='text-align:center'>"+registros.asistencias[i].asistencia+"</td><td style='text-align:center'>"+registros.asistencias[i].horas+"</td><td style='text-align:center'>"+registros.asistencias[i].fecha+"</td></tr>";
                    };
                    
                    $("#lista_asistenciasA tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Asistencias Registradas..</p></td></tr>";
                    $("#lista_asistenciasA tbody").html(html);
                }   

            }

    });

}


function mostrardiv_consultarasistenciasA(){

    div = document.getElementById('div-consultarasistenciasA');
    div.style.display = '';

}

function ocultardiv_consultarasistenciasA(){

    div = document.getElementById('div-consultarasistenciasA');
    div.style.display = 'none';
}