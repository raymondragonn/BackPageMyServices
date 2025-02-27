<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Allow: POST, OPTIONS");
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/servicesModel.php';

$model = new ServicesModel();

$requestUri = $_SERVER['REQUEST_URI'];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['name'], $data['email'], $data['findus'], $data['budget'], $data['goalWeb'])) {
            $respuesta = $model->sendEmail($data);
        } else {
            $respuesta = ["error", "Faltan parámetros en la solicitud"];
        }

        echo json_encode($respuesta);
        exit;

    case 'OPTIONS':
        exit(0);
}
?>
