<?php

namespace Core;

class Container
{
    private array $services = [];
    public function get(string $className): object
    {
        $callback = $this->services[$className];
        return $callback();

    }
    public function set(string $className, callable $callback)
    {
        $this->services[$className] = $callback;
    }

}