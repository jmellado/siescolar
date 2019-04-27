$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

    id_acudiente = $("#id_persona").val();
	llenarcombo_acudidosTA(id_acudiente);


	$("#btn_consultar_tareasA").click(function(event){

    	if($("#form_consultar_tareasA").valid()==true){

    		id_acudido = $("#id_acudidoTA").val();
            id_asignatura = $("#id_asignaturaTA").val();

    		mostrardiv_consultartareasA();
    		mostrartareasA("",1,5,id_acudido,id_asignatura);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#id_acudidoTA").change(function(){
    	ocultardiv_consultartareasA();
        $("#lista_tareasA tbody").html("");

        id_acudido = $(this).val();
        llenarcombo_asignaturasTA(id_acudido);
    });

    $("#id_asignaturaTA").change(function(){
        ocultardiv_consultartareasA();
        $("#lista_tareasA tbody").html("");
    });

    $("#buscar_tareaA").keyup(function(event){

        buscar = $(this).val();
        id_acudido = $("#id_acudidoTA").val();
        id_asignatura = $("#id_asignaturaTA").val();
        mostrartareasA(buscar,1,5,id_acudido,id_asignatura);
    });


    $("body").on("click","#lista_tareasA a",function(event){
        event.preventDefault();
        $("#modal_detalle_tareaA").modal();
        id_notificacionsele = $(this).attr("href");
        titulosele = $(this).parent().parent().children("td:eq(4)").text();
        contenidosele = $(this).parent().parent().children("td:eq(5)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
        asignaturasele = $(this).parent().parent().children("td:eq(7)").text();
        fecha_finsele = $(this).parent().parent().children("td:eq(8)").text();
        fecha_enviosele = $(this).parent().parent().children("td:eq(9)").text();

        $("#iid_notificacionsele").val(id_notificacionsele);
        $("#titulosele").val(titulosele);
        $("#contenidosele").val(contenidosele);
        $("#asignaturasele").val(asignaturasele);
        $("#fecha_finsele").val(fecha_finsele);
        $("#fecha_enviosele").val(fecha_enviosele);
        
    });


    $("#form_consultar_tareasA").validate({

    	rules:{

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



function llenarcombo_acudidosTA(id_acudiente){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_acudidosTA",
        type:"post",
        data:{id_acudiente:id_acudiente},
        success:function(respuesta) {
               
                var registros = eval(respuesta);

                html = "<option value=''></option>";

                if (registros.length > 0) {

                    for (var i = 0; i < registros.length; i++) {
                        
                        html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
                    };
                    
                    $("#acudidos_tareasA1 select").html(html);
                }
                else{
                    $("#acudidos_tareasA1 select").html(html);
                    toastr.warning('No Tiene Acudidos.', 'Success Alert', {timeOut: 3000});
                }
        }

    });
}


function llenarcombo_asignaturasTA(id_acudido){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_asignaturasTA",
        type:"post",
        data:{id_acudido:id_acudido},
        success:function(respuesta) {

                var registros = eval(respuesta);
            
                html = "<option value='0'>Todas</option>";
                for (var i = 0; i < registros.length; i++) {

                    html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
                    
                };
                
                $("#asignaturas_tareasA1 select").html(html);
        }

    });
}


function mostrartareasA(valor,pagina,cantidad,id_acudido,id_asignatura){

    $.ajax({
        url:base_url+"consultas_controller/mostrartareasA",
        type:"post",
        data:{buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_acudido:id_acudido,id_asignatura:id_asignatura},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                //------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
                registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

                html ="";

                if (registros.tareas.length > 0) {

                    for (var i = 0; i < registros.tareas.length; i++) {
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.tareas[i].id_notificacion+"</td><td style='display:none'>"+registros.tareas[i].codigo_notificacion+"</td><td style='display:none'>"+registros.tareas[i].id_estudiante+"</td><td>"+registros.tareas[i].titulo+"</td><td style='display:none'>"+registros.tareas[i].contenido+"</td><td style='display:none'>"+registros.tareas[i].id_asignatura+"</td><td>"+registros.tareas[i].nombre_asignatura+"</td><td style='text-align:center'>"+registros.tareas[i].fecha_fin+"</td><td style='text-align:center'>"+registros.tareas[i].fecha_envio+"</td><td><a class='btn btn-success' href="+registros.tareas[i].id_notificacion+" title='Ver Tarea'><i class='fa fa-eye'></i></a></td></tr>";
                    };
                    
                    $("#lista_tareasA tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Tareas Registradas..</p></td></tr>";
                    $("#lista_tareasA tbody").html(html);
                }   

            }

    });

}


function mostrardiv_consultartareasA(){

    div = document.getElementById('div-consultartareasA');
    div.style.display = '';

}

function ocultardiv_consultartareasA(){

    div = document.getElementById('div-consultartareasA');
    div.style.display = 'none';
}