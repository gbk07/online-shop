<?php

namespace Request;

class OrderRequest
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
    public function getNumber(): ?int
    {
        return $this->data['number'] ?? null;
    }
    public function getAddress(): ?string
    {
        return $this->data['address'] ?? null;
    }

    public function validateOrder(): array
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
            }
        } else {
            $errors['email'] = 'email не указан';
        }

        if (isset($this->data['number'])) {
            $number = $this->data['number'];
            if (empty($number)) {
                $errors['number'] = ' не указан';
            } elseif (strlen($number) < 11) {
                $errors['number'] = ' должен иметь от 11 символов';
            }
        } else {
            $errors['number'] = 'number не указан';

        }

        if (isset($this->data['address'])) {
            $address = $this->data['address'];
            if (empty($address)) {
                $errors['address'] = ' не указан';
            }
        } else {
            $errors['address'] = 'address не указан';
        }
        return $errors;
    }
}