$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	
	

	// este metodo permite enviar la inf del formulario
	/*$("#form_notas_insertar").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario

		$("#id_asignaturaseleN").removeAttr("disabled");
		p = $("#periodoN").val();
		if(validarCampoNota(p)==true){

			$.ajax({

				url:$("#form_notas_insertar").attr("action"),
				type:$("#form_notas_insertar").attr("method"),
				data:$("#form_notas_insertar").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						//$("#form_notas_insertar")[0].reset();
						$("#id_asignaturaseleN").attr("disabled", "disabled");
						mostrarnotas("",1,5,id_grado,id_grupo,id_asignatura);

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						$("#id_asignaturaseleN").attr("disabled", "disabled");

					}
					else if(respuesta==="grado ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					

						
						
				}

			});

		}else{

			toastr.success('Las Notas ingresadas son incorrectas', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});*/



    $("#cantidad_logroAL").change(function(){
    	valorcantidad = $(this).val();
    	mostrarnotas("",1,valorcantidad,id_grado,id_grupo,id_asignatura);
    });

    $("body").on("click", ".paginacion_logroAL li a", function(event){
    	event.preventDefault();
    	numero_pagina = $(this).attr("href");
    	//buscar = $("#buscar_grado").val();
    	valorcantidad = $("#cantidad_nota").val();
		
		if(numero_pagina !="#" && numero_pagina != "javascript:void(0)"){
			
			mostrarnotas("",numero_pagina,valorcantidad,id_grado,id_grupo,id_asignatura);
		}

    });


    $("#btn_buscar_profesorAL").click(function(event){
    	
    	if($("#identificacion_profesorAL").val()==""){

    		toastr.warning('Favor Digite Un Numero De identificacion', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacion_profesorAL").val();
       		buscar_profesorAL(id);
		}
		
       
    });


    $("#identificacion_profesorAL").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacion_profesorAL").val()==""){
	        	toastr.warning('Favor Digite Un Numero De identificacion', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacion_profesorAL").val();
       			buscar_profesorAL(id);
	       	}
    	}
		
    });


    $("#id_gradoAL").change(function(){
    	id_grado = $(this).val();
    	id_persona = $("#id_persona").val();
    	llenarcombo_grupos_profesorAL(id_persona,id_grado);

    });


    $("#id_grupoAL").change(function(){
    	id_grupo = $(this).val();
    	id_persona = $("#id_persona").val();
    	id_grado = $("#id_gradoAL").val();
    	llenarcombo_asignaturas_profesorAL(id_persona,id_grado,id_grupo);

    });


    $("#btn_ingresar_logro").click(function(){

    	if($("#form_asignar_logros").valid()==true){

    		fecha_actual = obtener_fecha_actual();
    		nombreRol = $("#rol").val();

    		if(nombreRol=="administrador"){

    			$("#modal_ingresar_nota").modal();

    			id_persona = $("#id_persona").val();
	    		periodo = $("#periodoAL").val();
	    		id_grado = $("#id_gradoAL").val();
	    		id_grupo = $("#id_grupoAL").val();
	    		id_asignatura = $("#id_asignaturaAL").val();
	    		llenarcombo_logrosAL(periodo,id_persona,id_grado,id_asignatura);

	    		/*mostrarlogrosasignados("",1,5,id_grado,id_grupo,id_asignatura);*/

	    		//llenarcombo_grados_profesorN(id_persona);
	    		//llenarcombo_grupos_profesorN(id_persona,id_grado);
	    		//llenarcombo_asignaturas_profesorN(id_persona,id_grado,id_grupo);

	    		$("#periodoseleAL").val(periodo);
	    		$("#id_gradoseleAL").val(id_grado);
	    		$("#id_gruposeleAL").val(id_grupo);
	    		$("#id_asignaturaseleAL").val(id_asignatura);

    		}
    		else{

    			validar_fechaIngresoLogros($("#periodoAL").val(),fecha_actual);
    		}

    	}
    	

    });






	$("#form_asignar_logros").validate({

    	rules:{

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			id_persona:{
				required: true,
				maxlength: 15	

			},

			id_grado:{
				required: true,
				maxlength: 15

			},

			id_asignatura:{
				required: true,
				maxlength: 15	

			},

			id_grupo:{
				required: true,
				maxlength: 15	

			}

		}


	});

	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


