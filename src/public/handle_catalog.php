<?php
require_once './../Controller/ProductController.php';

$products = new ProductController();
$products->catalog();