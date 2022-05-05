<?php

        session_start();

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="https://panel.andamiosexpressstore.mx/vistas/img/plantilla/logo_mobil.png" sizes="80x80">

    <title>Andamios Express Shop</title>

    <!--RUTA FIJA DEL PROYECTO-->

    <?php



        $url = Ruta::ctrRuta();

        $urlServer = Ruta::ctrRutaServidor();



    ?>



    <link rel="stylesheet" href="<?php echo $url?>vistas/css/plugins/bootstrap-4.6.0.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/plugins/custom-styles.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/plantilla.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/custom.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/slide.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/productos.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/infoproducto.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/perfil.css">

    <link rel="stylesheet" href="<?php echo $url?>vistas/css/carrito.css">

    <link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/sweetalert.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css"> -->

    <link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/sweetalert.css">


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> -->

    <script src="<?php echo $url; ?>vistas/js/plugins/md5-min.js"></script>
    <meta name="google-site-verification" content="6a4xr8bbi7ldhzxO6Y69rw0yEJ0FbqOZn3BCxYXg9HI" />

    <style>
    .flex-direction-nav{
        display: none;
    }
    </style>







    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">

<!--Start of [Tawk.to](http://Tawk.to) Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61ca1bef80b2296cfdd3fe66/1fnunq7ss';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of [Tawk.to](http://Tawk.to) Script-->

<!--JAVASCRIPT-->
<script src="https://kit.fontawesome.com/88f4b8bc1d.js" crossorigin="anonymous"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"

    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">

</script>

<script src="<?php echo $url?>vistas/js/plugins/bootstrap-4.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>





<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

<script src="<?php echo $url?>vistas/js/plugins/jquery.flexslider.js"></script>
<script src="<?php echo $url; ?>vistas/js/plugins/sweetalert.min.js"></script>




<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<!-- <script src="<?php //echo //$url; ?>vistas/js/jsPDF.js"></script> -->
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.11/jspdf.plugin.autotable.min.js"></script>






</head>



<body>

    <!--HEADER-->



    <?php

        include "modulos/header.php";





        //distinguir elementos de las rutas





        $rutas = array();

        $ruta = null;

        $infoProducto = null;





        if(isset($_GET["ruta"])){

            $rutas = explode("/",  $_GET["ruta"]);



            //Configuracion de lista blanca de URL´S

            $item = "ruta";

            $valor = $rutas[0];



            $rutaCategorias = ControladorProductos::CtrMostrarCategorias( $item, $valor);

            

            if (is_array($rutaCategorias) && $rutas[0] == $rutaCategorias["ruta"] && $rutaCategorias["estado"] == 1) {

                $ruta = $rutas[0];

            }

            /*=============================================

	                URL'S AMIGABLES DE PRODUCTOS

	            =============================================*/



            $rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

            

            if(is_array($rutaProductos) && $rutas[0] == $rutaProductos["ruta"] && $rutaProductos["estado"] == 1){



                $infoProducto = $rutas[0];



            }



                if($ruta != null){



                    include "modulos/productos.php";



                }else if($infoProducto != null){



                    include "modulos/info-producto.php";



                }else if($rutas[0] == "verificar"  || $rutas[0] == "salir" || $rutas[0] == "perfil" || $rutas[0] == "carrito-de-compras" || $rutas[0] == "error" || $rutas[0] == "finalizar-compra" || $rutas[0] == "certificaciones"|| $rutas[0] == "quienes-somos"){



                    include "modulos/".$rutas[0].".php";



                }else{



                    include "modulos/error404.php";



                }

            }else{

                include "modulos/slide.php";

                include "modulos/eleccion.php";

                include "modulos/mas-vendidos.php";
               




            }
            include "modulos/footer.php";
        ?>

    <input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">




<script src="<?php echo $url; ?>vistas/js/plantilla.js"></script>

<script src="<?php echo $url?>vistas/js/plugins/app.js"></script>

<script src="<?php echo $url; ?>vistas/js/infoproducto.js"></script>

<script src="<?php echo $url; ?>vistas/js/usuarios.js"></script>

<script src="<?php echo $url; ?>vistas/js/carrito-de-compras.js"></script>
 
    
    
    <!-- <script src="<?php //echo $url; ?>vistas/js/html2canvas.js"></script> -->

  <!--  <script src="<?php //echo $url; ?>vistas/js/registroFacebook.js"></script>-->







    <!-- <script>

    $('.owl-carousel').owlCarousel({

        loop: false,

        margin: 10,

        dots: false,

        nav: true,

        mouseDrag: false,

        autoplay: true,

        animateOut: 'slideOutUp',

        responsiveClass:true,

        responsive: {

            0: {

                items: 1

            },

            600: {

                items: 1

            },

            1000: {

                items: 1

            }

        }

    });

    </script> -->

    <script type="text/javascript">
        window.html2canvas = html2canvas;

        function pago(){

            html2canvas(document.querySelector("#capture"),{
               allowTaint: true,
               useCORS: true,
               scale: 1
            }).then(canvas => {
                var img = canvas.toDataURL("image/png");
                
                var doc = new jsPDF();
                doc.setFont('Arial');
                doc.getFontSize(16);
                doc.text('Andamios Express', 20, 20);

                doc.autoTable({html: '#indicaciones'})
                doc.autoTable({
                    head: [['Instrucciones pago con transferencia']],
                    body:[
                        ['1.- Realiza el pago en cualquier sucursal bancaria de nuestro convenio.\n2.- Una vez realizado el pago, enviar el comprobante de pago al correo administracion@andamiosexpress.com con los siguentes datos: \n * Nombre completo.\n * Fecha de la transacción. \n3.- Validado el pago se informará vía correo electrónico que el pedido está listo para ser enviado. \n4.- Recibe tu pedido en tu domicilio entre 48 y 72 horas.\n\n ¡Gracias por comprar en nuestra tienda línea!'],

                    ]
                })
                doc.autoTable({html: '#referencias'})

                doc.autoTable({
                    head: [['Banco', 'No. cuenta', 'CLABE Interbancaria', 'Nombre']],
                    body:[
                        ['BBVA BANCOMER', '01141100492', '0123 2000 1141 0049 20', 'MP TRADING, S.A. de C.V.'],
                        

                    ]
                })
                doc.autoTable({html: '#agradecimiento'})

                doc.autoTable({
                    head: [['Otras Formas de pago']],
                    body:[
                        ['Puedes realizar el pago de tu pedido en los siguientes establecimientos:\n\n• Farmacias del AhorroFarmacias Unión.\n• Oxxo.\n• 7 Eleven.\n• Farmacias Guadalajara.\n• Súper Sánchez.\n• Willys.\n• Súper 72.\n•Telecomm Telégrafos.\n• Súper Kiosko.'],
                        

                    ]
                })
                doc.addImage(img, 'PNG',7,170,190,50); 

                doc.save("referencias-pago-pedido-andamios-express");
            });
           
        }
    </script>

    

<!--<script>

  window.fbAsyncInit = function() {

    FB.init({

      appId      : '413683180207051',

      cookie     : true,

      xfbml      : true,

      version    : 'v12.0'

    });

      

    FB.AppEvents.logPageView();   

      

  };



  (function(d, s, id){

     var js, fjs = d.getElementsByTagName(s)[0];

     if (d.getElementById(id)) {return;}

     js = d.createElement(s); js.id = id;

     js.src = "https://connect.facebook.net/en_US/sdk.js";

     fjs.parentNode.insertBefore(js, fjs);

   }(document, 'script', 'facebook-jssdk'));

</script>-->



</body>



</html>