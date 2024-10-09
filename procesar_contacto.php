<?php
// Parámetros de conexión a la base de datos
$servername = "localhost";  // Servidor donde se encuentra la base de datos
$username = "root";          // Usuario de la base de datos
$password = "";              // Contraseña de la base de datos
$dbname = "proyectowebvalledupar"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['gmail'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO contacto (nombre, gmail, telefono, mensaje) VALUES (?, ?, ?, ?)";

    // Usar una declaración preparada para evitar inyección SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $correo, $telefono, $mensaje); // "ssss" indica que los 4 parámetros son strings

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Los datos han sido enviados y almacenados correctamente.";
    } else {
        echo "Error al almacenar los datos: " . $conn->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>





