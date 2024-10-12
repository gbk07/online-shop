<div class="container">
    <h3>Каталог</h3>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
            <div class="card text-center">
                <a href="#">
                    <img class="card-img-top" src="<?php echo $product->getImage(); ?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $product->getCategory(); ?></p>
                        <h5 class="card-title"><?php echo $product->getName(); ?></h5>
                        <div class="card-footer">
                            <span class="price"><?php echo $product->getPrice() . ' руб'; ?></span>
                        </div>
                    </div>
                </a>
                <form action="/addProduct" method="POST" class="product-form">
                    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" required>
                    <div class="quantity-container">
                        <input type="number" name="amount" min="1" value="1" required>
                        <button type="submit" class="btn add-btn">Добавить</button>
                    </div>
                </form>
                <form action="/deleteProduct" method="POST" class="product-form">
                    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" required>
                    <div class="quantity-container">
                        <input type="number" name="amount" min="1" value="1" required>
                        <button type="submit" class="btn remove-btn">Убрать</button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="/cart" class="cart-link">Перейти в корзину</a>
</div>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h3 {
        text-align: center;
        margin-bottom: 40px;
        color: #333;
    }

    .card-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .card {
        width: 100%;
        max-width: 300px;
        margin: 10px;
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

    .card-text {
        font-size: 12px;
        color: #777;
        margin: 5px 0;
    }

    .card-title {
        font-size: 16px;
        margin: 10px 0;
        color: #333;
    }

    .card-footer {
        font-weight: bold;
        font-size: 18px;
        color: #28a745; /* Зеленый цвет для цены */
    }

    .quantity-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px;
    }

    input[type="number"] {
        width: 60px;
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        outline: none;
        text-align: center;
        margin-right: 10px;
    }

    .btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        font-size: 14px;
        font-weight: bold;
    }

    .btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn:active {
        transform: scale(0.95);
    }

    .cart-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .cart-link:hover {
        color: #0056b3;
    }
</style>
