<?php
namespace Controller;
use Model\Product;
use Service\Auth\AuthServiceInterface;
use Service\Auth\AuthSessionService;

class ProductController
{
    private AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function catalog()
    {

        if (!$this->authService->check()) {
            header('Location:/login');
        }

        $productModel = new Product();

        $products = $productModel->getAll();


        require_once './../View/get_catalog.php';

    }
}