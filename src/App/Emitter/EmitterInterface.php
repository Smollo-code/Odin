<?php declare(strict_types=1);

namespace Monolog\App\Emitter;

use Psr\Http\Message\ResponseInterface;

interface EmitterInterface
{
    public function emmit(ResponseInterface $response): void;
}