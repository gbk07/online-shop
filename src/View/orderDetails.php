<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Детали Заказа</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            width: 80px; /* Уменьшить ширину изображения */
            height: auto;
            border-radius: 5px; /* Скругление углов */
        }
    </style>
</head>
<body>

<h1>Детали Заказа</h1>
<table>
    <thead>
    <tr>
        <th>Изображение</th>
        <th>Название товара</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Адрес</th>
        <th>Номер</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orderDetails as $detail): ?>
        <tr>
            <td>
                <img src="<?php echo htmlspecialchars($detail['product_image']); ?>" alt="<?php echo htmlspecialchars($detail['product_name']); ?>">
            </td>
            <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
            <td><?php echo htmlspecialchars($detail['product_price']); ?> ₽</td>
            <td><?php echo htmlspecialchars($detail['product_amount']); ?></td>
            <td><?php echo htmlspecialchars($detail['order_address']); ?></td>
            <td><?php echo htmlspecialchars($detail['order_number']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
