<?php

namespace App\Domain\Actions;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Domain\Entities\Email;

class SendEmail
{
    public function execute(Email $email)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp1.example.com;smtp2.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'user@example.com';
            $mail->Password = 'secret';


            $mail->isHTML(true);
            $mail->setFrom($email->from());

            
            $mail->addAddress($email->to());
            $mail->Subject = $email->subject();
            $mail->Body = $email->body();
//        $mail->send();
        } catch (Exception $e) {
        }
    }
}