<?php
$servername = "localhost";
$username = "root"; // El nombre de usuario de tu base de datos
$password = ""; // La contraseña de tu base de datos
$dbname = "tienda_online"; // El nombre de tu base de datos

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>