<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

class ServicesModel {
    public function sendEmail($data) {
        $mail = new PHPMailer(true);
        
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'raymondragon8@gmail.com'; // Cambiar por tu email
            $mail->Password   = 'jtno gpsj lyxj npuv'; // Cambiar por tu contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->SMTPKeepAlive = true;

            // Remitente y destinatario
            $mail->setFrom($data['email'], $data['name']);
            $mail->addAddress('raymondragon8@gmail.com', 'Ray Mondragon');

            // Configuración del contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Cliente interesado en un Sitio Web';
            
            // Construcción del cuerpo del correo
            $body = '<div style="font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; max-width: 500px;">
                        <h2 style="color: #333; border-bottom: 2px solid #007BFF; padding-bottom: 10px;">Detalles del Cliente</h2>
                        <p><strong>Nombre:</strong> ' . htmlspecialchars($data['name']) . '</p>
                        <p><strong>Email:</strong> <a href="mailto:' . htmlspecialchars($data['email']) . '" style="color: #007BFF;">' . htmlspecialchars($data['email']) . '</a></p>
                        <p><strong>¿Cómo nos encontró?:</strong> ' . htmlspecialchars($data['findus']) . '</p>
                        <p><strong>Presupuesto:</strong> ' . htmlspecialchars($data['budget']) . '</p>
                        <p><strong>Objetivo Web:</strong> ' . nl2br(htmlspecialchars($data['goalWeb'])) . '</p>';
            
            // Atributos opcionales
            if (!empty($data['actualWeb'])) {
                $body .= '<p><strong>Sitio Web Actual:</strong> ' . htmlspecialchars($data['actualWeb']) . '</p>';
            }
            if (!empty($data['anyelse'])) {
                $body .= '<p><strong>Comentarios adicionales:</strong> ' . nl2br(htmlspecialchars($data['anyelse'])) . '</p>';
            }
            
            $body .= '</div>';
            $mail->Body = $body;
            
            // Envío del correo
            $mail->send();
            return ["success", "Mensaje enviado"];
        } catch (Exception $e) {
            return ["error", "Error al enviar el correo: " . $mail->ErrorInfo];
        }
    }
}
?>