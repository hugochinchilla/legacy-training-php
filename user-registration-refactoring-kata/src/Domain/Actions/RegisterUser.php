<?php

namespace App\Domain\Actions;

use App\Model\User;
use App\Repository\InMemoryUserRepository;
use App\Domain\Entities\Email;
use App\Domain\Entities\Password;
use App\Domain\Actions\SendEmail;


class RegisterUser
{
    /** @var InMemoryUserRepository */
    public static $orm;

    public function execute($request)
    {
        $password = new Password($request->get('password'));

        if ($this->orm()->findByEmail($request->get('email')) !== null) {
            throw new \Exception("The email is already in use");
        }

        $user = new User(uniqid(), $request->get('name'), $request->get('email'), $password->value());
        $this->orm()->save($user);

        $email = new Email(
            $request->get('email'),
            "Welcome to Codium",
            'This is the HTML message body <b>in bold!</b>'
        );

        $send_email = new SendEmail();
        $send_email->execute($email);
    }

    private function orm(): InMemoryUserRepository
    {
        if (self::$orm == null) {
            self::$orm = new InMemoryUserRepository();
        }
        return self::$orm;
    }    
}