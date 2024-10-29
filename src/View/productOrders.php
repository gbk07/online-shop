<div class="container">
    <h3>Мои заказы</h3>
    <div class="order-deck">
        <?php foreach ($orders as $order): ?>
            <div class="order-card text-center">
                <h5>Заказ №<?php echo htmlspecialchars($order['id']); ?></h5>
                <form action="/orderDetails" method="POST">
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
                    <button type="submit" class="btn details-btn">Детали заказа</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .order-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
    }

    .order-card {
        width: 100%;
        max-width: 300px; /* Максимальная ширина карточки */
        margin: 10px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .details-btn {
        margin-top: 10px;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .details-btn:hover {
        background-color: #0056b3;
    }
</style>
