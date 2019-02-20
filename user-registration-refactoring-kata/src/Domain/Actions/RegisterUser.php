<?php

namespace App\Domain\Actions;

use App\Model\User;
use App\Repository\InMemoryUserRepository;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\HttpFoundation\Response;

class RegisterUser
{
    /** @var InMemoryUserRepository */
    public static $orm;

    public function execute($request)
    {
        if (strlen($request->get('password')) <= 8 || strpos($request->get('password'), '_') === false) {
            throw new \Exception('Password is not valid');
        }
        if ($this->orm()->findByEmail($request->get('email')) !== null) {
            throw new \Exception("The email is already in use");
        }

        $user = new User(rand(0, 10000), $request->get('name'), $request->get('email'), $request->get('password'));
        $this->orm()->save($user);

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp1.example.com;smtp2.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'user@example.com';
            $mail->Password = 'secret';

            $mail->setFrom("noreply@codium.team", 'Codium Team');
            $mail->addAddress($request->get('email'), $request->get('name'));

            $mail->isHTML(true);
            $mail->Subject = "Welcome to Codium";
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
//        $mail->send();
        } catch (Exception $e) {
        }

    }

    private function orm(): InMemoryUserRepository
    {
        if (self::$orm == null) {
            self::$orm = new InMemoryUserRepository();
        }
        return self::$orm;
    }    
}