<?php
// Conexión a base de datos mediante variables de entorno.
// CORRECCIÓN (CWE-798): no se almacenan credenciales en el código fuente.
$db_host = getenv('DB_HOST') ?: 'db3';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME') ?: 'enterprise';

if ($db_pass === false) {
    error_log('DB_PASS no está definida en el entorno');
    http_response_code(500);
    die('Error interno: configuración de base de datos incompleta.');
}

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    // CORRECCIÓN (CWE-209): no se exponen detalles internos al usuario.
    error_log('DB connection failed: ' . $conn->connect_error);
    http_response_code(500);
    die('Error interno de conexión a la base de datos.');
}
$conn->set_charset('utf8mb4');
?>
