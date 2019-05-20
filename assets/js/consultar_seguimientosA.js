$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

    id_acudiente = $("#id_persona").val();
	llenarcombo_acudidosSA(id_acudiente);


	$("#btn_consultar_seguimientosA").click(function(event){

    	if($("#form_consultar_seguimientosA").valid()==true){

    		id_acudido = $("#id_acudidoSA").val();
            id_asignatura = $("#id_asignaturaSA").val();

    		mostrardiv_consultarseguimientosA();
    		mostrarseguimientosA("",1,5,id_acudido,id_asignatura);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#id_acudidoSA").change(function(){
    	ocultardiv_consultarseguimientosA();
        $("#lista_seguimientosA tbody").html("");

        id_acudido = $(this).val();
        llenarcombo_asignaturasSA(id_acudido);
    });

    $("#id_asignaturaSA").change(function(){
        ocultardiv_consultarseguimientosA();
        $("#lista_seguimientosA tbody").html("");
    });

    $("#buscar_seguimientoA").keyup(function(event){

        buscar = $(this).val();
        id_acudido = $("#id_acudidoSA").val();
        id_asignatura = $("#id_asignaturaSA").val();
        mostrarseguimientosA(buscar,1,5,id_acudido,id_asignatura);
    });


    $("body").on("click","#lista_seguimientosA a",function(event){
        event.preventDefault();
        $("#modal_detalle_seguimientoA").modal();
        id_seguimientosele = $(this).attr("href");
        id_estudiantesele = $(this).parent().parent().children("td:eq(2)").text();
        estudiantesele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
        id_tipo_causalsele = $(this).parent().parent().children("td:eq(4)").text();
        tipo_causalsele = $(this).parent().parent().children("td:eq(5)").text();
        id_asignaturasele = $(this).parent().parent().children("td:eq(6)").text();
        asignaturasele = $(this).parent().parent().children("td:eq(7)").text();
        id_causalsele = $(this).parent().parent().children("td:eq(8)").text();
        causalsele = $(this).parent().parent().children("td:eq(9)").text();
        descripcion_situacionsele = $(this).parent().parent().children("td:eq(10)").text();
        fecha_causalsele = $(this).parent().parent().children("td:eq(11)").text();
        id_accion_pedagogicasele = $(this).parent().parent().children("td:eq(12)").text();
        accion_pedagogicasele = $(this).parent().parent().children("td:eq(13)").text();
        descripcion_accion_pedagogicasele = $(this).parent().parent().children("td:eq(14)").text();
        compromiso_estudiantesele = $(this).parent().parent().children("td:eq(15)").text();
        observacionessele = $(this).parent().parent().children("td:eq(16)").text();
        estado_seguimientosele = $(this).parent().parent().children("td:eq(17)").text();
        fecha_registrosele = $(this).parent().parent().children("td:eq(18)").text();
        id_profesorsele = $(this).parent().parent().children("td:eq(19)").text();
        profesorsele = $(this).parent().parent().children("td:eq(20)").text();

        $("#id_seguimientosele").val(id_seguimientosele);
        $("#id_estudiantesele").val(id_estudiantesele);
        $("#estudiantesele").val(estudiantesele);
        $("#id_tipo_causalsele").val(id_tipo_causalsele);
        $("#tipo_causalsele").val(tipo_causalsele);
        $("#id_asignaturasele").val(id_asignaturasele);
        $("#asignaturasele").val(asignaturasele);
        $("#id_causalsele").val(id_causalsele);
        $("#causalsele").val(causalsele);
        $("#descripcion_situacionsele").val(descripcion_situacionsele);
        $("#fecha_causalsele").val(fecha_causalsele);
        $("#id_accion_pedagogicasele").val(id_accion_pedagogicasele);
        $("#accion_pedagogicasele").val(accion_pedagogicasele);
        $("#descripcion_accion_pedagogicasele").val(descripcion_accion_pedagogicasele);
        $("#compromiso_estudiantesele").val(compromiso_estudiantesele);
        $("#observacionessele").val(observacionessele);
        $("#fecha_registrosele").val(fecha_registrosele);
        $("#id_profesorsele").val(id_profesorsele);
        $("#profesorsele").val(profesorsele);
        
    });


    $("#form_consultar_seguimientosA").validate({

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



function llenarcombo_acudidosSA(id_acudiente){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_acudidosSA",
        type:"post",
        data:{id_acudiente:id_acudiente},
        success:function(respuesta) {
               
                var registros = eval(respuesta);

                html = "<option value=''></option>";

                if (registros.length > 0) {

                    for (var i = 0; i < registros.length; i++) {
                        
                        html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
                    };
                    
                    $("#acudidos_seguimientosA1 select").html(html);
                }
                else{
                    $("#acudidos_seguimientosA1 select").html(html);
                    toastr.warning('No Tiene Acudidos.', 'Success Alert', {timeOut: 3000});
                }
        }

    });
}


function llenarcombo_asignaturasSA(id_acudido){

    $.ajax({
        url:base_url+"consultas_controller/llenarcombo_asignaturasSA",
        type:"post",
        data:{id_acudido:id_acudido},
        success:function(respuesta) {

                var registros = eval(respuesta);
            
                html = "<option value='0'>Todas</option>";
                for (var i = 0; i < registros.length; i++) {

                    html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
                    
                };
                
                $("#asignaturas_seguimientosA1 select").html(html);
        }

    });
}


function mostrarseguimientosA(valor,pagina,cantidad,id_acudido,id_asignatura){

    $.ajax({
        url:base_url+"consultas_controller/mostrarseguimientosA",
        type:"post",
        data:{buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_acudido:id_acudido,id_asignatura:id_asignatura},
        success:function(respuesta) {
                //toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
                //------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
                registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

                html ="";

                if (registros.seguimientos.length > 0) {

                    for (var i = 0; i < registros.seguimientos.length; i++) {
                        html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.seguimientos[i].id_seguimiento+"</td><td style='display:none'>"+registros.seguimientos[i].id_estudiante+"</td><td style='display:none'>"+registros.seguimientos[i].nombres+" "+registros.seguimientos[i].apellido1+" "+registros.seguimientos[i].apellido2+"</td><td style='display:none'>"+registros.seguimientos[i].id_tipo_causal+"</td><td>"+registros.seguimientos[i].tipo_causal+"</td><td style='display:none'>"+registros.seguimientos[i].id_asignatura+"</td><td>"+registros.seguimientos[i].nombre_asignatura+"</td><td style='display:none'>"+registros.seguimientos[i].id_causal+"</td><td style='display:none'>"+registros.seguimientos[i].causal+"</td><td style='display:none'>"+registros.seguimientos[i].descripcion_situacion+"</td><td style='text-align:center'>"+registros.seguimientos[i].fecha_causal+"</td><td style='display:none'>"+registros.seguimientos[i].id_accion_pedagogica+"</td><td style='display:none'>"+registros.seguimientos[i].accion_pedagogica+"</td><td style='display:none'>"+registros.seguimientos[i].descripcion_accion_pedagogica+"</td><td style='display:none'>"+registros.seguimientos[i].compromiso_estudiante+"</td><td style='display:none'>"+registros.seguimientos[i].observaciones+"</td><td style='display:none'>"+registros.seguimientos[i].estado_seguimiento+"</td><td style='text-align:center'>"+registros.seguimientos[i].fecha_registro+"</td><td style='display:none'>"+registros.seguimientos[i].id_profesor+"</td><td style='display:none'>"+registros.seguimientos[i].nombrespf+" "+registros.seguimientos[i].apellido1pf+" "+registros.seguimientos[i].apellido2pf+"</td><td><a class='btn btn-success' href="+registros.seguimientos[i].id_seguimiento+" title='Ver Seguimiento'><i class='fa fa-eye'></i></a></td></tr>";
                    };
                    
                    $("#lista_seguimientosA tbody").html(html);
                }
                else{
                    html ="<tr><td colspan='6'><p style='text-align:center'>No Hay Seguimientos Registrados..</p></td></tr>";
                    $("#lista_seguimientosA tbody").html(html);
                }   

            }

    });

}


function mostrardiv_consultarseguimientosA(){

    div = document.getElementById('div-consultarseguimientosA');
    div.style.display = '';

}

function ocultardiv_consultarseguimientosA(){

    div = document.getElementById('div-consultarseguimientosA');
    div.style.display = 'none';
}