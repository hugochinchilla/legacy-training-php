<?php

namespace App\Domain\Builder;

use App\Domain\Entities\Password;
use App\Repository\UserRepositoryInterface;
use App\Model\User;

class UserBuilder
{
    private $repo;
    private $name;
    private $email;
    private $password;

    public function __construct(UserRepositoryInterface $repo=null)
    {
        /*
        if (null === $repo) {
            $repo = InMemoryUserRepository::getInstance();
        }       
        */

        $this->repo = $repo;

        $this->id = uniqid();
    }

    public function withName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function withEmail($email)
    {
        $this->email = $email;
        return $this;
    }    

    public function withPassword(Password $password)
    {
        $this->password = $password;
        return $this;
    }        

    public function withId($id)
    {
        $this->id = $id;
        return $this;
    }            

    public function build()
    {
        $user = new User($this->id, $this->name, $this->email, $this->password);
        $this->repo->save($user);

        return $user;
    }
}