/*function mostrarnotas(valor,pagina,cantidad,id_grado,id_grupo,id_asignatura){

	$.ajax({
		url:base_url+"notas_controller/mostrarnotas",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_grado:id_grado,id_grupo:id_grupo,id_asignatura:id_asignatura},
		success:function(respuesta) {
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				p = $("#periodoAL").val();
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.notas.length; i++) {
					
					if(p=="Primero"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_persona[]' id='id_persona' value='"+registros.notas[i].id_persona+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' disabled><input type='hidden' name='p2[]' id='p2' value='"+registros.notas[i].p2+"'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' disabled><input type='hidden' name='p3[]' id='p3' value='"+registros.notas[i].p3+"'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' disabled><input type='hidden' name='p4[]' id='p4' value='"+registros.notas[i].p4+"'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
					if(p=="Segundo"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_persona[]' id='id_persona' value='"+registros.notas[i].id_persona+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' disabled><input type='hidden' name='p1[]' id='p1' value='"+registros.notas[i].p1+"'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' disabled><input type='hidden' name='p3[]' id='p3' value='"+registros.notas[i].p3+"'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' disabled><input type='hidden' name='p4[]' id='p4' value='"+registros.notas[i].p4+"'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
					if(p=="Tercero"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_persona[]' id='id_persona' value='"+registros.notas[i].id_persona+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' disabled><input type='hidden' name='p1[]' id='p1' value='"+registros.notas[i].p1+"'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' disabled><input type='hidden' name='p2[]' id='p2' value='"+registros.notas[i].p2+"'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' disabled><input type='hidden' name='p4[]' id='p4' value='"+registros.notas[i].p4+"'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
					if(p=="Cuarto"){
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_persona[]' id='id_persona' value='"+registros.notas[i].id_persona+"' size='2'></td><td>"+registros.notas[i].identificacion+"</td><td>"+registros.notas[i].nombres+"</td><td>"+registros.notas[i].apellido1+"</td><td>"+registros.notas[i].apellido2+"</td><td><input type='text' name='p1[]' id='p1' value='"+registros.notas[i].p1+"' size='2' disabled><input type='hidden' name='p1[]' id='p1' value='"+registros.notas[i].p1+"'></td><td><input type='text' name='p2[]' id='p2' value='"+registros.notas[i].p2+"' size='2' disabled><input type='hidden' name='p2[]' id='p2' value='"+registros.notas[i].p2+"'></td><td><input type='text' name='p3[]' id='p3' value='"+registros.notas[i].p3+"' size='2' disabled><input type='hidden' name='p3[]' id='p3' value='"+registros.notas[i].p3+"'></td><td><input type='text' name='p4[]' id='p4' value='"+registros.notas[i].p4+"' size='2' onKeypress='return valida_nota(event)'></td><td><input type='text' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"' size='2' disabled><input type='hidden' name='nota_final[]' id='nota_final' value='"+registros.notas[i].nota_final+"'></td><td><input type='text' name='fallas[]' id='fallas' value='"+registros.notas[i].fallas+"' size='2' onKeypress='return valida_falla(event)'></td></tr>";
					}
				};
				
				$("#lista_notas tbody").html(html);

				linkseleccionado = Number(pagina);
				//total de registros
			    totalregistros = registros.totalregistros;
				//cantidad de registros por pagina
				cantidadregistros = registros.cantidad;
				//numero de links o paginas dependiendo de la cantidad de registros y el numero a mostrar
				numerolinks = Math.ceil(totalregistros/cantidadregistros);

				paginador="<ul class='pagination'>";

				if(linkseleccionado>1)
				{
					paginador+="<li><a href='1'>&laquo;</a></li>";
					paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";

				}
				else
				{
					paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
					paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
				}
				//muestro de los enlaces 
				//cantidad de link hacia atras y adelante
	 			cant = 2;
	 			//inicio de donde se va a mostrar los links
				pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
				//condicion en la cual establecemos el fin de los links
				if (numerolinks > cant)
				{
					//conocer los links que hay entre el seleccionado y el final
					pagRestantes = numerolinks - linkseleccionado;
					//defino el fin de los links
					pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
				}
				else 
				{
					pagFin = numerolinks;
				}

				for (var i = pagInicio; i <= pagFin; i++) {
					if (i == linkseleccionado)
						paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
					else
						paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
				}
				//condicion para mostrar el boton sigueinte y ultimo
				if(linkseleccionado<numerolinks)
				{
					paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
					paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

				}
				else
				{
					paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
					paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
				}
				
				paginador +="</ul>";
				$(".paginacion_nota").html(paginador);

			}

	});

}*/


function buscar_profesorAL(valor){

	$.ajax({
		url:base_url+"asignar_logros_controller/buscar_profesor",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				

				if(respuesta==="profesornoexiste"){

					toastr.success('Profesor No Registrado', 'Success Alert', {timeOut: 5000});
					$("#form_asignar_logros")[0].reset();
					$("#id_persona").val("");
					llenarcombo_grados_profesorAL("");
					llenarcombo_asignaturas_profesorAL("","","");
					llenarcombo_grupos_profesorAL("","");
					bloquear_cajas_texto_logrosAL();
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						id_persona = registros[i]["id_persona"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];

						$("#id_persona").val(id_persona);
	        			$("#nombres").val(nombres);
	        			$("#apellido1").val(apellido1);
	        			$("#apellido2").val(apellido2);

	        			desbloquear_cajas_texto_logrosAL();
						llenarcombo_grados_profesorAL(id_persona);
						llenarcombo_asignaturas_profesorAL("","","");
						llenarcombo_grupos_profesorAL("","");
					};
				}	
				
		
		}

	});
}


