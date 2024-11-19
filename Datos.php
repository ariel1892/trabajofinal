<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Cambia esto si usas un host diferente
$db = 'user_data';   // Nombre de la base de datos
$user = 'root';      // Usuario de la base de datos
$password = '';      // Contraseña del usuario (deja en blanco si no hay)

// Establecer conexión
$conn = new mysqli($host, $user, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se recibió un nombre a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = trim($_POST['name']);

    // Validar que el nombre no esté vacío
    if (!empty($name)) {
        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare("INSERT INTO names (name) VALUES (?)");
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            echo "Nombre guardado correctamente.";
        } else {
            echo "Error al guardar el nombre: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "El nombre no puede estar vacío.";
    }
} else {
    echo "Método no permitido o datos incompletos.";
}

$conn->close();
?>
