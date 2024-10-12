<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Страница не найдена</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        .container {
            text-align: center;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
        }

        .dino {
            width: 150px;
            height: auto;
            position: relative;
            animation: jump 0.5s ease infinite alternate;
        }

        @keyframes jump {
            0% {
                bottom: 0;
            }

            100% {
                bottom: 20px;
            }
        }

        h1 {
            font-size: 48px;
            margin: 20px 0;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #666;
            margin: 10px 0;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }

        .ground {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 10px;
            background-color: #6c757d;
        }
    </style>
</head>

<body>
<div class="container">
    <img class="dino" src="https://cdn.rawgit.com/ahmedhosna95/upload/1731955f/sad404.svg" alt="404 Error">
    <h1>404 - Страница не найдена</h1>
    <p>К сожалению, страница, которую вы искали, не существует.</p>
    <p>... Вернуться на предыдущую страницу</p>
    <a href="#" class="back">Назад</a>
    <div class="ground"></div>
</div>
</body>

</html>
