$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

    id_acudiente = $("#id_persona").val();
	llenarcombo_acudidosEA(id_acudiente);


	$("#btn_consultar_eventosA").click(function(event){

    	if($("#form_consultar_eventosA").valid()==true){

    		id_acudido = $("#id_acudidoEA").val();
            id_asignatura = $("#id_asignaturaEA").val();

    		mostrardiv_consultareventosA();
    		mostrareventosA("",1,5,id_acudido,id_asignatura);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#id_acudidoEA").change(function(){
    	ocultardiv_consultareventosA();
        $("#lista_eventosA tbody").html("");

        id_acudido = $(this).val();
        llenarcombo_asignaturasEA(id_acudido);
    });

    $("#id_asignaturaEA").change(function(){
        ocultardiv_consultareventosA();
        $("#lista_eventosA tbody").html("");
    });

    $("#buscar_eventoA").keyup(function(event){

        buscar = $(this).val();
        id_acudido = $("#id_acudidoEA").val();
        id_asignatura = $("#id_asignaturaEA").val();
        mostrareventosA(buscar,1,5,id_acudido,id_asignatura);
    });


    $("body").on("click","#lista_eventosA a",function(event){
        event.preventDefault();
        $("#modal_detalle_eventoA").modal();
        id_notificacionsele = $(this).attr("href");
        titulosele = $(this).parent().parent().children("td:eq(4)").text();
        contenidosele = $(this).parent().parent().children("td:eq(5)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
        asignaturasele = $(this).parent().parent().children("td:eq(7)").text();
        fecha_iniciosele = $(this).parent().parent().children("td:eq(8)").text();
        hora_iniciosele = $(this).parent().parent().children("td:eq(9)").text();
        fecha_finsele = $(this).parent().parent().children("td:eq(10)").text();
        hora_finsele = $(this).parent().parent().children("td:eq(11)").text();
        fecha_enviosele = $(this).parent().parent().children("td:eq(12)").text();

        $("#id_notificacionsele").val(id_notificacionsele);
        $("#titulosele").val(titulosele);
        $("#contenidosele").val(contenidosele);
        $("#asignaturasele").val(asignaturasele);
        $("#fecha_iniciosele").val(fecha_iniciosele);
        $("#hora_iniciosele").val(hora_iniciosele);
        $("#fecha_finsele").val(fecha_finsele);
        $("#hora_finsele").val(hora_finsele);
        $("#fecha_enviosele").val(fecha_enviosele);
        
    });


    $("#form_consultar_eventosA").validate({

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



function llenarcombo_acudidosEA(id_acudiente){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_acudidosEA",
        type:"post",
        data:{id_acudiente:id_acudiente},
        success:function(respuesta) {
               
                var registros = eval(respuesta);

                html = "<option value=''></option>";

                if (registros.length > 0) {

                    for (var i = 0; i < registros.length; i++) {
                        
                        html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
                    };
                    
                    $("#acudidos_eventosA1 select").html(html);
                }
                else{
                    $("#acudidos_eventosA1 select").html(html);
                    toastr.warning('No Tiene Acudidos.', 'Success Alert', {timeOut: 3000});
                }
        }

    });
}


function llenarcombo_asignaturasEA(id_acudido){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_asignaturasEA",
        type:"post",
        data:{id_acudido:id_acudido},
        success:function(respuesta) {

                var registros = eval(respuesta);
            
                html = "<option value='0'>Todas</option>";
                for (var i = 0; i < registros.length; i++) {

                    html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
                    
                };
                
                $("#asignaturas_eventosA1 select").html(html);
        }

    });
}


function mostrareventosA(valor,pagina,cantidad,id_acudido,id_asignatura){

    $.ajax({
        url:base_url+"consultas_controller/mostrareventosA",
        type:"post",
        data:{buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_acudido:id_acudido,id_asignatura:id_asignatura},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                //------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
                registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

                html ="";

                if (registros.eventos.length > 0) {

                    for (var i = 0; i < registros.eventos.length; i++) {
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.eventos[i].id_notificacion+"</td><td style='display:none'>"+registros.eventos[i].codigo_notificacion+"</td><td style='display:none'>"+registros.eventos[i].id_estudiante+"</td><td>"+registros.eventos[i].titulo+"</td><td style='display:none'>"+registros.eventos[i].contenido+"</td><td style='display:none'>"+registros.eventos[i].id_asignatura+"</td><td>"+registros.eventos[i].nombre_asignatura+"</td><td style='text-align:center'>"+registros.eventos[i].fecha_inicio+"</td><td style='display:none'>"+registros.eventos[i].hora_inicio+"</td><td style='display:none'>"+registros.eventos[i].fecha_fin+"</td><td style='display:none'>"+registros.eventos[i].hora_fin+"</td><td style='text-align:center'>"+registros.eventos[i].fecha_envio+"</td><td><a class='btn btn-success' href="+registros.eventos[i].id_notificacion+" title='Ver Evento'><i class='fa fa-eye'></i></a></td></tr>";
                    };
                    
                    $("#lista_eventosA tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Eventos Registrados..</p></td></tr>";
                    $("#lista_eventosA tbody").html(html);
                }   

            }

    });

}


function mostrardiv_consultareventosA(){

    div = document.getElementById('div-consultareventosA');
    div.style.display = '';

}

function ocultardiv_consultareventosA(){

    div = document.getElementById('div-consultareventosA');
    div.style.display = 'none';
}