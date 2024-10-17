<?php
namespace Controller;

use Model\User;
use mysql_xdevapi\Exception;
use PDO;
use Request\LoginRequest;
use Request\RegistrateRequest;

class UserController
{
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

            $userModel = new User();
            $result = $userModel->getOneByEmail($username);

            if ($result === null) {
                $errors['username'] = 'email or password is incorrect';
            } else {
                if (password_verify($password, $result->getPassword())) {
                    session_start();
                    $_SESSION["logged_in_user_id"] = $result->getId();
                    header("Location: /catalog");
                } else {
                    $errors['password'] = 'email or password is incorrect';
                }
            }
            require_once './../View/get_login.php';
        }
    }

    public function getLogin()
    {
        require_once './../View/get_login.php';
    }
}
