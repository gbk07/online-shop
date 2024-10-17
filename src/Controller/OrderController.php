<?php
namespace Controller;
use Model\Order;
use Model\OrderProducts;
use Model\UserProduct;
use Request\OrderRequest;
use Service\LoggerService;
use Throwable;
use Model\Model;


class OrderController
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

            $userProductModel = new UserProduct();
            $result = $userProductModel->getAllByUserId($userId);

            $orderModel = new Order();
            $orderProductsModel = new OrderProducts();

            Model::getPdo()->beginTransaction();
            try{
                $orderId = $orderModel->createOrder($name, $email, $number, $address);
                $orderProductsModel->addOrderProducts($orderId, $result);
                $orderProductsModel->deleteUserProducts($userId);

                Model::getPdo()->commit();

                header('Location: /orderPlaced');
            } catch (Throwable $exception) {

                Model::getPdo()->rollBack();

                $logger = new LoggerService();
                $logger->error($exception);
                http_response_code(500);
                require_once './../View/500.php';
            }
        }
        require_once './../View/orderPlacement.php';
    }
}
