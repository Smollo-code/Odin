<?php

declare(strict_types=1);

namespace Monolog\User;

use Monolog\App\ApplicationFactory;
use Monolog\User\Handler\Calc\CalculatorGetHandler;
use Monolog\User\Handler\Dashboard\DashboardGetHandler;
use Monolog\User\Handler\Emailer\EmailerGetHandler;
use Monolog\User\Handler\Emailer\EmailSenderGetHandler;
use Monolog\User\Handler\Error\ErrorGetHandler;
use Monolog\User\Handler\Games\GewinntGetHandler;
use Monolog\User\Handler\Games\RouletteDatabaseHandler;
use Monolog\User\Handler\Games\RouletteGetHandler;
use Monolog\User\Handler\Games\TicTacToeGetHandler;
use Monolog\User\Handler\Index\IndexGetHandler;
use Monolog\User\Handler\Login\LoginGetHandler;
use Monolog\User\Handler\Logout\LogoutGetHandler;
use Monolog\User\Handler\Profile\ProfileDeleteGetHandler;
use Monolog\User\Handler\Profile\ProfileGetHandler;
use Monolog\User\Handler\Profile\UserGetHandler;
use Monolog\User\Handler\Register\RegisterGetHandler;
use Monolog\User\Handler\Profile\ProfileDataTransmitterGetHandler;
use PDO;
use Psr\Http\Server\RequestHandlerInterface;

class UserFactory implements UserFactoryInterface
{
    public function __construct(private ApplicationFactory $applicationFactory)
    {
    }

    public function createRegisterGetHandler(): RequestHandlerInterface
    {
        return new RegisterGetHandler(
            $this->applicationFactory->createUserRepository(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createProfileHandler(): RequestHandlerInterface
    {
        return new ProfileGetHandler(
            $this->applicationFactory->createUserRepository(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createProfileDataTransmitterGetHandler(): RequestHandlerInterface
    {
        return new ProfileDataTransmitterGetHandler(
            $this->applicationFactory->createUserRepository(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createPdo(),
            $this->applicationFactory->createSession()
        );
    }

    public function createLoginGetHandler(): RequestHandlerInterface
    {
        return new LoginGetHandler(
            $this->applicationFactory->createPdo(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession(),
            $this->applicationFactory->createUserRepository()

        );
    }

    public function createIndexGetHandler(): RequestHandlerInterface
    {
        return new IndexGetHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createTicTacToeGetHandler(): RequestHandlerInterface
    {
        return new TicTacToeGetHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createEmailerGetHandler(): RequestHandlerInterface
    {
        return new EmailerGetHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createDashboardGetHandler(): RequestHandlerInterface
    {
        return new DashboardGetHandler(
            $this->applicationFactory->createPdo(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createCalculatorGetHandler(): RequestHandlerInterface
    {
        return new CalculatorGetHandler(
            $this->applicationFactory->createCalculator(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createDeleteHandler(): RequestHandlerInterface
    {
        return new ProfileDeleteGetHandler(
            $this->applicationFactory->createUserRepository(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createEmailSenderGetHandler(): RequestHandlerInterface
    {
        return new EmailSenderGetHandler(
            $this->applicationFactory->createUserRepository(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createLogoutGetHandler(): RequestHandlerInterface
    {
        return new LogoutGetHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createGewinntHandler(): RequestHandlerInterface
    {
        return new GewinntGetHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createErrorGetHandler(): RequestHandlerInterface
    {
        return new ErrorGetHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession()
        );
    }

    public function createRouletteHandler(): RequestHandlerInterface
    {
        return new RouletteGetHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createUserRepository(),
            $this->applicationFactory->createSession()
        );
    }

    public function createUserHandler(): RequestHandlerInterface
    {
        return new UserGetHandler(
            $this->applicationFactory->createPdo(),
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createSession(),
            $this->applicationFactory->createUserRepository()
        );
    }

    public function createRouletteDatabaseHandler(): RequestHandlerInterface
    {
        return new RouletteDatabaseHandler(
            $this->applicationFactory->createTwig(),
            $this->applicationFactory->createUserRepository(),
            $this->applicationFactory->createSession()
        );
    }

}