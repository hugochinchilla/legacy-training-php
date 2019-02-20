<?php
namespace App\Domain\Entities;

class Password
{
    private $password;

    public function __construct(string $password) 
    {
        if ($this->isTooShort($password) || $this->doesNotContainUnderscores($password))
        {
            throw new \Exception('Password is not valid');
        }

        $this->password = $password;
    }       

    public function __toString()
    {
        return $this->password;
    }

    public function value()
    {
        return $this->password;
    }

    private function isTooShort($password)
    {
        return strlen($password) <= 8;
    }

    private function doesNotContainUnderscores($password)
    {
        return strpos($password, '_') === false;
    }
}
