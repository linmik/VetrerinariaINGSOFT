<?php
include './plantilla/Header.php';
$total = 0;

$id_usr = $_SESSION['id'];
$tipo = $_SESSION['tipo'];
//echo $_SESSION['tipo'];
if($tipo == "Cliente"){
    $venta = $conn -> prepare("
	SELECT * FROM venta WHERE id_cliente = $id_usr");
    $citas = $conn -> prepare("
	SELECT * FROM cita WHERE id_cliente = $id_usr");
}
if($tipo == "Administrador"){
    $venta = $conn -> prepare("
	SELECT * FROM venta ORDER BY id_cliente");
    $citas = $conn -> prepare("
	SELECT * FROM cita ORDER  BY id_cliente");
}
if($tipo == "Veterinario"){
    $venta = $conn -> prepare("
	SELECT * FROM venta ORDER BY id_cliente");
    $id_vet = $_SESSION['id'];
    $citas = $conn -> prepare("
	SELECT * FROM cita WHERE id_veterinario = $id_vet ORDER  BY id_cliente");
}


//Libro
$venta ->execute();
$venta = $venta ->fetchAll();
$citas ->execute();
$citas = $citas ->fetchAll();

?>

<?php if($tipo == "Veterinario" OR $tipo == "Cliente" OR $tipo == "Administrador"){
//    echo $tipo;
    ?>
    <div class="container">

    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text green">
                <span class="card-title" align='center'>SERVICIOS COMPRADOS</span>
            </div>
        </div>
    </div>
    <table class="responsive-table">
        <thead>
        <tr>
            <th>NOMBRE DEL PRODUCTO/SERVICIO</th>
            <th>CODIGO</th>
            <?php if($tipo=="Administrador" OR $tipo == "Veterinario"){
                ECHO "<th>CLIENTE</th>";
            }
            ?>
            <th>FECHA DE CONSULTA</th>
            <th>PRECIO</th>
            <th colspan="3">ACCIONES</th>

        </tr>
        </thead>
        <?php foreach ($citas as $Sql): $id_cliente = $Sql['id_cliente'];
            $id_cita = $Sql['id_cita'];?>
            <?php
//        echo

            $id_servicio = $Sql['id_servicio'];
            $id_servicioC = $Sql['id_servicio'];
            $id_servicio = $conn -> prepare("
	SELECT * FROM servicio WHERE activo = '1' AND id_servicio = $id_servicio");
//Libro
            $id_servicio ->execute();
            $id_servicio = $id_servicio ->fetchAll();
//            echo $Total = count($libros);
            foreach ($id_servicio as $SqlServicio):

                ?>
                <tr>
                    <?php $str = strtoupper($SqlServicio['nombre']); echo "<td>". $str ."</td>"; ?>
                    <?php echo "<td>". $SqlServicio['codigo'] ."</td>"; ?>
                    <?php if($tipo=="Administrador" OR $tipo == "Veterinario"){
                        ECHO "<td> $id_cliente </td>";
                    }
                    ?>
                    <?php echo "<td>". $Sql['fecha_consulta'] ."</td>"; ?>
                    <?php echo "<td> $". $SqlServicio['costo'] ."</td>"; ?>
                    <?php $total = $total + $SqlServicio['costo'];?>
                    <?php echo "<td>
                                <form action='VerProducto.php' method='get'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_servicioC'>
                                <i class='material-icons'>visibility</i>
                                </button>
                                </form></td>"; ?>

                    <?php
                    if($Sql['activo']==1) {

                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small red\"><i class=\"material-icons\">announcement</i></button>
                                </td>";
                    }if($Sql['activo']==2){
                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small yellow\"><i class=\"material-icons\">send</i></button>
                                </td>";

                    }if($Sql['activo']==3){
                        ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small green\"><i class=\"material-icons\">check</i></button>
                                </td>";
                    }?>
                    <?php if($tipo=="Administrador" OR $tipo == "Veterinario"){
//                        echo $id_cliente;
//                        $id_venta = $Sql['id_venta'];
                        echo "<td>
                                <form action='EditarPago.php' method='post'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_cita'>
                                <i class='material-icons'>create</i>
                                </button>
                                </form></td>";
                    }
                    ?>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>

    </table>
    <br>
    <br>

    </div>

    <?php
}if($tipo == "Cliente" OR $tipo == "Administrador"){
    ?>

    <div class="container">
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text green">
                    <span class="card-title" align='center'>PRODUCTOS COMPRADOS</span>
                </div>
            </div>
        </div>
        <table class="responsive-table">
            <thead>
            <tr>
                <th>NOMBRE DEL PRODUCTO/SERVICIO</th>
                <th>CODIGO</th>
                <?php if ($tipo == "Administrador") {
                    ECHO "<th>CLIENTE</th>";
                }
                ?>
                <th>GUIA DE ENVIO</th>
                <th>PRECIO</th>
                <th colspan="3">ACCIONES</th>

            </tr>
            </thead>
            <?php foreach ($venta as $Sql): $id_cliente = $Sql['id_cliente'];
                $id_venta = $Sql['id_venta']; ?>
                <?php
//        echo

                $id_producto = $Sql['id_producto'];
                $id_productoC = $Sql['id_producto'];
                $id_producto = $conn->prepare("
	SELECT * FROM producto WHERE activo = '1' AND id_producto = $id_producto");
//Libro
                $id_producto->execute();
                $id_producto = $id_producto->fetchAll();
//            echo $Total = count($libros);
                foreach ($id_producto as $SqlProducto):

                    ?>
                    <tr>
                        <?php $str = strtoupper($SqlProducto['nombre']);
                        echo "<td>" . $str . "</td>"; ?>
                        <?php echo "<td>" . $SqlProducto['codigo'] . "</td>"; ?>
                        <?php if ($tipo == "Administrador") {
                            ECHO "<td> $id_cliente </td>";
                        }
                        ?>
                        <?php echo "<td>" . $Sql['guia_de_envio'] . "</td>"; ?>
                        <?php echo "<td> $" . $SqlProducto['costo'] . "</td>"; ?>
                        <?php $total = $total + $SqlProducto['costo']; ?>
                        <?php echo "<td>
                                <form action='VerProducto.php' method='get'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_productoC'>
                                <i class='material-icons'>visibility</i>
                                </button>
                                </form></td>"; ?>

                        <?php
                        if ($Sql['activo'] == 1) {

                            ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small red\"><i class=\"material-icons\">announcement</i></button>
                                </td>";
                        }
                        if ($Sql['activo'] == 2) {
                            ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small yellow\"><i class=\"material-icons\">send</i></button>
                                </td>";

                        }
                        if ($Sql['activo'] == 3) {
                            ECHO "<td>
                                <button class=\"waves-effect waves-light btn-small green\"><i class=\"material-icons\">check</i></button>
                                </td>";
                        } ?>
                        <?php if ($_SESSION['tipo'] == "Administrador") {
//                        echo $id_cliente;
//                        $id_venta = $Sql['id_venta'];
                            echo "<td>
                                <form action='EditarPago.php' method='post'>
                                <button class='btn waves-effect waves-light blue' type='submit' name='id' value='$id_venta'>
                                <i class='material-icons'>create</i>
                                </button>
                                </form></td>";
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

        </table>
        <br>
        <br>

    </div>

    <?php
}
?>



<?php include './plantilla/PieDePagina.php'; ?>

</body>

</html>

