<?php



$comercio = ControladorComercio::ctrSeleccionarComercio();


?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            Informacion de la tienda
        </h3>
    </div>
    <div class="box-body formularioInformacion">
        <div class="form-group">
            <label for="usr">Impuesto: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                <input type="number" min="0" id="impuesto" class="form-control cambioInformacion"
                    value="<?php echo $comercio["impuesto"]; ?>">
            </div>
        </div>
        <!-- ENVÍO NACIONAL -->

        <div class="form-group">

            <label for="usr">Envío ZMG:</label>

            <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                <input type="number" min="1" class="form-control cambioInformacion" id="envioNacional"
                    value="<?php echo $comercio["envioNacional"]; ?>">

            </div>

        </div>

        <!-- ENVÍO INTERNACIONAL -->

        <div class="form-group">

            <label for="usr">Envío fuera:</label>

            <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                <input type="number" min="1" class="form-control cambioInformacion" id="envioInternacional"
                    value="<?php echo $comercio["envioInternacional"]; ?>">

            </div>

        </div>

        <!-- TASA MÍNIMA NACIONAL -->

        <div class="form-group">

            <label for="usr">Costo Mínimo ZMG:</label>

            <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                <input type="number" min="1" class="form-control cambioInformacion" id="tasaMinimaNal"
                    value="<?php echo $comercio["tasaMinimaNal"]; ?>">

            </div>

        </div>

        <!-- TASA MÍNIMA INTERNACIONAL -->

        <div class="form-group">

            <label for="usr">Costo mínimo fuera:</label>

            <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                <input type="number" min="1" class="form-control cambioInformacion" id="tasaMinimaInt"
                    value="<?php echo $comercio["tasaMinimaInt"]; ?>">

            </div>

        </div>
        	    <!-- PASARELA DE PAGO PAYPAL -->

	    <div class="panel panel-default">
	    	
			<div class="panel-heading">

      			<h4 class="text-uppercase">Configuración Paypal</h4>

      		</div>
			
			<div class="panel-body">
				
				<div class="form-group row">
					
					 <div class="col-xs-3">
					 	
						<label>Modo:</label>

						 <?php

      					if($comercio["modoPaypal"] == "sandbox"){

      						echo '	<label class="checkbox">

      									<input class="cambioInformacion" type="radio" value="sandbox" name="modoPaypal" checked>  

      									Sandbox

      								</label>
              					
          							<label class="checkbox">

          								<input class="cambioInformacion" type="radio" value="live" name="modoPaypal"> 

          								Live

          							</label>';
      					}else{

      						echo '	<label class="checkbox">

      									<input class="cambioInformacion" type="radio" value="sandbox" name="modoPaypal">  

      									Sandbox

      								</label>
              					
          							<label class="checkbox">

          								<input class="cambioInformacion" type="radio" value="live" name="modoPaypal" checked> 

          								Live

          							</label>';


      					}

      					?>

					 </div>

					 <div class="col-xs-4">
            
            			<label for="comment">Cliente:</label>
      
            			<input type="text" class="form-control cambioInformacion" id="clienteIdPaypal" value="<?php echo $comercio["clienteIdPaypal"]; ?>">

          			</div>

      			 	<div class="col-xs-5">

		            	<label for="comment">Llave Secreta:</label>
		      
		            	<input type="text" class="form-control cambioInformacion" id="llaveSecretaPaypal" value="<?php echo $comercio["llaveSecretaPaypal"]; ?>">

		          </div>

				</div>

			</div>

	    </div>
    </div>
    <div class="box-footer">
        <button type="button" id="guardarInformacion" class="btn btn-primary pull-right">
            Guardar
        </button>
    </div>
</div>