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


function diferirFecha(id, fecha){
    document.fmdiferir.cita_id.value = id;
    document.fmdiferir.fecha.min = fecha;
    $('#myModalDiferir').modal('show')
}

function Diferir(){
    $('#myModalDiferir').modal('hide');
        Resultado = document.getElementById('resultado-esperas');
        cita_id = document.fmdiferir.cita_id.value;
        fecha = document.fmdiferir.fecha.value;

        ajax = objetoAjax();      
        ajax.open("POST", "../../PHP/recepcion/actualizar_fecha.php", true);
        
        ajax.onreadystatechange=function() {
           if (ajax.readyState==4) {
                Resultado.innerHTML = ajax.responseText;
                window.location.reload(true);
                alert("La fecha de la cia fue cambiada con exito");
           }
        }
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        //enviando los valores a registro.php para que inserte los datos
        ajax.send("id="+cita_id+"&fecha="+fecha)
}

function cambiarStatus(id, status){
    var cita_id = id;
    var status = status;

    ajax = objetoAjax();      
    ajax.open("POST", "../../PHP/recepcion/cambiar_status_citas.php", true);
    
    ajax.onreadystatechange=function() {
       if (ajax.readyState==4) {
            window.location.reload(true);
            //alert("La fecha de la cia fue cambiada con exito");
       }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //enviando los valores a registro.php para que inserte los datos
    ajax.send("id="+cita_id+"&status="+status)
}

function cancelarCita(id, nombre){
    if(confirm("Esta seguro que desea cancelar la cita del paciente: "+nombre+".?"))
    {
        ajax = objetoAjax();
        ajax.open("POST", "../../PHP/recepcion/cancelar_cita.php", true);
         ajax.onreadystatechange=function() {
           if (ajax.readyState==4) {
                window.location.reload(true);
                alert("La cita fue cancelada con exito.!");
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