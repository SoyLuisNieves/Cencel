

<body class="theme-indigo">
    <!-- Page Loader -->
    <!-- #END# Page Loader -->
    <!-- Search Bar -->
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="">CENCEL</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="javascript:void(0);" class="" data-close="true">Almacen:: </a></li>
                    <li class=""><a href="javascript:void(0);" class="">Fecha de Acceso:: </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section>

    <?php
        if ($var==1) {
            include('models/almacenes.php');
            include('models/proveedores.php');
            include("models/usuarios.php");
            include('models/pedidos.php');
            include('models/inventarios.php');
            include('models/productos.php');
            include("models/departamentos.php"); 
            include("models/catalogos.php");
            include("models/traspasos.php");
        } else {
            include('../../models/almacenes.php');
            include('../../models/proveedores.php');
            include("../../models/usuarios.php");
            include('../../models/pedidos.php');
            include('../../models/inventarios.php');
            include('../../models/productos.php');
            include("../../models/departamentos.php"); 
            include("../../models/catalogos.php");
            include("../../models/traspasos.php");
            }

        $Almacen = new Almacen(); 
        $Proveedor = new Proveedor();
        $Usuario = new Usuario();
        $Pedidos = new Pedidos(); 
        $Traspasos = new Traspasos(); 
        $Inventarios = new Inventarios();
        $Productos = new Producto();
        $Departamento = new Departamento();
        $Catalogo = new Catalogo();

        date_default_timezone_set("America/chicago");
    ?>
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICACIONES</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 Nuevos Miembros</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 Pedidos</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Pedidos </b> Cancelados</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Pedidos </b>Modificados</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                            </li>
                        </ul> 
                    </li> -->                   
                    <!-- <?php
                    echo '<li><a href="'.$linka.'" >Registrar</a></li>
                    <li><a href="'.$linkm.'">Modificar / Inhabilitar</a></li>'?>
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section> -->