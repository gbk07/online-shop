<?php

namespace Model;

class OrderProducts extends Model
{
    public function addOrderProducts($orderId, $products)
    {
        foreach ($products as $userProduct) {
            $stmt = self::getPdo()->prepare("INSERT INTO orders_products (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
            $stmt->execute([
                'orderId' => $orderId, 'productId' => $userProduct->getProduct(), 'amount' => $userProduct->getAmount(),
            ]);
        }
    }
    public function deleteUserProducts($userId)
    {
        $stmt = self::getPdo()->prepare("DELETE FROM user_products WHERE user_id = :userId");
        $stmt->execute(['userId' => $userId]);
    }
}
