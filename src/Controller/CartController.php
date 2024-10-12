<?php
namespace Controller;
use Model\UserProduct;
use Model\Product;
use Request\AddProductRequest;
use Request\DeleteProductRequest;

class CartController
{

    public function addProduct(AddProductRequest $request)
    {
        session_start();
        if (!isset($_SESSION['logged_in_user_id'])) {
            header('Location:/login');
        }

        $errors = $request->validate();
        $userId = $_SESSION['logged_in_user_id'];

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();
            $userProductModel = new UserProduct();
            $result = $userProductModel->exists($productId, $userId);
            if (empty($result)) {
                $userProductModel->addProduct($userId, $productId, $amount);
            } else {
                $userProductModel->updateAmount($userId, $productId, $amount);
            }
        }

        header ("Location:/catalog");
    }
    public function deleteProduct(DeleteProductRequest $request)
    {
        session_start();
        if (!isset($_SESSION['logged_in_user_id'])) {
            header('Location:/login');
        }

        $errors = $request->validate();
        $userId = $_SESSION['logged_in_user_id'];

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();
            $userProductModel = new UserProduct();
            $userProductModel->deleteProduct($userId, $productId, $amount);
            }

        header ("Location:/catalog");
    }
    public function getCart()
    {
        session_start();
        if (!isset($_SESSION["logged_in_user_id"])) {
            header("Location: /login");
        }

        $userId = $_SESSION['logged_in_user_id'];
        $UserProductModel = new UserProduct();
        $userProducts = $UserProductModel->getAllByUserId($userId);

        $productModel = new Product();
        $products = [];

        foreach ($userProducts as $userProduct) {
            $productId = $userProduct->getProduct();
            $amount = $userProduct->getAmount();
            $product = $productModel->getOneByProductId($productId);

            if ($product) {
                $product->setAmount($amount);
                $products[] = $product;
            }
        }

        require_once './../View/cart.php';
    }

}


