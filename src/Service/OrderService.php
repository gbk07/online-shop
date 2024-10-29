<?php


namespace Service;

use Model\Order;
use Model\OrderProducts;
use Model\UserProduct;
use Model\Model;
use Throwable;
use Service\LoggerService;

class OrderService
{

    public function create(int $userId, string $name, string $email, string $number, string $address): bool
    {

        $userProducts = UserProduct:: getAllByUserId($userId);

        Model::getPdo()->beginTransaction();
        try {

            $orderId = Order:: createOrder($name, $email, $number, $address, $userId);

            OrderProducts:: addOrderProducts($orderId, $userProducts);

            UserProduct:: deleteUserProducts($userId);

            Model::getPdo()->commit();

            return true;
        } catch (Throwable $exception) {
            Model::getPdo()->rollBack();

            $logger = new LoggerService();
            $logger->error($exception);

            return false;
        }
    }
}
