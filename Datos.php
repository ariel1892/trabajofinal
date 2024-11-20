<?php

$host = 'localhost';
$db = 'user_data';   
$user = 'root';      
$password = '';      


$conn = new mysqli($host, $user, $password, $db);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = trim($_POST['name']);

   
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
