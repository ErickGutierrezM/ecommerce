<!--NOTIFICACIONES-->
<?php 

$notificaciones =  ControladorNotificaciones::ctrMostrarNotificaciones();

$totalNotificaciones = $notificaciones["nuevosUsuarios"] + $notificaciones["nuevasVentas"];

?>
<li class="dropdown notifications-menu">
    <!--dropdown-toggle-->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-bell"></i>
        <span class="label" style="background-color:#0a0a0a; font-size:10px;"><?php echo $totalNotificaciones; ?></span>
    </a>
    <!--dropdown-menu-->
    <ul class="dropdown-menu">
        <li class="header">Tienes <?php echo $totalNotificaciones; ?> notificaciones</li>
         <!--menu-->
        <li>
            <ul class="menu">
                 <!--usuarios-->
                <li>
                    <a href="" class="actualizarNotificaciones" item="nuevosUsuarios">
                        <i class="fa fa-users text-aqua"></i> <?php echo $notificaciones["nuevosUsuarios"]; ?> usuarios nuevos
                    </a>
                </li>
                 <!--ventas-->
                <li>
                    <a href="" class="actualizarNotificaciones" item="nuevasVentas">
                        <i class="fa fa-users text-aqua"></i><?php echo $notificaciones["nuevasVentas"]; ?> ventas nuevas
                    </a>
                </li>
                 <!--visitas-->
                <!-- <li>
                    <a href="visitas">
                        <i class="fa fa-users text-aqua"></i> 3 visitas nuevos
                    </a>
                </li> -->
            </ul>
        </li>
    </ul>
     <!--dropdown-menu-->
</li>