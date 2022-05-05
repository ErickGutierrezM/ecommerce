<!-- =============================================== -->

<style>
.form-rounded {

    border-radius: 1rem;

}
</style>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Gestor productos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Gestor productos</li>

        </ol>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">

                    Agregar producto

                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>

                            <th>Titulo</th>

                            <th>Categoria</th>

                            <th>Ruta</th>

                            <th>Estado</th>

                            <th>Descripción</th>

                            <th>Imagen Principal</th>

                            <th>Multimedia</th>

                            <th>Detalles</th>

                            <th>Precio</th>

                            <th>Inventario</th>

                            <th>Tiempo de Entrega</th>

                            <th>Tipo de Oferta</th>

                            <th>Valor Oferta</th>

                            <th>Imagen Oferta</th>

                            <th>Fin Oferta</th>

                            <th>Acciones</th>



                        </tr>

                    </thead>

                </table>

            </div>

        </div>

        <!-- /.box -->



    </section>

    <!-- /.content -->

</div>

<!-- /.content-wrapper -->



<div class="modal fade" id="modalAgregarProducto" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- <form role="form" method="POST" enctype="multipart/form-data">-->

            <!--=====================================CABEZA DEL MODAL======================================-->

            <div class="modal-header" style="background:#f9dd00; color:#000">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Agregar producto</h4>

            </div>

            <!--=====================================CUERPO DEL MODAL======================================-->
            <div class="modal-body">

                <div class="box-body">
                    <!--=====================================ENTRADA PARA EL TÍTULO======================================-->
                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fab fa-product-hunt"></i></span>

                            <input type="text" class="form-control input-lg validarProducto tituloProducto form-rounded"
                                placeholder="Ingresar título producto" required>

                        </div>

                    </div>
                    <!--=====================================ENTRADA PARA LA RUTA DEL PRODUCTO======================================-->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-link"></i></span>

                            <input type="text" class="form-control input-lg rutaProducto form-rounded" placeholder="Ruta url del producto" readonly>

                        </div>

                    </div>

                    <!--=====================================TIPO DE PRODUCTO ======================================-->

                    <div class="form-group">
                        <input type="hidden" class="seleccionarTipo" value="fisico">
                    </div>

                    <!--=====================================AGREGAR DETALLES======================================-->
                    <div class="detallesFisicos">

                        <div class="panel">

                            <h3>Detalles</h3>

                        </div>

                        <!-- CLASES -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Ancho" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleAncho form-rounded" placeholder="Descripción">

                            </div>

                        </div>

                        <!-- TIEMPO -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Largo" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleLargo form-rounded" placeholder="Descripción">

                            </div>

                        </div>

                        <!-- NIVEL -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Alto" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleAlto form-rounded" placeholder="Descripción">

                            </div>

                        </div>

                        <!-- ACCESO -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Peso" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detallePeso form-rounded" placeholder="Descripción">

                            </div>

                        </div>

                        <!-- DISPOSITIVO -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Calibre" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleCalibre form-rounded" placeholder="Descripción">

                            </div>

                        </div>

                    </div>

                    <!--===================================== AGREGAR CATEGORÍA ======================================-->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                            <select class="form-control input-lg seleccionarCategoria form-rounded">

                                <option value="">Selecionar categoría</option>

                                <?php

                                    $item = null;

                                    $valor = null;

                                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                    foreach ($categorias as $key => $value) {

                                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                                    }

                                ?>

                            </select>

                        </div>

                    </div>
                    <!--=====================================AGREGAR DESCRIPCIÓN======================================-->
                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fas fa-edit"></i></span>

                            <textarea type="text" maxlength="320" rows="3"
                                class="form-control input-lg descripcionProducto form-rounded"
                                placeholder="Ingresar descripción producto" required></textarea>

                        </div>

                    </div>
                    <!--=====================================AGREGAR FOTO DE MULTIMEDIA======================================-->
                    <div class="form-group">

                        <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

                        <input type="file" class="fotoPrincipal">

                        <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

                        <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal"
                            width="200px">

                    </div>

                    <div class="form-group agregarMultimedia">

                        <!--=====================================SUBIR MULTIMEDIA DE PRODUCTO FÍSICO======================================-->

                        <div class="multimediaFisica needsclick dz-clickable">

                            <div class="dz-message needsclick">

                                Arrastrar o dar click para subir galería del producto.

                            </div>

                        </div>

                        <input type="hidden" class="valorMultimedia">

                    </div>


                   <!-- <div class="form-group">

                        <div class="panel">SUBIR FICHA TECNICA DEL PRODUCTO</div>

                        <input type="file" class="fichaTecnica" name="userfile">

                    </div> -->

                    <!--=====================================AGREGAR PRECIO Y ENTREGA======================================-->

                    <div class="form-group row">

                        <!-- PRECIO -->

                        <div class="col-md-4 col-xs-12">

                            <div class="panel">PRECIO</div>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>

                                <input type="number" class="form-control input-lg precio form-rounded" min="0"
                                    step="any" required>

                            </div>

                        </div>
                        <div class="col-md-4 col-xs-12">

                            <div class="panel">INVENTARIO</div>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-clipboard-list"></i></span>

                                <input type="number" class="form-control input-lg inventario form-rounded" min="0"
                                    step="any" required>

                            </div>

                        </div>


                        <!-- ENTREGA -->

                        <div class="col-md-4 col-xs-12">

                            <div class="panel">DÍAS DE ENTREGA</div>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-truck"></i></span>

                                <input type="number" class="form-control input-lg entrega form-rounded" min="0"
                                    value="0" required>

                            </div>

                        </div>

                    </div>

                    <!--=====================================AGREGAR OFERTAS======================================-->

                    <div class="form-group">

                        <select class="form-control input-lg selActivarOferta form-rounded">

                            <option value="">No tiene oferta</option>

                            <option value="oferta">Activar oferta</option>

                        </select>

                    </div>

                    <div class="datosOferta" style="display:none">

                        <!--=====================================VALOR OFERTAS======================================-->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <input class="form-control input-lg valorOferta precioOferta form-rounded"
                                        tipo="oferta" type="number" value="0" min="0" placeholder="Precio">

                                </div>

                            </div>

                            <div class="col-xs-6">

                                <div class="input-group">

                                    <input class="form-control input-lg valorOferta descuentoOferta form-rounded"
                                        tipo="descuento" type="number" value="0" min="0" placeholder="Descuento">

                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>

                            </div>

                        </div>

                        <!--=====================================FECHA FINALIZACIÓN OFERTA======================================-->

                        <div class="form-group">

                            <div class="input-group date">

                                <input type='text'
                                    class="form-control datepicker input-lg valorOferta finOferta form-rounded">

                                <span class="input-group-addon">

                                    <span class="glyphicon glyphicon-calendar"></span>

                                </span>

                            </div>

                        </div>

                        <!--====================================FOTO OFERTA======================================-->

                        <div class="form-group">

                            <div class="panel">SUBIR FOTO OFERTA</div>

                            <input type="file" class="fotoOferta valorOferta form-rounded">

                            <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                            <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta"
                                width="100px">

                        </div>

                    </div>

                </div>

            </div>

            <!--=====================================PIE DEL MODAL======================================-->

            <div class="modal-footer">
                <div class="preload"></div>

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="button" class="btn btn-primary guardarProducto">Guardar Producto</button>

            </div>

            <!--</form>-->

        </div>

    </div>

