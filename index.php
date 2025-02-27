<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/servicesController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["status" => "error", "message" => "Faltan parámetros en la solicitud"]);
        exit;
    }

    $controller = new ServicesController();
    $response = $controller->sendEmail($data);

    echo json_encode($response);
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
exit;
?>
