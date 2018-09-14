$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	$("#btn_consolidar_matriculas").click(function(event){

       	if(confirm("Esta Seguro De Realizar El Proceso De Consolidación De Matrículas.?")){

       		consolidar_matriculas();
       	}
		
    });


}


function consolidar_matriculas(){

	$.ajax({
		url:base_url+"matriculas_controller/consolidar",
		type:"post",
		success:function(respuesta) {
				

				if (respuesta==="consolidadorealizado") {
					
					toastr.success('Consolidado De Matrículas Realizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="consolidadonorealizado"){
					
					toastr.error('Consolidado De Matrículas No Realizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="consolidadodenegado"){
					
					toastr.warning('Consolidado De Matrículas No Realizado; Todos Los Períodos De Evaluación Deben Estar Cerrados.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohayperiodos"){
					
					toastr.warning('Consolidado De Matrículas No Realizado; No Existen Períodos De Evaluación Registrados.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

		}


	});



}