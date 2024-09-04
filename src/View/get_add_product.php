<form action="/handle_add_product.php" method="POST">
    <div class="container">
        <h1> Добавить товар в корзину</h1>
        <hr>

        <label for="product_id"> ID продукта:</label>
        <label style="..."><?php if(isset($errors['product_id']))
            {
                echo $errors['product_id'];
            }?>
        </label>
        <input type="text" id="product_id" name="product_id" required>
        <br><br>

        <label for="amount">Количество:</label>
        <label style="..."><?php if(isset($errors['amount']))
            {
                echo $errors['amount'];
            }?>
        </label>
        <input type="text" id="amount" name="amount" required>

        <button type="submit" class="registerbtn">Добавить в корзину</button>

    </div>
</form>