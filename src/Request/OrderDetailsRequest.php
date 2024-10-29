<?php

namespace Request;

class OrderDetailsRequest
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

    public function getOrderId(): ?int
    {
        return $this->data['order_id'] ?? null;
    }

    public function validateDetails(): array
    {
        $errors = [];
        if (!isset($this->data['order_id'])) {
            $errors['order_id'] = "Order id is required";
        }
        return $errors;
    }
}
