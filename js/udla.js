
$(document).ready(function() { $("#partescuerpo").select2(
{
    placeholder: "Selecciones una parte del cuepo",
    allowClear: true,
    }); 
});


$(document).ready(function() { $("#procedimientos").select2(
{
    placeholder: "Seleccione un Procedimiento",
    allowClear: true,
    minimumInputLength: 2
    }); 
});






    $(document).ready(function() { $("#parametro").select2(
    {
    placeholder: "Seleccione uno o varios parametros",
    allowClear: true,
    }	); });



    $(document).ready(function() { $("#patologia").select2(
    {
    placeholder: "Seleccione una patologia",
    allowClear: true,
    }	); });



    function showContent() {
    element = document.getElementById("content");
    check = document.getElementById("otro");
    if (check.checked) {
    element.style.display='block';
    }
    else {
    element.style.display='none';
    }
    }


    function showContent2() {
    element = document.getElementById("content2");
    list = document.form_diagnostico.patologia;
    if (list.value== "Otra") {
    element.style.display='block';
    }
    else {
    element.style.display='none';
    }
    }






    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
    x++; //text box increment
    $(wrapper).append('<div class="despliegue"><textarea name="nombre[]" class="form-control elemento"> </textarea> <input type="text" name="parametros[]" class="form-control tratamientos elemento"> <input type="text" name="frecuencia[]" class="form-control tratamientos elemento"> <a href="#" class="remove_field">X</a></div>'); //add input box
    }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    });
  