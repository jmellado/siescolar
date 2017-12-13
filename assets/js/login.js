$(document).on("ready",login); //al momento de cargar nuestra vista html se inicie la funcion incio

function login(){


	$("#formlogin").submit(function (event) {
		
		event.preventDefault(); 
		//if($("#formlogin").valid()==true){

		
			$.ajax({
				url:$("#formlogin").attr("action"),
				type:$("#formlogin").attr("method"),
				data:$("#formlogin").serialize(),   
				success:function(respuesta) {
					if(respuesta ==="usuario no existe"){
						//alert(respuesta);
						toastr.success('Usuario o Contraseña Incorrectos', 'Success Alert', {timeOut: 2000});
						

					}
					else{
						//window.location.href ="http://localhost/siescolar/login_controller";
						window.location.href =base_url+"login_controller";
					}
					
				}

			});
	   // }

	});

	/*$("#formloginn").validate({

    	rules:{

			username:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			password:{
				required: true,
				maxlength: 15
				
			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");*/

}


function nobackbutton(){

   window.location.hash="no-back-button";
	
   window.location.hash="Again-No-back-button" //chrome
	
   window.onhashchange=function(){window.location.hash="no-back-button";}
	
}