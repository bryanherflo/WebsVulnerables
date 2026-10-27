<?php
// CORRECCIÓN (CWE-200 / CWE-489): endpoint de depuración eliminado.
// Exponía el identificador de sesión, las cookies recibidas, el contenido de
// $_SESSION y los parámetros de la cookie a cualquier visitante sin autenticar.
http_response_code(404);
exit;
