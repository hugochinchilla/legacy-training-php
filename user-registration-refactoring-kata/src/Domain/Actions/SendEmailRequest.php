<?php

namespace App\Domain\Actions;

class SendEmailRequest
{
    private $from;
    private $to;
    private $subject;
    private $body;

    public function __construct(string $to, string $subject, string $body) 
    {
        $this->from = 'codium@codium.com';
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }       

    public function from()
    {
        return $this->from;
    }

    public function to()
    {
        return $this->to;
    }

    public function subject()
    {
        return $this->subject;
    }

    public function body()
    {
        return $this->body;
    }
}
