<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Registrar venta

        </h1>

        <ol class="breadcrumb">



            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>



            <li class="active">Registrar venta</li>



        </ol>

    </section>

    <section class="content">



        <div class="row">

            <!--tABLA PARA REGISTAR VENTA-->

            <div class="col-lg-5 col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <form role="form" method="post"  class="formularioRegistroVenta">

                        <div class="box-body">


                            <div class="box">

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                        <select name="seleccionarCliente" id="seleccionarCliente" class="form-control"
                                            required>

                                            <option value="">Seleccionar cliente</option>

                                            <?php 

                                                $item = null;

                                                $valor = null;



                                                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);



                                                foreach($usuarios as $key =>$value){

                                                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                                                }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <!--Entrada para agregar producto-->

                                <div class="form-group row nuevoProducto">
                                </div>

                                <input type="hidden" id="listaProductos" name="listaProductos">
                                <!-- <input type="hidden" id="envioEstado" name="envioEstado" value="0">
                                <input type="hidden" id="pagoEstado" name="pagoEstado" value="0"> -->


                                <!--BOTON PARA AGREGAR PRODUCTO-->

                                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar
                                    producto</button>

                                <hr>

                                <div class="row">

                                    <div class="col-xs-8 pull-right">

                                        <table class="table">

                                            <thead>

                                                <tr>

                                                    <th style="visibility:hidden;">

                                                        Impuesto

                                                    </th>

                                                    <th>

                                                        Total

                                                    </th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <td style="width: 50%; visibility:hidden;">

                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                    class="fas fa-dollar-sign"></i></span>
                                                            <input type="number" name="nuevoImpuestoVenta"
                                                                id="nuevoImpuestoVenta" placeholder="0" value="0" 
                                                                class="form-control">

                                                                <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto">
                                                                <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto">

                                                        </div>

                                                    </td>

                                                    <td style="width: 50%;">

                                                        <div class="input-group">

                                                            <span class="input-group-addon">

                                                                <i class="fas fa-dollar-sign"></i>

                                                            </span>

                                                            <input type="text" name="nuevoTotalVenta"
                                                                id="nuevoTotalVenta" total="" placeholder="0" readonly
                                                                class="form-control nuevoTotalVenta">
                                                                <input type="hidden" name="totalVenta" id="totalVenta">

                                                        </div>



                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <hr>

                                <!--FORMA DE PAGO-->

                                <div class="row form-group">

                                    <div class="col-xs-6">

                                        <div class="input-group">

                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago">

                                                <option value="">Seleccione forma de pago</option>

                                                <option value="TF">Transferencia bancaria</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="cajasMetodoPago"></div>

                                    <input type="hidden" name="listaMetodoPago" id="listaMetodoPago">

                                </div>

                                <hr>

                            </div>



                        </div>



                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">

                                Guardar venta

                            </button>

                        </div>

                    </form>
                        <?php

                            $guardarVenta = new ControladorVentas();
                            $guardarVenta -> ctrCrearVenta();

                        ?>

                </div>



            </div>



            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

                <div class="box box-danger">



                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablaRegistroVentas">

                            <thead>

                                <tr>

                                    <th style="width: 10px;">#</th>

                                    <th>Imagen</th>

                                    <th>Nombre</th>

                                    <th>Inventario</th>

                                    <th>Precio</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                        </table>

                    </div>



                </div>

            </div>



        </div>



    </section>



</div>