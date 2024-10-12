<main class="main">
    <div class="app">
        <header class="app-header">
            <h1 class="app-title">Создать аккаунт</h1>
            <p class="app-subtitle">Пожалуйста, заполните эту форму для создания учетной записи.</p>
        </header>

        <form action="/registrate" method="POST" class="registration-form">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" placeholder="Введите имя" required>
                <span class="error-message"><?php if (isset($errors['name'])) { echo $errors['name']; } ?></span>
            </div>

            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="text" name="email" id="email" placeholder="Введите электронную почту" required>
                <span class="error-message"><?php if (isset($errors['email'])) { echo $errors['email']; } ?></span>
            </div>

            <div class="form-group">
                <label for="psw">Пароль</label>
                <input type="password" name="psw" id="psw" placeholder="Введите пароль" required>
                <span class="error-message"><?php if (isset($errors['psw'])) { echo $errors['psw']; } ?></span>
            </div>

            <div class="form-group">
                <label for="psw-repeat">Повторите пароль</label>
                <input type="password" name="psw-repeat" id="psw-repeat" placeholder="Повторите пароль" required>
                <span class="error-message"><?php if (isset($errors['psw-repeat'])) { echo $errors['psw-repeat']; } ?></span>
            </div>

            <hr>

            <button type="submit" class="btn">Зарегистрироваться</button>
        </form>

        <div class="signin">
            <p>Уже есть аккаунт? <a href="/login">Войдите</a>.</p>
        </div>
    </div>
</main>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Высота на всю страницу */
        padding: 20px; /* Отступы по краям */
    }

    .app {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
        margin-top: 30px; /* Добавлен верхний отступ для опускания формы */
    }

    .app-header {
        margin-bottom: 30px; /* Уменьшен отступ снизу */
    }

    .app-title {
        font-size: 26px; /* Уменьшен размер шрифта */
        color: #333;
        margin: 0;
    }

    .app-subtitle {
        color: #666;
        margin: 5px 0 25px; /* Уменьшен отступ снизу */
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.3s;
        background-color: #f1f1f1;
    }

    input:focus {
        border-color: #007bff;
        background-color: #ffffff;
    }

    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .terms {
        margin: 15px 0;
        font-size: 14px;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .signin {
        margin-top: 15px;
        font-size: 14px;
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 5px;
    }

    .signin a {
        color: #007bff;
        text-decoration: none;
    }

    .signin a:hover {
        text-decoration: underline;
    }

    hr {
        border: 1px solid #f1f1f1;
        margin: 25px 0;
    }
</style>
