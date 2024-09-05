<?php
require_once './../Model/UserProduct.php';
require_once './../Model/Product.php';
class CartController
{
    public function getAddProduct()
    {
        require_once './../View/get_add_product.php';
    }
    public function addProduct()
    {
        session_start();
        if (!isset($_SESSION['logged_in_user_id'])) {
            header('Location:/login');
        }

        $errors = $this->validate($_POST);
        $userId = $_SESSION['logged_in_user_id'];

        if (empty($errors)) {
            $productId = $_POST['product_id'];
            $amount = $_POST['amount'];
            $userProductModel = new UserProduct();
            $result = $userProductModel->exists($productId, $userId);
            if (empty($result)) {
                $userProductModel->addProduct($userId, $productId, $amount);
            } else {
                $userProductModel->updateAmount($userId, $productId, $amount);
            }
        }

        require_once './../View/get_add_product.php';
    }

    private function validate(array $data)
    {
        $errors = [];

        if (isset($data['product_id'])) {
            $productId = $data['product_id'];
            if (empty($productId)) {
                $errors['product_id'] = 'id товара не может быть пустым';
            } else {
                $userProductModel = new UserProduct();
                $result = $userProductModel->getProductId($data['product_id']);
                if (empty($result)) {
                    $errors['product_id'] = 'ProductId не существует';
                }
            }
        } else {
            $errors['product_id'] = 'product_id не указан';
        }

        if (isset($data['amount'])) {
            $amount = $data['amount'];
            if (empty($amount) || $amount <= 0) {
                $errors['amount'] = 'количество товара должно быть больше 0';
            }
        } else {
            $errors['amount'] = 'amount не указан';
        }

        return $errors;
    }
    public function getCart()
    {
        session_start();
        if(!isset($_SESSION["logged_in_user_id"])){
            header("Location: /login");
        }
        $userId = $_SESSION['logged_in_user_id'];

        $UserProductModel = new UserProduct();
        $userProducts = $UserProductModel->getAllByUserId($userId);

        $productModel = new Product();
        $products = [];
        foreach ($userProducts as $userProduct) {
            $product = $productModel->getOneByProductId($userProduct['product_id']);
            if ($product) {
                $product['amount'] = $userProduct['amount'];
                $products[] = $product;
            }
        }

        require_once './../View/cart.php';
    }
}


