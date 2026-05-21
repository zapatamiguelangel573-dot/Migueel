<?php
$host = "localhost";
$usuario = "root";
$contrasena = "braman82";
$db = "inventario_db";

$conn = new mysqli($host, $usuario, $contrasena, $db);
    
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>