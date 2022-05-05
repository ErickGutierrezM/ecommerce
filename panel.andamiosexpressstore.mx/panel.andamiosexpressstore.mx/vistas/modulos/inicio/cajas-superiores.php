<!--=====================================
CAJAS SUPERIORES
======================================-->

<?php
$ventas = ControladorVentas::ctrMostrarTotalVentas();
$usuarios = ControladorUsuarios::ctrMostrarTotalUsuarios("id");
$totalUsuarios = count($usuarios);
$productos = ControladorProductos::ctrMostrarTotalProductos("id");
$totalProductos = count($productos);


?>

<!-- col -->
<div class="col-lg-4 col-xs-6">

  <!-- small box -->
  <div class="small-box bg-aqua">
    
    <!-- inner -->
    <div class="inner">
      
      <h3>$ <?php echo number_format($ventas["total"],2); ?></h3>

      <p>Ventas</p>
    
    </div>
    <!-- inner -->

    <!-- icon -->
    <div class="icon">
    
      <i class="ion ion-bag"></i>
    
    </div>
    <!-- icon -->
    
    <a href="ventas" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
  
  </div>
  <!-- small-box -->

</div>
<!-- col -->

<!--===========================================================================-->

<!-- col -->
<!-- <div class="col-lg-3 col-xs-6">
  
  
  <div class="small-box bg-green">


    <div class="inner">
      
      <h3>53</h3>

      <p>Visitas</p>
    
    </div>

    <div class="icon">
      
      <i class="ion ion-stats-bars"></i>
    
    </div>
    

    <a href="#" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
  
  </div>

</div> -->


<!--===========================================================================-->

<!-- col -->
<div class="col-lg-4 col-xs-6">
  
  <!-- small box -->
  <div class="small-box bg-yellow">
    
    <!-- inner -->
    <div class="inner">
    
      <h3><?php echo number_format($totalUsuarios);?></h3>

      <p>Usuarios</p>
    
    </div>
    <!-- inner -->

    <!-- icon -->
    <div class="icon">
      
      <i class="ion ion-person-add"></i>
    
    </div>
    <!-- icon -->

    <a href="usuarios" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
  
  </div>
  <!-- small box -->

</div>
<!-- col -->

<!--===========================================================================-->

<!-- col -->
<div class="col-lg-4 col-xs-6">
  
  <!-- small box -->
  <div class="small-box bg-red">
  
    <!-- inner -->
    <div class="inner">
    
      <h3><?php echo number_format($totalProductos);?></h3>

      <p>Productos</p>

    </div>
    <!-- inner -->
    
    <!-- icon -->
    <div class="icon">
      
      <i class="ion ion-pie-graph"></i>
    
    </div>
    <!-- icon -->
    
    <a href="productos" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
  
  </div>
  <!-- small box -->

</div>
<!-- col -->
