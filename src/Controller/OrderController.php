<?php
namespace Controller;
use Model\Order;
use Request\OrderRequest;
use Service\Auth\AuthServiceInterface;
use Service\Auth\AuthSessionService;
use Service\OrderService;
use Request\OrderDetailsRequest;


class OrderController
{
    private AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
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
        if (!$this->authService->check()) {
            header('Location:/login');
        }

        $userId = $this->authService->getCurrentUser()->getId();
        $errors = $request->validateOrder();

        if (empty($errors)) {
            $name = $request->getName();
            $email = $request->getEmail();
            $number = $request->getNumber();
            $address = $request->getAddress();

            $orderService = new OrderService();
            $success = $orderService->create($userId, $name, $email, $number, $address);

            if ($success) {
                header('Location: /orderPlaced');
            } else {
                http_response_code(500);
                require_once './../View/500.php';
            }
        }

        require_once './../View/orderPlacement.php';
    }

    public function productOrders()
    {
        require_once './../View/productOrders.php';
    }

    public function getProductOrders()
    {

        if (!$this->authService->check()) {
            header('Location: /login');
            exit();
        }

        $userId = $this->authService->getCurrentUser()->getId();
        $orderModel = new Order();
        $orders = $orderModel->getOrdersByUserId($userId);

        require_once './../View/productOrders.php';
    }

    public function myOrderDetails(OrderDetailsRequest $request)
    {
        if (!$this->authService->check()) {
            header('Location:/login');
        }
        $userId = $this->authService->getCurrentUser()->getId();
        $errors = $request->validateDetails();

        if (empty($errors)) {
            $orderId = $request->getOrderId();
            $orderModel = new Order();
            $orderDetails = $orderModel->getOrderDetails($orderId);
        }

        require_once './../View/orderDetails.php';
    }

}