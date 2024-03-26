<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css');?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tail.select.min.css');?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/default.css');?>">
    <script src="<?= base_url('assets/js/uikit.min.js');?>"></script>
    <script src="<?= base_url('assets/js/uikit-icons.min.js');?>"></script>
    <script src="<?= base_url('assets/js/tail.select.min.js');?>"></script>
    <script src="<?= base_url('assets/js/purecounter.min.js');?>"></script>
    <script src="<?= base_url('assets/fontawesome/js/all.min.js');?>" defer></script>
</head>

<body>
<nav class="uk-navbar-container uk-navbar-transparent">
    <div class="uk-container">
        <div uk-navbar>
            <div class="uk-navbar-left">
                <a href="#" class="uk-navbar-item uk-logo">Nombre de la Aplicación</a>
            </div>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-language"></i> <span class="uk-text-uppercase">Idioma</span>
                        </a>
                        <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="#">Español</a></li>
                                <li><a href="#">Inglés</a></li>
                                <!-- Otros idiomas aquí -->
                            </ul>
                        </div>
                    </li>
                    <li class="uk-visible@s">
                        <a href="#"><i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión</a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="uk-border-circle" src="assets/images/avatar-placeholder.jpg" width="32" height="32" alt="Avatar">
                            <span class="uk-text-middle"><span uk-icon="icon: triangle-down"></span></span>
                        </a>
                        <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="#">Panel de Usuario</a></li>
                                <li><a href="#">Panel de Administrador</a></li>
                                <li><a href="#">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-cart-shopping"></i> <span class="uk-badge">0</span>
                        </a>
                        <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                            <div class="cart-container">
                                <p class="uk-text-center uk-margin-remove">Carrito está vacío</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="uk-navbar-container">
    <div class="uk-container">
        <nav uk-navbar="mode: click">
            <div class="uk-navbar-left">
                <a href="#offcanvas_nav" class="uk-navbar-toggle uk-hidden@s" uk-navbar-toggle-icon uk-toggle></a>
                <ul class="uk-navbar-nav">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li class="uk-parent">
                        <a href="#">
                            <span class="bc-li-icon"><i class="fas fa-caret-down"></i></span> Productos
                        </a>
                        <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="#">Producto 1</a></li>
                                <li><a href="#">Producto 2</a></li>
                                <!-- Otros productos aquí -->
                            </ul>
                        </div>
                    </li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
