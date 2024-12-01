<?php

namespace App\DTO;

class Notification
{
    public function __construct(public string $title, public string $message)
    {
    }

    public static function create(string $title, string $message): self
    {
        return new self($title, $message);
    }
}
