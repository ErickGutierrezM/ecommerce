<style>
      .container-banner{
        height: 90%;
      }
      .container-banner img{
        object-fit: cover; 
        height: 90%;
      }
      .container-letrero{
        color: black; 
        background-color: #fcd900; 
      }
      .container-letrero p{
        margin: 0; 
        padding: .5em 0; 
        font-weight: bold; 
        font-size: 3.5em; 
        /* font-family: 'Alfa Slab One', cursive;  */
        letter-spacing: .1em;
        text-align: justify;
        color: #000;
      }
      .container-iso .p1{
        /* font-family: 'Alfa Slab One', cursive;  */
        font-size: 1.5em;
        text-align: justify;
        color: #000;
        font-weight: bold;
      }
      .container-iso .p2{
        font-size: 1.1em;
        text-align: justify;
      }
      .container-logo{
        max-width: 100%; 
        max-height: 100%;
      }
      .container-logo .img1{
        width: 30em;
        height: 10em; 
        margin-top: 1em;
        object-fit: cover; 
        border: none;
      }
      .container-logo .img3{
        width: 30em;
        height: 10em; 
        margin-top: 1em;
        object-fit: cover; 
        border: none;
      }
      .container-logo .img2{
        width: 25em;
        height: 10em; 
        margin-top: 1em;
        object-fit: cover; 
        border: none;
      }
      /*Media Query */
      @media (max-width: 600px) {
        .container-certificaciones p{
          font-size: 1.5em;
        }
        .container-iso .p1 {
          font-size: 1.1em;
          text-align: justify;
          color: #000;
        }   
        .container-iso .p2{
          font-size: .8em;
          text-align: justify;
        }
        .container-logo .img1{
          width: 15em;
          height: 5em;
          margin-left: 5em;
        }
        .container-logo .img3{
          width: 15em;
          height: 5em;
          margin-left: 3em;
        }
        .container-logo .img2{
          width: 15em;
          height: 5em;
          margin-left: 5em;
        }
        .container-letrero p{
          font-size: 1.5em;
          color: #000;
        }
      }
    </style>

<div class="container-fluid">
      <div class="row">
          <div class="col-12 p-0 container-banner">
              <img src="vistas/img/plantilla/Banner_certificaciones.jpg" class="d-block w-100 img-fluid" alt="banner principal">
          </div>
          <div class="col-12 p-0 d-flex justify-content-center container-letrero">
            <p>CERTIFICACIONES</p>
        </div>
      </div>

      <div class="row" style="margin-top: 3em;">
        <div class="col-1"></div>
        <div class="col-10 container-iso">
            <p class="p1">¿Que es la norma ISO 9001 y para que sirve?</p>
            <p class="p2">Es una norma internacional que se centra en todos los elementos de la gestión de la calidad con los que una empresa debe contar
                  para tener un sistema efectivo que le permita administrar y mejorar la calidad de sus productos o servicios.</p>
        </div>
        <div class="col-1"></div>

        <div class="col-1"></div>
        <div class="col-10 container-iso">
            <p  class="p1">¿Qué es la norma ISO 45001 y para que sirve?</p>
            <p class="p2">ISO 45001 es la nueva norma de Sistemas de Gestión, para asegurar la seguridad y salud de los trabajadores mediante el establecimiento y cumplimiento de normas; mediante el mejoramiento continuo de procesos de seguridad y salud en el lugar de trabajo.</p>
        </div>
        <div class="col-1"></div>

        <div class="col-1"></div>
        <div class="col-10 container-iso">
            <p  class="p1">¿Qué es la OSHA y para qué sirve la OSHA?</p>
            <p class="p2">Es una norma internacional que se centra en todos los elementos de la gestión de la calidad con los que una empresa debe contar para tener un sistema efectivo que le permita administrar y mejorar la calidad de sus productos o servicios.</p>
        </div>
        <div class="col-1"></div>

        <div class="col-1"></div>
        <div class="col-10 container-iso">
            <p class="p1">¿QUÉ ES EL DISTINTIVO ESR Y QUE SIGNIFICA?</p>
            <p class="p2">Es un reconocimiento otorgado anualmente en México por la CEMEFI que Acredita a las empresas, como una organización comprometida voluntaria y públicamente con una gestión socialmente responsable, como parte de su cultura y estrategia de negocio. No
                es un compromiso de una sola vez, sino que debe refrendarse año con año para mantener vigente la cultura de la responsabilidad
                social. <br> Ser una Empresa Socialmente Responsable es aquella que fundamenta su visión y compromiso en políticas, programas, toma de
                decisiones y acciones que benefician a su negocio y que inciden positivamente en la gente, el medio ambiente y las comunidades
                en que operan, más alla de sus obligaciones, atendiendo 4 principales ámbitos: <br><br>

                • Calidad de vida <br>
                • Ética <br>
                • Vinculación con la comunidad <br>
                • Medio ambiente
            
            </p>
        </div>
        <div class="col-1"></div>
      </div>
      
      <div class="row" style="margin-bottom: 3em;">
        <div class="col-1 col-0-sm"></div>
        <div class="col-5 p-0 d-flex justify-content-center align-items-center container-logo">
            <img class="img3" src="vistas/img/plantilla/1.png" class="img-thumbnail p-0" alt="...">
        </div>
        <div class="col-5 p-0 d-flex justify-content-center align-items-center container-logo">
          <img class="img2" src="vistas/img/plantilla/3.png" class="img-thumbnail p-0" alt="...">
        </div>
        <div class="col-1"></div>
        <div class="col-1"></div>  
        <div class="col-5 p-0 d-flex justify-content-center align-items-center container-logo">
          <img class="img1" src="vistas/img/plantilla/2.png" class="img-thumbnail p-0" alt="...">
        </div>
        <div class="col-5 p-0 d-flex justify-content-center align-items-center container-logo">
          <img class="img2" src="vistas/img/plantilla/4.png" class="img-thumbnail p-0" alt="...">
        </div>
        <div class="col-0-sm"></div>  
      </div>
  </div>