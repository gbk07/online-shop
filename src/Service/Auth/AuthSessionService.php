<?php

namespace Service\Auth;

use Model\User;

class AuthSessionService implements AuthServiceInterface
{
    public function login(string$userName, string $password): bool
    {

        $result = User:: getOneByEmail($userName);

        if(empty ($result)) {
            return false;
        }

        if (password_verify($password, $result->getPassword())) {
            session_start();
            $_SESSION["logged_in_user_id"] = $result->getId();
            return true;
        }
        return false;
    }
    public function getCurrentUser(): ?User
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION["logged_in_user_id"]))
        {
            return null;
        }

        return User:: getOneById($_SESSION["logged_in_user_id"]);

    }
    public function check(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION["logged_in_user_id"]);
    }

}