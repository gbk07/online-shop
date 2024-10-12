<div class="container">
    <h3>Корзина покупок</h3>
    <div class="card-deck">
        <?php
        $totalPrice = 0;
        foreach ($products as $product):
            $totalPrice += $product->getPrice() * $product->getAmount(); // Суммируем цену
            ?>
            <div class="card text-center">
                <a href="#">
                    <img class="card-img-top" src="<?php echo $product->getImage(); ?>" alt="Card image">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $product->getName(); ?></h2>
                        <h5 class="card-category"><?php echo $product->getCategory(); ?></h5>
                        <div class="card-footer">
                            <span class="price"><?php echo $product->getPrice() . ' руб'; ?></span>
                        </div>
                        <div class="amount">
                            <?php echo 'Количество: ' . $product->getAmount() . ' шт'; ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="total-price">
        <h4>Общая цена: <?php echo $totalPrice . ' руб'; ?></h4>
    </div>

    <a href="/order" class="order-btn">Оформить заказ</a>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .card-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .card {
        width: 100%;
        max-width: 300px;
        margin: 15px;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 18px;
        color: #333;
        margin: 10px 0;
    }

    .card-category {
        font-size: 14px;
        color: #777;
        margin: 5px 0;
    }

    .card-footer {
        font-weight: bold;
        font-size: 16px;
        color: #28a745; /* Зеленый цвет для цены */
        margin-top: 10px;
    }

    .amount {
        font-size: 14px;
        color: #555;
        margin-top: 10px;
    }

    .total-price {
        text-align: center;
        margin-top: 30px;
        font-weight: bold;
        font-size: 20px;
        color: #333;
    }

    .order-btn {
        display: block;
        width: 200px;
        margin: 20px auto;
        text-align: center;
        padding: 10px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .order-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }
</style>