function llenarcombo_grados_profesorAL(valor){

	$.ajax({
		url:base_url+"asignar_logros_controller/llenarcombo_grados_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
					
				};
				
				$("#grados_logrosAL1 select").html(html);
		}

	});
}


function llenarcombo_grupos_profesorAL(valor,valor2){

	$.ajax({
		url:base_url+"asignar_logros_controller/llenarcombo_grupos_profesor",
		type:"post",
		data:{id_persona:valor,id_grado:valor2},
		success:function(respuesta) {
				
				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_grupo"]+">"+registros[i]["nombre_grupo"]+"</option>";
					
				};
				
				$("#grupos_logrosAL1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorAL(valor,valor2,valor3){

	$.ajax({
		url:base_url+"asignar_logros_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_grado:valor2,id_grupo:valor3},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_logrosAL1 select").html(html);
		}

	});
}



function validar_fechaIngresoLogros(nombre_periodo,fecha_actual){

	$.ajax({
		url:base_url+"asignar_logros_controller/validar_fechaIngresoLogros",
		type:"post",
		data:{periodo:nombre_periodo,fecha_actual:fecha_actual},
		success:function(respuesta) {

				if(respuesta ==="si"){

					//alert("si existen fechas");

					$("#modal_ingresar_nota").modal();
			
    		
		    		id_persona = $("#id_persona").val();
		    		periodo = $("#periodoN").val();
		    		id_grado = $("#id_gradoN").val();
		    		id_grupo = $("#id_grupoN").val();
		    		id_asignatura = $("#id_asignaturaN").val();

		    		/*mostrarnotas("",1,5,id_grado,id_grupo,id_asignatura);*/

		    		//llenarcombo_grados_profesorN(id_persona);
		    		//llenarcombo_grupos_profesorN(id_persona,id_grado);
		    		//llenarcombo_asignaturas_profesorN(id_persona,id_grado,id_grupo);

		    		$("#periodoseleN").val(periodo);
		    		$("#id_gradoseleN").val(id_grado);
		    		$("#id_gruposeleN").val(id_grupo);
		    		$("#id_asignaturaseleN").val(id_asignatura);

				}
				else{
					alert("No Existen Fechas Para La Asignacion De Logros");
				}
		}

	});
}


function llenarcombo_logrosAL(valor,valor2,valor3,valor4){

	$.ajax({
		url:base_url+"asignar_logros_controller/llenarcombo_logros",
		type:"post",
		data:{periodo:valor,id_persona:valor2,id_grado:valor3,id_asignatura:valor4},
		success:function(respuesta) {
				toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_logro"]+">"+registros[i]["nombre_logro"]+"</option>";
					
				};
				
				$("#logros1 select").html(html);
		}

	});
}


function bloquear_cajas_texto_logrosAL(){

	$("#id_gradoAL").attr("disabled", "disabled");
	$("#id_asignaturaAL").attr("disabled", "disabled");
    $("#periodoAL").attr("disabled", "disabled");
    $("#id_grupoAL").attr("disabled", "disabled");
    $("#btn_ingresar_logro").attr("disabled", "disabled");
}

function desbloquear_cajas_texto_logrosAL(){

	$("#id_gradoAL").removeAttr("disabled");
	$("#id_asignaturaAL").removeAttr("disabled");
    $("#periodoAL").removeAttr("disabled");
    $("#id_grupoAL").removeAttr("disabled");
    $("#btn_ingresar_logro").removeAttr("disabled");

}

function obtener_fecha_actual(){
	var f = new Date();
	anio=f.getFullYear();
	mes=f.getMonth()+1;
	dia=f.getDate();


	if(dia<10) {
		dia='0'+dia
	} 

	if(mes<10) {
		mes='0'+mes
	} 
	
	fecha_actual=anio+'-'+mes+'-'+dia;

	return fecha_actual;
}

/*function valida_nota(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9\.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}*/

/*function validarCampoNota(periodo){

	var resn=[];
    var resy=[];
    var vacio = "";

	if(periodo=="Primero"){
   	 	var notas = document.getElementsByName("p1[]");

   	}else if(periodo=="Segundo"){
   		var notas = document.getElementsByName("p2[]");
   	}
   	else if(periodo=="Tercero"){
   		var notas = document.getElementsByName("p3[]");
   	}
   	else{
   		var notas = document.getElementsByName("p4[]");
   	}


   	for(i = 0; i < notas.length; i++){

   		if(notas[i].value != vacio && notas[i].value >= 0 && notas[i].value <= 5){

   			resy.push("si")
   		}
   		else{
   			resn.push("no");
   		}


   	}

   	if(resy.length == notas.length){

		//alert("ok");
		return true;
	}
	else{
		//alert("no");
		return false;
	}

}*/

/*function valida_falla(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}*/