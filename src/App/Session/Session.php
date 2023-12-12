<?php

namespace Monolog\App\Session;

class Session implements SessionInterface
{

    public function __construct(private array $session)
    {
    }

    public function isLoggedIn(): bool
    {
        return array_key_exists('userId', $this->session) && $this->session['userId'] > 0;
    }
}