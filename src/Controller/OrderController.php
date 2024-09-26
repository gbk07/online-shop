<?php
namespace Controller;
use Model\Order;
use Model\UserProduct;
use Model\Model;

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

    public function placeOrder()
    {
        session_start();
        if (!isset($_SESSION['logged_in_user_id'])) {
            header('Location: /login');
        }

        $userId = $_SESSION['logged_in_user_id'];
        $errors = $this->validateOrder($_POST);

        if (empty($errors)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $address = $_POST['address'];

            $orderModel = new Order();
            $orderId = $orderModel->createOrder($name, $email, $number, $address);

            $orderModel = new UserProduct();
            $result = $orderModel->getAllByUserId($userId);

            foreach ($result as $userProduct) {
                $stmt = $this->pdo->prepare("INSERT INTO orders_products (order_id, product_id, amount) VALUES (:orderId, :productId, :amount)");
                $stmt->execute(['orderId' => $orderId, 'productId' => $userProduct['product_id'], 'amount' => $userProduct['amount'],
                ]);
            }

            $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :userId");
            $stmt->execute(['userId' => $userId]);

            header('Location: /orderPlaced');
        }
        require_once './../View/orderPlacement.php';
    }

    private function validateOrder(array $data)
    {
        $errors = [];
        if (isset($data['name'])) {
            $name = $data['name'];
            if (empty($name)) {
                $errors['name'] = 'Заполните поле Name';
            } elseif (strlen($name) < 2) {
                $errors['name'] = ' должен иметь от 2 символов';
            } elseif (preg_match("/[0-9]/", $name)) {
                $errors['name'] = ' не должен содержать цифр';
            }
        } else {
            $errors['name'] = 'name не указан';
        }
        if (isset($data['email'])) {
            $email = $data['email'];
            if (empty($email)) {
                $errors['email'] = ' не указан';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = ' адрес указан неверно';
            }
        } else {
            $errors['email'] = 'email не указан';
        }

        if (isset($data['number'])) {
            $number = $data['number'];
            if (empty($number)) {
                $errors['number'] = ' не указан';
            } elseif (strlen($number) < 11) {
                $errors['number'] = ' должен иметь от 11 символов';
            }
        } else {
            $errors['number'] = 'number не указан';

        }

        if (isset($data['address'])) {
            $address = $data['address'];
            if (empty($address)) {
                $errors['address'] = ' не указан';
            }
        } else {
            $errors['address'] = 'address не указан';
        }
        return $errors;
    }
}
