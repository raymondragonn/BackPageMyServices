<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Allow: POST, OPTIONS");
header('content-type: application/json; charset=utf-8');
require 'servicesModel.php';

$emailService = new EmailService();

$requestUri = $_SERVER['REQUEST_URI'];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));

        // Asignar valores predeterminados si las variables no están presentes
        $actualWeb = isset($_POST->actualWeb) ? $_POST->actualWeb : null;
        $anyelse = isset($_POST->anyelse) ? $_POST->anyelse : null;

        if (isset($_POST->name, $_POST->email, $_POST->findus, $_POST->budget, $_POST->goalWeb)) {
            // Llamar al servicio de envío de email pasando los valores (si existen o no)
            $respuesta = $emailService->sendEmail(
                $_POST->name,
                $_POST->email,
                $_POST->findus,
                $actualWeb,
                $_POST->budget,
                $_POST->goalWeb,
                $anyelse
            );
        } else {
            $respuesta = ['error', 'Faltan parámetros en la solicitud'];
        }

        echo json_encode($respuesta);
    break;

    case 'OPTIONS':
        exit(0);
    break;
}
?>
