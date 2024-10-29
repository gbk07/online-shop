<?php

use Core\App;

$autoloader = function (string $className){
    $modifiedClassName = str_replace('\\', '/', $className);
    $path = __DIR__ . "/../$modifiedClassName.php";
    if (file_exists($path)) {
        require_once $path;
        return true;
    }
    return false;
};
spl_autoload_register($autoloader);

$container = new \Core\Container();
$container->set(\Controller\CartController::class, function () {
    $cartService = new \Service\CartService();
    $authService = new \Service\Auth\authSessionService();


    return new \Controller\CartController($cartService, $authService);
});
$container->set(\Controller\OrderController::Class, function() {
    $authService = new \Service\Auth\authSessionService();

    return new \Controller\OrderController($authService);
});
$container->set(\Controller\UserController::Class, function() {
    $authService = new \Service\Auth\authSessionService();
    return new \Controller\UserController($authService);
});
$container->set(\Controller\ProductController::Class, function() {
    $authService = new \Service\Auth\authSessionService();
    return new \Controller\ProductController($authService);
});
$app = new App($container);
$app->createRoute('/login', 'GET', \Controller\UserController::class, 'getLogin');
$app->createRoute('/login', 'POST', \Controller\UserController::class, 'login', \Request\LoginRequest::class);
$app->createRoute('/registrate', 'GET', \Controller\UserController::class, 'getRegistrate');
$app->createRoute('/registrate', 'POST', \Controller\UserController::class, 'registrate', \Request\RegistrateRequest::class);
$app->createRoute('/catalog', 'GET', \Controller\ProductController::class, 'Catalog');
$app->createRoute('/addProduct', 'POST', \Controller\CartController::class, 'addProduct', \Request\AddProductRequest::class);
$app->createRoute('/deleteProduct', 'POST', \Controller\CartController::class, 'deleteProduct', \Request\DeleteProductRequest::class);
$app->createRoute('/cart', 'GET', \Controller\CartController::class, 'getCart');
$app->createRoute('/order', 'GET', \Controller\OrderController::class, 'orderPlacement');
$app->createRoute('/order', 'POST', \Controller\OrderController::class, 'placeOrder', \Request\OrderRequest::class);
$app->createRoute('/orderPlaced', 'GET', \Controller\OrderController::class, 'orderPlacement');
$app->createRoute('/productOrders', 'GET', \Controller\OrderController::class, 'getProductOrders');
$app->createRoute('/orderDetails', 'POST', \Controller\OrderController::class, 'myOrderDetails', \Request\OrderDetailsRequest::class);











$app->run();