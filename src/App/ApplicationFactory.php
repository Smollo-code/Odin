<?php
declare(strict_types=1);

namespace Monolog\App;

use Monolog\App\Emitter\Emitter;
use Monolog\App\Session\Session;
use Monolog\App\Session\SessionInterface;
use Monolog\Calculator;
use Monolog\User\Model\User\UserRepository;
use Monolog\User\UserFactory;
use Monolog\User\UserFactoryInterface;
use PDO;
use Twig\Environment;

class ApplicationFactory
{
    public function createUserFactory(): UserFactoryInterface
    {
        return new UserFactory($this);
    }

    public function createCalculator(): Calculator
    {
        return new Calculator();
    }

    public function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }

    public function createPdo(): PDO
    {
        return new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');
    }

    public function createTwig(): Environment
    {
        $loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
        return new \Twig\Environment($loader, [
            'cache' => false,
        ]);
    }

    public function emitter(): Emitter
    {
        return new Emitter();
    }

    public function createSession(): SessionInterface
    {
        return new Session($_SESSION);
    }

}