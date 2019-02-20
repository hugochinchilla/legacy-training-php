<?php

namespace App\Domain\Actions;

use App\Domain\Entities\Password;


class RegisterUserRequest
{
    private $name;
    private $email;
    private $password;

    public function __construct(string $name, string $email, Password $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function name()
    {
        return $this->name;
    }    

    public function email()
    {
        return $this->email;
    }    
    
    public function password()
    {
        return $this->password;
    }        

    public static function fromRequest($request)
    {
        return new self(
            $request->get('name'),
            $request->get('email'),
            new Password($request->get('password'))
        );
    }
}