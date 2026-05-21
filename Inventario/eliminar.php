<?php
include 'Config/conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM productos WHERE id='$id'";

if ($conn->query($sql)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error al eliminar";
}
?>