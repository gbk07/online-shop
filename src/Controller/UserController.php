<?php
namespace Controller;

use Model\User;
use Request\LoginRequest;
use Request\RegistrateRequest;
use Service\Auth\AuthServiceInterface;
use Service\Auth\AuthSessionService;

class UserController
{
    private AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function registrate (RegistrateRequest $request)
    {
        $errors = $request->validate();
        if (empty($errors)) {

            $name = $request->getName();
            $email = $request->getEmail();
            $psw = $request->getPsw();
            $pswRep = $request->getPswRep();

            $pswHash = password_hash($psw, PASSWORD_DEFAULT);

            $userModel = new User();
            $userModel->create($name, $email, $pswHash);

            header('Location: /login');
        }
        require_once './../View/get_registration.php';
    }

    public function getRegistrate()
    {
        require_once './../View/get_registration.php';
    }

    public function login(LoginRequest $request)
    {
        $errors = $request->validateLogin();
        if (empty($errors)) {
            $username = $request->getUsername();
            $password = $request->getPassword();

            $result = $this->authService->login($username, $password);

            if ($result) {
                header("Location: /catalog");

            } else {
                $errors['password'] = 'email or password is incorrect';
            }
            require_once './../View/get_login.php';
        }
    }

    public function getLogin()
    {
        require_once './../View/get_login.php';
    }
}
