<div class="container">
    <h3>Catalog</h3>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
        <form action="/addProduct" method="POST">
        <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                    </div>
                    <img class="card-img-top" src="<?php echo $product['product_image'];?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $product['product_category'];?></p>
                        <a href="#"><h5 class="card-title"><?php echo $product['product_name'];?></h5></a>
                        <div class="card-footer">
                            <?php echo $product['price'] . 'руб';?>
                        </div>
                    </div>
                </a>
            </div>
            <input type="hidden" id="product_id" name="product_id" value="<?php echo $product['id'];?>" required>
            <input type="text" id="amount" name="amount" required>
            <button type="submit" class="registerbtn">Добавить в корзину</button>
        </form>
        <?php endforeach; ?>
        <a href="/cart"> перейти в корзину </a>
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

