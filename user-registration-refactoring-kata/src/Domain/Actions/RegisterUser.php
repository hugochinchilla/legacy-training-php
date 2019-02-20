<?php

namespace App\Domain\Actions;

use App\Model\User;
use App\Repository\InMemoryUserRepository;
use App\Domain\Entities\Password;
use App\Domain\Builder\UserBuilder;
use App\Domain\Actions\SendEmail;


class RegisterUser
{
    /** @var InMemoryUserRepository */
    public static $orm;

    public function execute(RegisterUserRequest $request)
    {
        if ($this->orm()->findByEmail($request->email()) !== null) {
            throw new \Exception("The email is already in use");
        }

        $user_builder = new UserBuilder($this->orm());
        $user = $user_builder
            ->withEmail($request->email())
            ->withName($request->email())
            ->withPassword($request->password())
            ->build();
        
        $email = new SendEmailRequest(
            $request->email(),
            "Welcome to Codium",
            'This is the HTML message body <b>in bold!</b>'
        );

        $send_email = new SendEmail();
        $send_email->execute($email);
    }

    private function orm(): InMemoryUserRepository
    {
        if (null === self::$orm) {
            self::$orm = new InMemoryUserRepository();
        }
        return self::$orm;
    }    
}