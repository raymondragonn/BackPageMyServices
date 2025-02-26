<?php
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/'));

// Verificar si la ruta es la esperada
if ($segments[0] == '' || $segments[0] == 'BackPageMyServices') {
    include 'servicesController.php';
} else {
    echo "Página no encontrada.";
}
?>
