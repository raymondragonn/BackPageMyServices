<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

class EmailService {
    public function sendEmail($name, $email, $findus, $actualWeb = null, $budget, $goalWeb, $anyelse = null) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'raymondragon8@gmail.com'; // Cambiar por tu email
            $mail->Password   = 'qprr zrsg tdtz uxhq'; // Cambiar por tu contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Destinatarios
            $mail->setFrom('raymondragon8@gmail.com', 'Ray Mondragon');
            $mail->addAddress('destinatario@gmail.com', 'Destinatario');

            // Contenido del email
            $mail->isHTML(true);
            $mail->Subject = "Nuevo mensaje de contacto";
            $mail->Body = "
                <h3>Hola, soy {$name}</h3>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>¿Cómo nos encontró?:</strong> {$findus}</p>
                <p><strong>Web actual:</strong> " . ($actualWeb ? $actualWeb : 'No proporcionada') . "</p>
                <p><strong>Presupuesto:</strong> {$budget}</p>
                <p><strong>Objetivo para la web:</strong> {$goalWeb}</p>
                <p><strong>Otros comentarios:</strong></p>
                <p>" . nl2br($anyelse ? $anyelse : 'No proporcionado') . "</p>
            ";

            if ($mail->send()) {
                return ['success', 'Mensaje enviado'];
            } else {
                return ['error', 'Error al enviar el mensaje'];
            }
        } catch (Exception $e) {
            return ['error', "Error al enviar el mensaje: {$mail->ErrorInfo}"];
        }
    }
}
?>
