<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Calc;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\Session;
use Monolog\App\Session\SessionInterface;
use Monolog\Calculator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

error_reporting(5);


class CalculatorGetHandler implements RequestHandlerInterface
{

    public function __construct(
        private Calculator $calc,
        private Environment $renderer,
        private SessionInterface $session
    ) {
    }

    private function hasOneOperator(string $input): bool
    {
        $operatorArray = ['+', '-', '*', '/',];
        foreach ($operatorArray as $operator) {
            if (str_contains($input, $operator)) {
                return true;
            }
        }
        return false;
    }

    private function hasBracket(string $input): bool
    {
        $brackets = ['(', ')', '[', ']', '{', '}'];
        foreach ($brackets as $bracket) {
            if (str_contains($input, $bracket)) {
                return true;
            }
        }
        return false;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }

        $parseBody = $request->getParsedBody();

        $result = $parseBody['input'] ?? '';

        if (!$this->hasOneOperator($result)) {
            $error = 'Fehler bei Eingabe';
        } elseif ($this->hasBracket($result)) {
            $error = 'Fehler bei Eingabe';
        } else {
            $endResult = $this->calc->getResult($result);
        }

        return new Response(
            200,
            [],
            $this->renderer->render('main.twig', ['result' => $endResult, 'error' => $error ?? ''])
        );
    }
}