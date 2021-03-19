<?php
include './plantilla/Header.php';

$id_usr = $_SESSION['id'];
$id = $_GET['id'];

$update = $conn->prepare("UPDATE carro SET activo = '0' WHERE id_cliente = $id_usr AND id_producto = $id");
$update->execute();
//require 'Index.php';
?>
<script>
    window.location.replace("Pago.php");
</script>