</div>

<!--=====================================MODAL EDITAR PRODUCTO======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!--=====================================CABEZA DEL MODAL======================================-->

            <div class="modal-header" style="background:#f9dd00; color:#000">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Editar producto</h4>

            </div>

            <!--=====================================CUERPO DEL MODAL======================================-->

            <div class="modal-body">

                <div class="box-body">
                    <!--=====================================ENTRADA PARA EL TÍTULO======================================-->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fab fa-product-hunt"></i></span>

                            <input type="text" class="form-control input-lg validarProducto tituloProducto" readonly>

                            <input type="hidden" class="idProducto">

                        </div>

                    </div>

                    <!--===================================== ENTRADA PARA LA RUTA DEL PRODUCTO======================================-->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-link"></i></span>

                            <input type="text" class="form-control input-lg rutaProducto" readonly>

                        </div>

                    </div>
                    <!--=====================================TIPO DE PRODUCTO ======================================-->

                    <div class="form-group">
                        <input type="hidden" class="seleccionarTipo" value="fisico">
                    </div>

                    <div class="detallesFisicos">

                        <div class="panel">

                            <h3>Detalles</h3>

                        </div>

                        <!-- CLASES -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Ancho" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleAncho form-rounded"
                                    placeholder="Descripción">

                            </div>

                        </div>
                        <!-- TIEMPO -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Largo" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleLargo form-rounded"
                                    placeholder="Descripción">

                            </div>

                        </div>

                        <!-- NIVEL -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Alto" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleAlto form-rounded"
                                    placeholder="Descripción">

                            </div>

                        </div>

                        <!-- ACCESO -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Peso" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detallePeso form-rounded"
                                    placeholder="Descripción">

                            </div>

                        </div>

                        <!-- DISPOSITIVO -->

                        <div class="form-group row">

                            <div class="col-xs-3">

                                <input class="form-control input-lg form-rounded" type="text" value="Calibre" readonly>

                            </div>

                            <div class="col-xs-9">

                                <input type="text" class="form-control input-lg detalleCalibre form-rounded"
                                    placeholder="Descripción">

                            </div>

                        </div>

                    </div>

                    <!--=====================================AGREGAR CATEGORÍA======================================-->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                            <select class="form-control input-lg seleccionarCategoria">

                                <option class="optionEditarCategoria"></option>

                                <?php

                                    $item = null;

                                    $valor = null;

                                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                    foreach ($categorias as $key => $value) {

                                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                                    }

                                ?>

                            </select>

                        </div>

                    </div>

                    <!--===================================== AGREGAR DESCRIPCIÓN======================================-->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                            <textarea type="text" maxlength="320" rows="3"
                                class="form-control input-lg descripcionProducto"></textarea>

                        </div>

                    </div>

                    <!--===================================== AGREGAR FOTO DE MULTIMEDIA======================================-->

                    <div class="form-group">

                        <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

                        <input type="file" class="fotoPrincipal">

                        <input type="hidden" class="antiguaFotoPrincipal">

                        <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

                        <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal"
                            width="200px">

                    </div>
                    <!--=====================================ENTRADA PARA AGREGAR MULTIMEDIA ======================================-->



                    <div class="form-group agregarMultimedia">

                        <!--=====================================SUBIR MULTIMEDIA DE PRODUCTO FÍSICO======================================-->

                        <div class="row previsualizarImgFisico"></div>

                        <div class="multimediaFisica needsclick dz-clickable">

                            <div class="dz-message needsclick">

                                Arrastrar o dar click para subir imagenes.

                            </div>

                        </div>

                    </div>


                    <!--=====================================AGREGAR PRECIO, PESO Y ENTREGA======================================-->

                    <div class="form-group row">

                        <!-- PRECIO -->

                        <div class="col-md-4 col-xs-12">

                            <div class="panel">PRECIO</div>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>

                                <input type="number" class="form-control input-lg precio form-rounded" min="0"
                                    step="any" required>

                            </div>

                        </div>
                        <div class="col-md-4 col-xs-12">

                            <div class="panel">INVENTARIO</div>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-clipboard-list"></i></span>

                                <input type="number" class="form-control input-lg inventario form-rounded" min="0"
                                    step="any" required>

                            </div>

                        </div>


                        <!-- ENTREGA -->

                        <div class="col-md-4 col-xs-12">

                            <div class="panel">DÍAS DE ENTREGA</div>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fas fa-truck"></i></span>

                                <input type="number" class="form-control input-lg entrega form-rounded" min="0"
                                    value="0" required>

                            </div>

                        </div>

                    </div>

                    <!--=====================================AGREGAR OFERTAS======================================-->

                    <div class="form-group">

                        <select class="form-control input-lg selActivarOferta">

                            <option value="">No tiene oferta</option>

                            <option value="oferta">Activar oferta</option>

                        </select>

                    </div>

                    <div class="datosOferta" style="display:none">



                        <!--=====================================VALOR OFERTAS======================================-->


                        <div class="form-group row">

                            <div class="col-xs-6">

                                <div class="input-group">


                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <input class="form-control input-lg valorOferta precioOferta" tipo="oferta"
                                        type="number" value="0" min="0" placeholder="Precio">


                                </div>

                            </div>

                            <div class="col-xs-6">

                                <div class="input-group">

                                    <input class="form-control input-lg valorOferta descuentoOferta" tipo="descuento"
                                        type="number" value="0" min="0" placeholder="Descuento">

                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>

                            </div>

                        </div>

                        <!--=====================================FECHA FINALIZACIÓN OFERTA======================================-->

                        <div class="form-group">

                            <div class="input-group date">

                                <input type='text' class="form-control datepicker input-lg valorOferta finOferta">

                                <span class="input-group-addon">

                                    <span class="glyphicon glyphicon-calendar"></span>

                                </span>

                            </div>

                        </div>

                        <!--=====================================FOTO OFERTA======================================-->

                        <div class="form-group">

                            <div class="panel">SUBIR FOTO OFERTA</div>

                            <input type="file" class="fotoOferta valorOferta">

                            <input type="hidden" class="antiguaFotoOferta">

                            <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                            <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta"
                                width="100px">

                        </div>

                    </div>

                </div>

            </div>

            <!--=====================================PIE DEL MODAL======================================-->

            <div class="modal-footer">

                <div class="preload"></div>

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="button" class="btn btn-primary guardarCambiosProducto">Guardar cambios</button>

            </div>

        </div>

    </div>

</div>

<?php
    $eliminarProducto = new ControladorProductos();
    $eliminarProducto -> ctrEliminarProducto();
?>