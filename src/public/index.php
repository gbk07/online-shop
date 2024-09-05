<?php
require_once './../Controller/UserController.php';
require_once './../Controller/ProductController.php';
require_once './../Controller/CartController.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];


if($requestUri === '/login') {
    if($requestMethod === 'GET') {
        require_once './../Controller/UserController.php';
        $userController = new UserController();
        $userController->getLogin();
    } elseif($requestMethod === 'POST') {
        $userController = new UserController();
        $userController->login();
    } else{
        echo 'Invalid request method';
    }
} elseif ($requestUri === '/registrate'){
    if($requestMethod === 'GET') {

        $userController = new UserController();
        $userController->getRegistrate();
    } elseif($requestMethod === 'POST') {
        $userController = new UserController();
        $userController->registrate();
    } else{
        echo 'Invalid request method';
    }
} elseif ($requestUri === '/catalog') {
    if($requestMethod === 'GET') {
        $productController = new ProductController();
        $productController->Catalog();
    }else{
        echo 'Invalid request method';
    }
} elseif ($requestUri === '/product'){
    if($requestMethod === 'GET') {
        $productController = new CartController();
        $productController->getAddProduct();
    }elseif ($requestMethod === 'POST') {
        $productController = new CartController();
        $productController->addProduct();
    }else {
        echo 'Invalid request method';
    }
}
  elseif ($requestUri === '/cart'){
    if($requestMethod === 'GET') {
        $cartController = new CartController();
        $cartController->getCart();
    } else{
        echo 'Invalid request method';
    }
} else{
    http_response_code(404);
    require_once './../View/404.php';
}