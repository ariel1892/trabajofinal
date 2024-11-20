<?php
//  conexión a la base de datos
$host = 'localhost';
$db = 'user_data';
$user = 'root';
$password = '';


$conn = new mysqli($host, $user, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$result = $conn->query("SELECT name FROM names ORDER BY created_at DESC");

$names = [];
while ($row = $result->fetch_assoc()) {
    $names[] = $row['name'];
}


header('Content-Type: application/json');
echo json_encode(['names' => $names]);

$conn->close();
?>
