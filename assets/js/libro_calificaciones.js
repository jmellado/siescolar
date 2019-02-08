$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosLC();


	$("#btn_descargar_LC").click(function(event){

    	if($("#form_libro_calificaciones").valid()==true){

            ano_lectivo = $("#ano_lectivoLC").val();
    		jornada = $("#jornadaLC").val();
    		id_curso = $("#id_cursoLC").val();

            window.open(base_url+'libro_calificaciones_controller/generar_libro'+'?ano_lectivo='+ano_lectivo+'&jornada='+jornada+'&id_curso='+id_curso, '_blank');

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#ano_lectivoLC").change(function(){
        ano_lectivo = $(this).val();
        $("#jornadaLC").val("");

        jornada = $("#jornadaLC").val();
        llenarcombo_cursosLC(ano_lectivo,jornada);
    });

    $("#jornadaLC").change(function(){
        jornada = $(this).val();
    	ano_lectivo = $("#ano_lectivoLC").val();
    	llenarcombo_cursosLC(ano_lectivo,jornada);
    });



    $("#form_libro_calificaciones").validate({

    	rules:{


            ano_lectivo:{
                required: true,
                digits: true    

            },

			jornada:{
				required: true,
				maxlength: 30

			},

            id_curso:{
                required: true,
                digits: true

            }


		}


	});





}


function llenarcombo_anos_lectivosLC(){

    $.ajax({
        url:base_url+"libro_calificaciones_controller/llenarcombo_anos_lectivos",
        type:"post",
        success:function(respuesta) {

                var registros = eval(respuesta);

                html = "<option value=''></option>";
                for (var i = 0; i < registros.length; i++) {
                    
                    html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
                };
                
                $("#ano_lectivo_libro1 select").html(html);
        }

    });
}


function llenarcombo_cursosLC(ano_lectivo,jornada){

    $.ajax({
        url:base_url+"libro_calificaciones_controller/llenarcombo_cursos",
        type:"post",
        data:{ano_lectivo:ano_lectivo,jornada:jornada},
        success:function(respuesta) {
                //toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
                var registros = eval(respuesta);

                html = "<option value=''></option>";
                for (var i = 0; i < registros.length; i++) {
                    
                    html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
                    
                };
                
                $("#cursos_libro1 select").html(html);
        }

    });

}