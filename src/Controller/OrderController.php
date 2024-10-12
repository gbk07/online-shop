<?php
namespace Controller;
use Model\Order;
use Model\UserProduct;
use Model\Model;
use Request\OrderRequest;

class OrderController extends Model
{
    public function orderPlacement()
    {
        require_once './../View/orderPlacement.php';
    }

    public function orderPlaced()
    {
        require_once './../View/orderPlaced.php';
    }

    public function placeOrder(OrderRequest $request)
    {
        session_start();
        if (!isset($_SESSION['logged_in_user_id'])) {
            header('Location: /login');
        }

        $userId = $_SESSION['logged_in_user_id'];
        $errors = $request->validateOrder();

        if (empty($errors)) {
            $name = $request->getName();
            $email = $request->getEmail();
            $number = $request->getNumber();
            $address = $request->getAddress();

            $orderModel = new Order();
            $orderId = $orderModel->createOrder($name, $email, $number, $address);

            $orderModel = new UserProduct();
            $result = $orderModel->getAllByUserId($userId);

            foreach ($result as $userProduct) {
                $stmt = $this->pdo->prepare("INSERT INTO orders_products (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
                $stmt->execute(['orderId' => $orderId, 'productId' => $userProduct->getProduct() , 'amount' => $userProduct->getAmount(),
                ]);
            }

            $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :userId");
            $stmt->execute(['userId' => $userId]);

            header('Location: /orderPlaced');
        }
        require_once './../View/orderPlacement.php';
    }
}
