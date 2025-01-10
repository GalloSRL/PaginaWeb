<!-- HEADER DESKTOP-->

<header class="header-desktop3 navbar navbar-expand d-none d-lg-block elevation-2">

    <div class="section__content section__content--p35">

        <div class="header3-wrap">

            <div class="header__logo">

                <a href="dashboard">

                    <img src="vista/images/Logos/logo2.png" alt="GALLO-Panel" />

                </a>

            </div>

            <div class="header__navbar">

                <ul class="list-unstyled">

                <?php   
                    
                    if($_SESSION["tipo_user"] == 'Administrador' || $_SESSION['tipo_user'] == 'Marketing'){ ?>

                        <li class="has-sub">

                            <a href="dashboard">

                                <i class="fas fa-tachometer-alt"></i>

                                <span class="bot-line"></span>Dashboard</a>

                        </li>

                    <?php   } ?> 

                    <?php 

                        if($_SESSION["tipo_user"] == 'Administrador' || $_SESSION['tipo_user'] == 'Marketing'){ ?>

                        <li class="has-sub">

                            <a href="productos">

                                <i class="fas fa-cubes"></i>

                                <span class="bot-line"></span>Productos</a>

                        </li>

                    <?php   } ?> 

                    <?php if ($_SESSION['tipo_user'] == 'Administrador' ||  $_SESSION['tipo_user'] == 'Desarrollo Humano') { ?>

                        <li class="has-sub">

                            <a href="vacancias">

                                <i class="fas fa-briefcase"></i>

                                <span class="bot-line"></span>Vacancias Laborales

                            </a>

                        </li>

                    <?php } ?>

                    <?php if ($_SESSION['tipo_user'] == 'General') { ?>

                        <li class="has-sub">

                            <a href="tickets-user">

                                <i class="fas fa-briefcase"></i>

                                <span class="bot-line"></span>Tickets de Trabajo

                            </a>

                        </li>

                    <?php } ?>
                    <?php if ($_SESSION['tipo_user'] == 'Técnico') { ?>

                        <li class="has-sub">

                            <a href="tickets-Tec">

                                <i class="fas fa-briefcase"></i>

                                <span class="bot-line"></span>Tickets de Trabajo

                            </a>

                        </li>

                    <?php } ?>

                    <?php if ($_SESSION['tipo_user'] == 'Administrador') { ?>

                        <li class="has-sub">

                            <a href="#">

                                <i class="fas fa-laptop"></i>Informática

                                <span class="bot-line"></span>

                            </a>

                            <ul class="header3-sub-list list-unstyled">

                                <li>

                                    <a href="tickets">Tickets de Trabajo</a>

                                </li>

                                <li>

                                    <a href="mantenimiento">Mantenimientos</a>

                                </li>

                                <li>

                                    <a href="usuarios">Control de Usuario</a>

                                </li>

                                <li>

                                    <a href="roles">Roles</a>

                                </li>

                                <li>

                                    <a href="clientes">Clientes SAP</a>

                                </li>

                            </ul>

                        </li>

                    <?php } ?>

                </ul>

            </div>

            <div class="header__tool">

                <!--<div class="header-button-item has-noti js-item-menu">

                    <i class="zmdi zmdi-notifications"></i>

                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">

                        <div class="notifi__title">

                            <p>You have 3 Notifications</p>

                        </div>

                        <div class="notifi__item">

                            <div class="bg-c1 img-cir img-40">

                                <i class="zmdi zmdi-email-open"></i>

                            </div>

                            <div class="content">

                                <p>You got a email notification</p>

                                <span class="date">April 12, 2018 06:50</span>

                            </div>

                        </div>

                        <div class="notifi__item">

                            <div class="bg-c2 img-cir img-40">

                                <i class="zmdi zmdi-account-box"></i>

                            </div>

                            <div class="content">

                                <p>Your account has been blocked</p>

                                <span class="date">April 12, 2018 06:50</span>

                            </div>

                        </div>

                        <div class="notifi__item">

                            <div class="bg-c3 img-cir img-40">

                                <i class="zmdi zmdi-file-text"></i>

                            </div>

                            <div class="content">

                                <p>You got a new file</p>

                                <span class="date">April 12, 2018 06:50</span>

                            </div>

                        </div>

                        <div class="notifi__footer">

                            <a href="#">All notifications</a>

                        </div>

                    </div>

                </div>-->

                <div class="account-wrap">

                    <div class="account-item account-item--style2 clearfix js-item-menu">

                        <div class="image">

                            <img src="vista/images/icon/user.png" alt="" />

                        </div>

                        <div class="content">

                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['nombre_user']; ?></a>

                        </div>

                        <div class="account-dropdown js-dropdown">

                            <div class="info clearfix">

                                <div class="image">

                                    <a href="#">

                                        <img src="vista/images/icon/user.png" alt="" />

                                    </a>

                                </div>

                                <div class="content">

                                    <h5 class="name">

                                        <a href="#"><?php echo $_SESSION['nombre_user']; ?></a>

                                    </h5>

                                    <span class="email">

                                        <?php echo $_SESSION['tipo_user']; ?>

                                    </span>

                                    <span class="email mt-2">

                                        <a href="cambiar-password" class="text-danger">Cambiar Contraseña</a>

                                    </span>

                                </div>

                            </div>

                            <div class="account-dropdown__footer">

                                <a href="salir">

                                    <i class="zmdi zmdi-power"></i>Cerrar Sesión</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</header>

