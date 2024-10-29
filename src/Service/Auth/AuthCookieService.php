<?php

namespace Service\Auth;

use Model\User;

class AuthCookieService implements AuthServiceInterface
{
    public function login(string$userName, string $password): bool
    {

        $result = User:: getOneByEmail($userName);

        if(empty ($result)) {
            return false;
        }

        if (password_verify($password, $result->getPassword())) {
            setcookie("logged_in_user_id", $result->getId());
            return true;
        }
        return false;
    }
    public function getCurrentUser(): ?User
    {

        if(!isset($_COOKIE["logged_in_user_id"]))
        {
            return null;
        }

        return User:: getOneById($_COOKIE["logged_in_user_id"]);

    }
    public function check(): bool
    {

        return isset($_COOKIE["logged_in_user_id"]);
    }

}