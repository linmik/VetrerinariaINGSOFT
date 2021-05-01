<!DOCTYPE html>
<html lang="en">
<?php

require('C:\laragon\www\VetrerinariaINGSOFT\src\database\connection.php');

session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
flush(); // Flush the buffer
ob_flush();

if (!empty($_SESSION['id'])){


    $id_usr = $_SESSION['id'];
    $carrito = $conn -> prepare("
	SELECT * FROM carro WHERE activo = 1 AND id_cliente = $id_usr");
    //Libro
    $carrito ->execute();
    $carrito = $carrito ->fetchAll();
}
else{
    $id_usr = "0";
    $carrito = $conn -> prepare("
	SELECT * FROM carro WHERE activo = 1 AND id_cliente = $id_usr");
    //Libro
    $carrito ->execute();
    $carrito = $carrito ->fetchAll();
}



?>
<head>
    <meta charset="UTF-8">
    <title>Veterinaria</title>
    <link rel="stylesheet" href="http://vetrerinariaingsoft.test/src/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--    <link rel="stylesheet" href="CSS/Estilos.css">-->
    <link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/WebIcon.png">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Import materialize.css-->
    <script src="js/materialize.min.js"></script>
    <link type="text/CSS" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<header>
    <!--		<div class="wrapp">-->
    <!--				<a href="index.php" title="VETERINARIA">VETERINARIA<a class="bordes" href="index.php" title="Nombre">Tequila</a></a>-->
    <!--						<div class="usuario">-->
    <!--                <a href="cerrar.php" title="Cerrar Sesion"> Cerrar Sesion</a>-->
    <!--            </div>-->
    <!--		</div>-->
    <ul id="dropdown1" class="dropdown-content">

        <?php
//        echo $id_usr;
        if(!empty($_SESSION['id'])){
            ECHO "<li class=\"divider\"></li>
            <li><a href=\"VerCompras.php\"><i class=\"material-icons\">store</i>Compras</a></li>
            <li class=\"divider\"></li>
            
            ";
            ECHO "<li class=\"divider\"></li>
            <li><a href=\"VerMascotas.php\"><i class=\"material-icons\">pets</i>Mascotas</a></li>
            <li class=\"divider\"></li>
            
            ";
            if($_SESSION['tipo'] == "Administrador"){
                Echo "<li><a href=\"AgregarProducto.php\" title=\"Agregar Producto\"><i class=\"material-icons\">library_add</i>Agregar Producto</span></div></a></li>
        ";
                Echo "<li><a href=\"AgregarServicio.php\" title=\"Agregar Servicio\"><i class=\"material-icons\">library_add</i>Agregar Servicio</span></div></a></li>
            <li class=\"divider\"></li>
        ";
            }
        }else{
            Echo "<li><a href=\"views/clients/AddClient.php\" title=\"Nuevo cliente\"><i class=\"material-icons\">assignment_ind</i>Nuevo cliente</span></div></a></li>
        ";
        }

        ?>
        <!--        <li class="divider"></li>-->
        <!--        <li><a href="VerCompras.php"><i class="material-icons">store</i>Compras</a></li>-->
        <!--        <li class="divider"></li>-->
        <?php
        if (!empty($_SESSION['id'])){
            Echo "<li><a href=\"cerrar.php\" title=\"Cerrar Sesion\"><i class=\"material-icons\">power_settings_new</i>Cerrar Sesion</span></div></a></li>
                        ";
        }else{
            Echo "<li><a href=\"Login.php\" title=\"Iniciar Sesion\"><i class=\"material-icons\">perm_identity</i>Iniciar Sesion</a></li>";
        }

        //        ?>
        <!--        <li><a href="Login.php" title="Iniciar Sesion" class="center-align"><i class="material-icons right">perm_identity</i> Iniciar Sesion </a></li>-->
        <!--        <li><a href="cerrar.php" title="Cerrar Sesion" class="center-align"><i class="material-icons right">power_settings_new</i> Cerrar Sesion </a></li>-->
    </ul>
    <nav>

        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a href="Index.php" class="brand-logo">Veterinaria</a>


                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <div class="center left">
                        <?php
                        if (!empty($_SESSION['id'])){
                            $suma = count($carrito) ;
                            Echo "<li><a href=\"Pago.php\"><i class=\"material-icons\">shopping_cart</i><span class=\"new badge green\" data-badge-caption=\"En carrito\">$suma</span></div></a></li>
                        ";
                        }else{

                        }

                        ?>
                    </div>
                    <div class="center right">
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons right">view_module</i></a></li>

                    </div>
                    <div class="center">
                        <?php
//echo $_SERVER['REQUEST_URI'];
                        if($_SERVER['REQUEST_URI'] == '/Buscar.php'){
                            Echo "<form type='hidden' action=\"Buscar.php\" method=\"post\" id=\"search\">
                                <div type='hidden' class=\"input-field inline\">
                                    <input type='hidden' name=\"busqueda\" id=\"busqueda\" type=\"text\" class=\"validate\">
                                    
                                </div>
                                <form type='hidden' action=\"Buscar.php\" method=\"post\" id=\"search\">
                                    
                                </form>
                            </form>";
                        }else{
                            Echo "<form action=\"Buscar.php\" method=\"post\" id=\"search\">
                                <div class=\"input-field inline\">
                                    <input name=\"busqueda\" id=\"busqueda\" type=\"text\" class=\"validate\">
                                    <label for=\"busqueda\">Nombre, descripción, codigo.</label>
                                </div>
                                <form action=\"Buscar.php\" method=\"post\" id=\"search\">
                                    <button class=\"btn-floating btn-large waves-effect waves-light blue\" type=\"submit\" form=\"search\"><i class=\"material-icons\">search</i></button>
                                </form>
                            </form>";
                        }
                        ?>

                    </div>


                    <!--                        --><?php
                    //                        if (!empty($_SESSION['id'])){
                    //                            $suma = count($carrito) ;
                    //                            Echo "<div class='center right'> <li><a href=\"Pago.php\"><i class=\"material-icons\">shopping_cart</i><span class=\"new badge green\" data-badge-caption=\"En carrito\">$suma</span></div></a></li></div>
                    //                        ";
                    //                        }else{
                    //
                    //                        }
                    //
                    //                        ?>

                    <!--                    <li><a href="Pago.html"><i class="material-icons">shopping_cart</i> <span class="new badge" data-badge-caption="En carrito">1</span></div></a></li>-->



                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="Buscar.php"><i class="material-icons">search</i>Buscador</a></li>

            <?php
            if(!empty($_SESSION['id'])){
                ECHO "<li class=\"divider\"></li>
            <li><a href=\"VerCompras.php\"><i class=\"material-icons\">store</i>Compras</a></li>
            <li class=\"divider\"></li>
            ";
                ECHO "
            <li><a href=\"VerMascotas.php\"><i class=\"material-icons\">pets</i>Mascotas</a></li>
            
            ";
                if($_SESSION['tipo'] == "Administrador"){
                    Echo "<li><a href=\"AgregarProducto.php\" title=\"Agregar Libro\"><i class=\"material-icons\">library_add</i>Agregar producto</span></div></a></li>

        ";
                }
            }else{
                Echo "<li><a href=\"RegistroCliente.php\" title=\"Nuevo cliente\"><i class=\"material-icons\">assignment_ind</i>Nuevo cliente</span></div></a></li>
        ";
            }

            ?>

            <?php
            if (!empty($_SESSION['id'])){
                Echo "<li><a href=\"Pago.php\"><i class=\"material-icons\">shopping_cart</i><span class=\"new badge green\" data-badge-caption=\"En carrito\">$suma</span></div></a></li>
                        ";
            }else{

            }

            ?>
            <?php
            if (!empty($_SESSION['id'])){
                Echo "<li><a href=\"cerrar.php\" title=\"Cerrar Sesion\"><i class=\"material-icons\">power_settings_new</i>Cerrar Sesion</span></div></a></li>
                        ";
            }else{
                Echo "<li><a href=\"Login.php\" title=\"Iniciar Sesion\"><i class=\"material-icons\">perm_identity</i>Iniciar Sesion</a></li>";
            }

            //        ?>
        </ul>

    </nav>
    <br><br><br><br>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instances = M.AutoInit();
    });
</script>
