<?php

namespace Monolog\App\Session;

use Psr\Http\Server\RequestHandlerInterface;

interface SessionInterface
{
    public function isLoggedIn(): bool;
}