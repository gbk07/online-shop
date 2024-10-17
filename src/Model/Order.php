<?php
namespace Model;

class Order extends Model
{
    public function createOrder(string $name, string $email, int $number, string $address)
    {
        $stmt = self::getPdo()->prepare("INSERT INTO orders (name, email, number, address) VALUES (:name, :email, :number, :address) RETURNING id");
        $stmt->execute(['name' => $name, 'email' => $email, 'number' => $number, 'address' => $address]);
        return $stmt->fetchColumn();
    }
}
