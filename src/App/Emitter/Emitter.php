<?php declare(strict_types=1);

namespace Monolog\App\Emitter;

use Psr\Http\Message\ResponseInterface;

class Emitter implements EmitterInterface
{
    public function emmit(ResponseInterface $response): void
    {
        $reasonPhrase = $response->getReasonPhrase();
        $statusCode = $response->getStatusCode();

        $statusHeader = sprintf(
            'HTTP/%s %d%s',
            $response->getProtocolVersion(),
            $statusCode,
            ($reasonPhrase !== '' ? ' ' . $reasonPhrase : '')
        );

        header($statusHeader, true, $statusCode);

        foreach ($response->getHeaders() as $header => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $header, $value));
                header('Location: /dashboard');

            }
        }

        echo $response->getBody();

    }
}