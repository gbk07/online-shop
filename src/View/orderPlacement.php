<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <style>
        * {box-sizing: border-box;}

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }

        .container {
            background-color: #fff;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type=text], input[type=email], input[type=number], input[type=password], input[type=address] {
            width: 100%;
            padding: 15px;
            margin: 10px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        input[type=text]:focus, input[type=password]:focus, input[type=address]:focus, input[type=number]:focus, input[type=email]:focus {
            background-color: #e8f0fe;
            border: 1px solid #4CAF50;
            outline: none;
        }

        .registerbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 18px;
        }

        .registerbtn:hover {
            background-color: #45a049;
        }

        .signin {
            text-align: center;
            padding-top: 20px;
        }

        .signin a {
            color: #04AA6D;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Оформление заказа</h1>
    <hr>

    <form action="/order" method="POST">
        <label for="name">ФИО:</label>
        <input type="text" placeholder="Введите ваше имя" name="name" id="name" required>
        <span class="error"><?php if (isset($errors['name'])) echo $errors['name']; ?></span>

        <label for="email">Email:</label>
        <input type="email" placeholder="Введите ваш email" name="email" id="email" required>
        <span class="error"><?php if (isset($errors['email'])) echo $errors['email']; ?></span>

        <label for="number">Номер телефона:</label>
        <input type="text" placeholder="Введите номер телефона" name="number" id="number" required>
        <span class="error"><?php if (isset($errors['number'])) echo $errors['number']; ?></span>

        <label for="address">Адрес доставки:</label>
        <input type="text" placeholder="Введите адрес" name="address" id="address" required>
        <span class="error"><?php if (isset($errors['address'])) echo $errors['address']; ?></span>

        <hr>

        <button type="submit" class="registerbtn">Оформить заказ</button>
    </form>
</body>
</html>
