/**ACTUALIZAR NOTIFICACIONES */



$(".actualizarNotificaciones").click(function(e){

    e.preventDefault();

    var item = $(this).attr("item");



    $.ajax({



        url:"ajax/notificaciones.ajax.php",

        method: "POST",

       data: datos,

       cache: false,

       contentType: false,

       processData: false,

       success: function(respuesta){

           console.log("respuesta", respuesta);



              if(respuesta == "ok"){



                if(item == "nuevosUsuarios"){



                    window.location = "usuarios";

                }



                if(item == "nuevasVentas"){



                    window.location = "ventas";

                }

           }



        }



   })

})