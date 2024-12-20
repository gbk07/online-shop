<?php
namespace Model;
class UserProduct extends Model
{
    private int $id;
    private int $userId;
    private int $product;
    private int $amount;




    public static function getProductId(int $productId): array|false
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $result = $stmt->fetch();
        return $result;

    }

    public static function exists(int $productId, int $userId): array|false
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $result = $stmt->fetch();
        return $result;

    }
    public static function addProduct(int $userId, int $productId, int $amount)
    {
        $stmt = self::getPdo()->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $amount]);
    }

    public static function updateAmount(int $userId,int $productId, int $amount)
    {
        $stmt = self::getPdo()->prepare("UPDATE user_products SET amount = amount + :amount WHERE user_id = :user_id  and product_id = :product_id");
        $stmt->execute(['amount' => $amount, 'user_id' => $userId, 'product_id' => $productId]);

    }

    public static function deleteProduct(int $userId, int $productId, int $amount)
    {
        $stmt = self::getPdo()->prepare("SELECT amount FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $product = $stmt->fetch();

        if ($product) {
            $newAmount = $product['amount'] - $amount;

            if ($newAmount > 0) {
                $stmt = self::getPdo()->prepare("UPDATE user_products SET amount = :amount WHERE user_id = :user_id AND product_id = :product_id");
                $stmt->execute(['amount' => $newAmount, 'user_id' => $userId, 'product_id' => $productId]);
            } else {
                $stmt = self::getPdo()->prepare("DELETE FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
                $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            }
        }
    }
    public static function deleteUserProducts($userId)
    {
        $stmt = self::getPdo()->prepare("DELETE FROM user_products WHERE user_id = :userId");
        $stmt->execute(['userId' => $userId]);
    }

    public static function getAllByUserId(int $userId): ?array
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll();
        if ($result === false){
            return [];
        }
        $productsObj = [];
        foreach ($result as $product){
            $obj = new self();
            $obj->id = $product['id'];
            $obj->userId = $product['user_id'];
            $obj->product= $product['product_id'];
            $obj->amount = $product['amount'];
            $productsObj[] = $obj;
        }
        return $productsObj;

    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }
    public function getProduct(): int
    {
        return $this->product;
    }

}