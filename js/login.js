

$("#btnIngresar").click(function(e){
    
    e.preventDefault();
    const datos = $("#login").serialize();

    $.ajax({
        url: "controlador/procesosU.php",
        data: datos+"&action=login",
        type: "POST",
        dataType: "json",
        success: function (response) {
        console.log(response);
        if(response.estado=="no")
        {
            $("#mensajes").html("usuario invalido");
        }else{
            location.href="vista/home.php";          
        }
        

        },
        error: function (response) {
          console.log(response);
        }
      });

})

