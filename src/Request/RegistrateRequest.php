<?php

namespace Request;

use Model\User;

class RegistrateRequest
{
    private string $method;
    private string $uri;
    private array $data;

    public function __construct(string $method, string $uri, array $data)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->data = $data;
    }
    public function getMethod(): string
    {
        return $this->method;
    }
    public function getUri(): string
    {
        return $this->uri;
    }
    public function getData(): array
    {
        return $this->data;
    }
    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }
    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }
    public function getPsw(): ?string
    {
        return $this->data['psw'] ?? null;
    }
    public function getPswRep(): ?string
    {
        return $this->data['psw-repeat'] ?? null;
    }

    public function validate(): array
    {
        $errors = [];
        if (isset($this->data['name'])) {
            $name = $this->data['name'];
            if (empty($name)) {
                $errors['name'] = 'Заполните поле Name';
            } elseif (strlen($name) < 2) {
                $errors['name'] = ' должен иметь от 2 символов';
            } elseif (preg_match("/[0-9]/", $name)) {
                $errors['name'] = ' не должен содержать цифр';
            }
        } else {
            $errors['name'] = 'name не указан';
        }

        if (isset($this->data['email'])) {
            $email = $this->data['email'];
            if (empty($email)) {
                $errors['email'] = ' не указан';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = ' адрес указан неверно';
            } else {
                $userModel = new User();
                $result = $userModel->getOneByEmail($this->data['email']);
                if (!empty($result)) {
                    $errors['email'] = ' ранее зарегистрирован в базе данных';
                }
            }
        } else {
            $errors['email'] = 'email не указан';
        }

        if (isset($this->data['psw'])) {
            $psw = $this->data['psw'];
            if (empty($psw)) {
                $errors['psw'] = ' не указан';
            } elseif (strlen($psw) < 6) {
                $errors['psw'] = ' должен иметь от 6 символов';
            }
        } else {
            $errors['psw'] = 'password не указан';
        }

        if (isset($this->data['psw-repeat'])) {
            $pswRep = $this->data['psw-repeat'];
            if (empty($pswRep)) {
                $errors['psw-repeat'] = ' не указан';
            } elseif ($psw !== $pswRep) {
                $errors['psw-repeat'] = 'Пароли не совпадают';
            }
        } else {
            $errors['psw-repeat'] = 'pswRep не указан';
        }
        return $errors;
    }



}