<?php
namespace Model;

class Order extends Model
{
    public  static function createOrder(string $name, string $email, int $number, string $address, $userId)
    {
        $stmt = self::getPdo()->prepare("INSERT INTO orders (name, email, number, address, user_id) VALUES (:name, :email, :number, :address, :user_id) RETURNING id");
        $stmt->execute(['name' => $name, 'email' => $email, 'number' => $number, 'address' => $address, 'user_id' => $userId]);
        return $stmt->fetchColumn();
    }
    public static function getOrdersByUserId(int $userId): array
    {
        $stmt = self::getPdo()->prepare("SELECT orders.id, orders_products.product_id 
                                              FROM orders 
                                              INNER JOIN orders_products 
                                              ON orders.id = orders_products.order_id 
                                              WHERE orders.user_id = :user_id 
                                              ORDER BY orders.id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public static function getOrderDetails(int $orderId): array
    {
        $stmt = self::getPdo()->prepare("
        SELECT 
        orders.id AS order_id,
        orders.name AS order_name,
        orders.number AS order_number,
        orders.address AS order_address,
        orders_products.product_id AS product_id,
        orders_products.amount AS product_amount,
        products.product_name AS product_name,
        products.price AS product_price,         
        products.product_image AS product_image
        FROM 
        orders
        JOIN 
        orders_products ON orders.id = orders_products.order_id
        JOIN 
        products ON orders_products.product_id = products.id
        WHERE 
        orders.id = :orderId;");

        $stmt->execute(['orderId' => $orderId]);

        return $stmt->fetchAll();
    }
}
