<?php

namespace Request;
class LoginRequest
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
    public function getUsername(): ?string
    {
        return $this->data['username'] ?? null;
    }
    public function getPassword(): ?string
    {
        return $this->data['password'] ?? null;
    }
    public function validateLogin(): array
    {
        $errors = [];
        if (isset($this->data['username'])) {
            $username = $this->data['username'];
            if (empty($username)) {
                $errors['username'] = 'Заполните поле username';
            }
        } else {
            $errors['username'] = 'name не указан';
        }

        if (isset($this->data['password'])) {
            $password = $this->data['password'];
            if (empty($password)) {
                $errors['password'] = 'заполните поле password';
            }
        } else {
            $errors['password'] = 'password не указан';
        }
        return $errors;
    }
}