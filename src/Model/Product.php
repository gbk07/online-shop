<?php
class Product
{
    public function getAll():array|false
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=dbname', 'dbuser', 'dbpwd');

        $stmt = $pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function getOneByProductId(int $productId):array|false
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=dbname', 'dbuser', 'dbpwd');

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :product_id");
        $stmt->execute([':product_id' => $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}