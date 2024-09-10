<?php
class Order
{
    public function createOrder(string $name, string $email, int $number, string $address)
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=dbname', 'dbuser', 'dbpwd');

        $stmt = $pdo->prepare("INSERT INTO orders (name, email, number, address) VALUES (:name, :email, :number, :address) RETURNING id");
        $stmt->execute(['name' => $name, 'email' => $email, 'number' => $number, 'address' => $address]);
        return $stmt->fetchColumn();
    }
}