<!-- END HEADER DESKTOP-->



<!-- HEADER MOBILE-->

<header class="header-mobile header-mobile-2 d-block d-lg-none">

    <div class="header-mobile__bar">

        <div class="container-fluid">

            <div class="header-mobile-inner">

                <a class="logo" href="index.html">

                    <img src="vista/images/Logos/logo2.png" alt="Gallo-Logo" />

                </a>

                <button class="hamburger hamburger--slider" type="button">

                    <span class="hamburger-box">

                        <span class="hamburger-inner"></span>

                    </span>

                </button>

            </div>

        </div>

    </div>

    <nav class="navbar-mobile">

        <div class="container-fluid">

            <ul class="navbar-mobile__list list-unstyled">
                <?php if($_SESSION["tipo_user"] == 'Administrador'  ){ ?>

                    <li class="has-sub">

                        <a href="dashboard">

                            <i class="fas tachometer-alt"></i>Dashboard</a>

                    </li>
                <?php   } ?> 
                <?php if($_SESSION["tipo_user"] == 'Administrador' || $_SESSION['tipo_user'] == 'Marketing'){ ?>

                    <li>

                        <a href="productos">

                            <i class="fas fa-cubes"></i>Productos</a>

                    </li>

                <?php   } ?> 

                <?php if ($_SESSION['tipo_user'] == 'Administrador' ||  $_SESSION['tipo_user'] == 'Desarrollo Humano') { ?>

                    <li>

                        <a href="vacancias">

                            <i class="fas fa-briefcase"></i>Vacancias Laborales

                        </a>

                    </li>

                <?php } ?>
                <?php if ($_SESSION['tipo_user'] == 'Administrador' ||  $_SESSION['tipo_user'] == 'General') { ?>

                    <li>

                        <a href="tickets-user">

                            <i class="fas fa-briefcase"></i>Tickets de Trabajo

                        </a>

                    </li>

                <?php } ?>
                <?php if ($_SESSION['tipo_user'] == 'Administrador' ||  $_SESSION['tipo_user'] == 'Técnico') { ?>

                    <li>

                        <a href="tickets-Tec">

                            <i class="fas fa-briefcase"></i>Tickets de Trabajo

                        </a>

                    </li>

                <?php } ?>

                <?php if($_SESSION["tipo_user"] == 'Administrador'){ ?>

                    <li class="has-sub">

                        <a class="js-arrow open" href="#">

                            <i class="fas fa-laptop"></i>Informática</a>

                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                            <li>

                                <a href="tickets">Tickets de Trabajo</a>

                            </li>

                            <li>

                                <a href="mantenimiento">Mantenimientos</a>

                            </li>

                            <li>

                                <a href="usuarios">Control de Usuario</a>

                            </li>

                            <li>

                                <a href="roles">Roles</a>

                            </li>

                            <li>

                                <a href="clientes">Clientes SAP</a>

                            </li>

                        </ul>

                    </li>

                <?php } ?>

            </ul>

        </div>

    </nav>

</header>

<div class="sub-header-mobile-2 d-block d-lg-none">

    <div class="header__tool">

        <!--<div class="header-button-item has-noti js-item-menu">

            <i class="zmdi zmdi-notifications"></i>

            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">

                <div class="notifi__title">

                    <p>You have 3 Notifications</p>

                </div>

                <div class="notifi__item">

                    <div class="bg-c1 img-cir img-40">

                        <i class="zmdi zmdi-email-open"></i>

                    </div>

                    <div class="content">

                        <p>You got a email notification</p>

                        <span class="date">April 12, 2018 06:50</span>

                    </div>

                </div>

                <div class="notifi__item">

                    <div class="bg-c2 img-cir img-40">

                        <i class="zmdi zmdi-account-box"></i>

                    </div>

                    <div class="content">

                        <p>Your account has been blocked</p>

                        <span class="date">April 12, 2018 06:50</span>

                    </div>

                </div>

                <div class="notifi__item">

                    <div class="bg-c3 img-cir img-40">

                        <i class="zmdi zmdi-file-text"></i>

                    </div>

                    <div class="content">

                        <p>You got a new file</p>

                        <span class="date">April 12, 2018 06:50</span>

                    </div>

                </div>

                <div class="notifi__footer">

                    <a href="#">All notifications</a>

                </div>

            </div>

        </div>-->

        <div class="account-wrap">

            <div class="account-item account-item--style2 clearfix js-item-menu">

                <div class="image">

                    <img src="vista/images/icon/user.png" alt="" />

                </div>

                <div class="content">

                    <a class="js-acc-btn" href="#"><?php echo $_SESSION['nombre_user']; ?></a>

                </div>

                <div class="account-dropdown js-dropdown">

                    <div class="info clearfix">

                        <div class="image">

                            <a href="#">

                                <img src="vista/images/icon/user.png" alt="" />

                            </a>

                        </div>

                        <div class="content">

                            <h5 class="name">

                                <a href="#"><?php echo $_SESSION['nombre_user']; ?></a>

                            </h5>

                            <span class="email">

                                <?php echo $_SESSION['tipo_user'] ?>

                            </span>

                            <span class="email mt-2">

                                <a href="cambiar-password" class="text-danger">Cambiar Contraseña</a>

                            </span>

                        </div>

                    </div>

                    <div class="account-dropdown__footer">

                        <a href="salir">

                            <i class="zmdi zmdi-power"></i>Cerrar Sesión</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- END HEADER MOBILE -->

