<?php
namespace Model;
use PDO;
class Product extends Model

{
    private int $id;
    private string $name;
    private string $category;
    private int $price;
    private string $image;
    private int $amount;

    public function getAll(): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($products === false){
            return null;
        }
        $productsObj = [];
        foreach ($products as $productData){
            $obj = new self();
            $obj->id = $productData['id'];
            $obj->name = $productData['product_name'];
            $obj->category = $productData['product_category'];
            $obj->price = $productData['price'];
            $obj->image = $productData['product_image'];
            $productsObj[] = $obj;
        }
        return $productsObj;
    }

    public function getOneByProductId(int $productId): ?self
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=dbname', 'dbuser', 'dbpwd');

        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :product_id");
        $stmt->execute([':product_id' => $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }
        $obj = new self();
        $obj->id = $result['id'];
        $obj->name = $result['product_name'];
        $obj->category = $result['product_category'];
        $obj->price = $result['price'];
        $obj->image = $result['product_image'];
        return $obj;

    }
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getCategory(): string
    {
        return $this->category;
    }
    public function getPrice(): int
    {
        return $this->price;
    }
    public function getImage(): string
    {
        return $this->image;
    }
}