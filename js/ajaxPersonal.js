var accion;
var idp;

	function objetoAjax(){
	    var xmlhttp=false;
	    try {
	        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	    } catch (e) {
	 
	    try {
	        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    } catch (E) {
	        xmlhttp = false;
	    }
	}
	 
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	      xmlhttp = new XMLHttpRequest();
	    }
	    return xmlhttp;
	}

	function Nuevo(){
		accion = 'N';
		document.fmPerso.nombre.value = "";
		document.fmPerso.porcentaje.value = "";
		document.fmPerso.stado.value = "";
		$('#modalPersonal').modal('show');
	}

	function Editar(id,nombre, porcentaje, stado){
		accion = 'E';
		idp = id;
		document.fmPerso.nombre.value = nombre;
		document.fmPerso.porcentaje.value = porcentaje;
		document.fmPerso.stado.value = stado;
		$('#modalPersonal').modal('show')
	}

	function Registrar(id, accion){
		$('#modalPersonal').modal('hide');
		nombre = document.fmPerso.nombre.value;
		porcentaje = document.fmPerso.porcentaje.value;
		stado = document.fmPerso.stado.value;

		ajax = objetoAjax();
		if(accion == 'N'){
			ajax.open("POST", "../../PHP/especialista/registra_personal.php", true);
		}
		else if(accion == 'E'){
			ajax.open("POST", "../../PHP/especialista/editar_personal.php", true);
		}
		
		 ajax.onreadystatechange=function() {
		   if (ajax.readyState==4) {
		    	alert("Los datos fueron registrados con exito.!");
		    	window.location.reload(true);
		   }
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores a registro.php para que inserte los datos
		ajax.send("nombre="+nombre+"&porcentaje="+porcentaje+"&stado="+stado+"&id="+id)
	}

	function Eliminar(id){
		if(confirm("Esta seguro que desea eliminar el registro.?"))
		{
			ajax = objetoAjax();
			ajax.open("POST", "../../PHP/especialista/eliminar_personal.php", true);
			 ajax.onreadystatechange=function() {
			   if (ajax.readyState==4) {
			    	alert("el registro fue eliminado con exito.!");
			    	window.location.reload(true);
			   }
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("id="+id)
		}
		else
		{
			//no pasa nada
		}
	}


	function addPartes(){
		parte = document.fmPartes.parte.value;
		Resultado = document.getElementById('resultado-partes');
		ajax = objetoAjax();
			ajax.open("POST", "../../PHP/especialista/registra_partes.php", true);
			 ajax.onreadystatechange=function() {
			   if (ajax.readyState==4) {
			    	document.fmPartes.parte.value = "";
			    	Resultado.innerHTML = ajax.responseText;
			    	alert("Los Datos fueron registrados con exito.!");
			   }
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("parte="+parte)
	}

	function deleteParte(id){
		if(confirm("Esta seguro que desea eliminar el registro.?"))
		{
			Resultado = document.getElementById('resultado-partes');
			ajax = objetoAjax();
			ajax.open("POST", "../../PHP/especialista/eliminar_parte.php", true);
			 ajax.onreadystatechange=function() {
			   if (ajax.readyState==4) {
			    	alert("el registro fue eliminado con exito.!");
			    	window.location.reload(true);
			   }
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("id="+id)
		}
		else
		{
			//no pasa nada
		}
	}


	function addDiags(){
		patologia = document.fmDiag.patologia.value;
		Resultado = document.getElementById('resultado-diag');
		ajax = objetoAjax();
			ajax.open("POST", "../../PHP/especialista/register_patologia.php", true);
			 ajax.onreadystatechange=function() {
			   if (ajax.readyState==4) {
			    	document.fmDiag.patologia.value = "";
			    	Resultado.innerHTML = ajax.responseText;
			    	alert("Los Datos fueron registrados con exito.!");
			    	window.location.reload(true);
			   }
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("patologia="+patologia)
	}

	function deleteDiag(id){
		if(confirm("Esta seguro que desea eliminar el registro.?"))
		{
			Resultado = document.getElementById('resultado-diag');
			ajax = objetoAjax();
			ajax.open("POST", "../../PHP/especialista/eliminar_diag.php", true);
			 ajax.onreadystatechange=function() {
			   if (ajax.readyState==4) {
			    	alert("el registro fue eliminado con exito.!");
			    	window.location.reload(true);
			   }
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("id="+id)
		}
		else
		{
			//no pasa nada
		}
	}
