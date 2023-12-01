<?php

namespace Monolog\User\Handler\Calc;

use GuzzleHttp\Psr7\Response;
use Monolog\Calculator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

error_reporting(5);


class CalculatorGetHandler implements RequestHandlerInterface
{

    public function __construct(private Calculator $calc, private Environment $renderer)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $parseBody = $request->getParsedBody();
        function hasOneOperator (string $input) : bool {
            $operatorArray = ['+', '-', '*', '/',];
            foreach ($operatorArray as $operator) {
                if (str_contains($input, $operator)) {
                    return true;
                }
            }
            return false;
        }

        function hasBracket (string $input) : bool
        {
            $brackets = ['(', ')', '[', ']', '{', '}'];
            foreach ($brackets as $bracket) {
                if (str_contains($input, $bracket)) {
                    return true;
                }
            }
            return false;
        }

        $result = $parseBody['input'] ?? '';

        if (!hasOneOperator($result)) {
            $error = 'Fehler bei Eingabe';

        } elseif (hasBracket($result)) {
            $error = 'Fehler bei Eingabe';

        } else {
            $endResult = $this->calc->getResult($result);
        }

        return new Response(200, [], $this->renderer->render('main.twig', ['result' => $endResult, 'error' => $error ?? '']));
    }
}