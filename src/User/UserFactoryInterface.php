<?php
declare(strict_types=1);

namespace Monolog\User;

use PDO;
use Psr\Http\Server\RequestHandlerInterface;

interface UserFactoryInterface
{
    public function createRegisterGetHandler(): RequestHandlerInterface;

    public function createProfileHandler(): RequestHandlerInterface;

    public function createProfileDataTransmitterGetHandler(): RequestHandlerInterface;

    public function createLoginGetHandler(): RequestHandlerInterface;

    public function createIndexGetHandler(): RequestHandlerInterface;

    public function createTicTacToeGetHandler(): RequestHandlerInterface;

    public function createEmailerGetHandler(): RequestHandlerInterface;

    public function createDashboardGetHandler(): RequestHandlerInterface;

    public function createCalculatorGetHandler(): RequestHandlerInterface;

    public function createDeleteHandler(): RequestHandlerInterface;

    public function createEmailSenderGetHandler(): RequestHandlerInterface;

    public function createUserHandler(): RequestHandlerInterface;

}