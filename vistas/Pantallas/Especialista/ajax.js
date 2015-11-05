// Función para recoger los datos de PHP según el navegador, se usa siempre.
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
 
//Función para recoger los datos del formulario y enviarlos por post 
// -------------------------------------------------------------------------------------- 
function enviarObs(){
 
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('respuesta-obs');
  //recogemos los valores de los inputs
  
  paciente=document.form_obs.paciente_id.value;
  observacion = document.form_obs.observacion_general.value;
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  ajax.open("POST", "../../PHP/especialista/register_obs.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
      //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
        //mostrar resultados en esta capa
        divResultado.innerHTML = ajax.responseText
        //llamar a funcion para limpiar los inputs
        LimpiarCamposObs();
    }
 }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //enviando los valores a registro.php para que inserte los datos
    ajax.send("paciente_id="+paciente+"&obs="+observacion)
}

// ------------------------------------------------------------------------------------------------------

function enviarProcedimientos(){
 
  //div donde se mostrará lo resultados
  divResp_procedimiento = document.getElementById('resp_procedimientos');
  //recogemos los valores de los inputs
  
  paciente=document.form_procedimientos.paciente_id.value;
  paquete = document.form_procedimientos.paquete_id.value;
  tipo = document.form_procedimientos.tipo.value;
  procedimiento = document.form_procedimientos.nombre.value;
  area_cuerpo = document.form_procedimientos.parte.value;
  cantidad = document.form_procedimientos.cantidad.value;
  frecuencia = document.form_procedimientos.frecuencia.value;
  parametros = document.form_procedimientos.parametros.value;
  
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "../../PHP/especialista/register_tratamientos.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
      //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
        //mostrar resultados en esta capa
        divResp_procedimiento.innerHTML = ajax.responseText
        //llamar a funcion para limpiar los inputs
        LimpiarCamposProc();
    }
 }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //enviando los valores a registro.php para que inserte los datos
    ajax.send("paciente="+paciente+"&paquete="+paquete+"&tipo="+tipo+
              "&procedimiento="+procedimiento+"&parte="+area_cuerpo+"&cantidad="
              +cantidad+"&frecuencia="+frecuencia+"&parametros="+parametros)
}
 


// -----------------------------------------------------------------------------------------------------
//función para limpiar los campos
function LimpiarCamposObs(){
  document.form_obs.observacion_general.value=""; 
}

//función para limpiar los campos formulario procedimientos
function LimpiarCamposProc(){
  document.form_procedimientos.nombre.value="";
  document.form_procedimientos.parte.value="";
  document.form_procedimientos.cantidad.value="";
  document.form_procedimientos.frecuencia.value="";
  document.form_procedimientos.parametros.value="";
    
}