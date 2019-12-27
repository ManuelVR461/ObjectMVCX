            <div class="drawer">
                <div class="drawer-title">
                    <?php
                        $avatar = isset($_SESSION['datalogin']['avatar'])?$_SESSION['datalogin']['avatar']:"avatar.png";
                        $nombres = isset($_SESSION['datalogin']['nombres'])? ucfirst(strtolower($_SESSION['datalogin']['nombres'])):"INVITADO";
                        $fech = isset($_SESSION['datalogin']['fechaingreso'])?$_SESSION['datalogin']['fechaingreso']:NULL;
                        $fechaingreso = explode(" ",$fech);
                    ?>
                    <figure class="drawer-profile avatar" style="">
                        <img src="./statics/images/avatar/<?php echo $avatar; ?>" style="width: 50px;height: 50px;border-radius: 25px;">
                    </figure>
                    <div class="drawer-text">
                            <a href="#">
                                <span class="drawer-"><?php echo $nombres; ?></span><br>
                                <span style="font-size: x-small;">Miembro desde:<?php echo $fechaingreso[0]; ?></span>
                            </a>
                            <a href="index.php?url=logout">
                                <small>Cerrar Sesion</small>
                            </a>
                    </div>
                </div>

                <nav class="contenedor-menu">
                    <div class="menu">
                        <ul>
                            <li class="#">
                                <a href="Home"><i class="icono izq fa fa-clock"></i>HOME</a>
                            </li>
                            <li class="#">
                                <a href="Cuentas"><i class="icono izq fa fa-clock"></i>CUENTAS</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="main">

<!-- -------------------------------------------------------------------------------------- -->