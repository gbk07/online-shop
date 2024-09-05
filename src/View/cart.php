<form action="/cart" method="GET">
<div class="container">
    <h3>Shopping cart</h3>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
            <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                    </div>
                    <img class="card-img-top" src="<?php echo $product['product_image'];?>" alt="Card image">
                    <div class="card-body">
                        <p <h2 class="card-title"><?php echo $product['product_name'];?></h2> </p>
                        <a href="#"><h5 class="card-title"><?php echo $product['product_category'];?></h5></a>
                        <div class="card-footer">
                            <?php echo $product['price'] . 'руб';?>
                        </div>
                        <?php echo 'количество: '. $product['amount'] . 'шт';?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }
</style>

