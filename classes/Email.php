<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '80e9052275c8e3';
        $mail->Password = '1e1774440149c0';

        $mail->setFrom('cuentas@taskmper.com');
        $mail->addAddress('cuentas@taskmper.com', 'taskmper.com');
        $mail->Subject = 'Confirma tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

        $contenido ='<html>';
        $contenido .="<p><strong>Hola " . $this->nombre . "</strong> Has Creado tu cuenta 
        en taskmper, solo debes confirmarla en el siguiente enlace</p>";
        $contenido .="<p>Presiona aqui: <a href='http://localhost:3000/confirmar?token=" .
        $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .="<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .='</html>';
        $mail->Body = $contenido;

        //Enviar email
        $mail->send();
    }

}