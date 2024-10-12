<main class="main">
    <div class="app">
        <header class="app-header">
            <img src="https://res.cloudinary.com/linuxmachinecloud/image/upload/v1695134236/codepen/login-form/nw9mzwltearfjmfqlujk.png" class="app-logo" alt="logo">
            <h1 class="app-title">Добро пожаловать</h1>
        </header>

        <form class="login" action="/login" method="POST">
            <div class="login-input-group">
                <div class="login-floating-label-form-group">
                    <label for="username">Имя пользователя</label>
                    <input class="login-form-control" type="text" name="username" id="username" placeholder=" " required />
                    <span class="error-message"><?php if (isset($errors['username'])) { echo $errors['username']; } ?></span>
                </div>

                <div class="login-floating-label-form-group">
                    <label for="password">Пароль</label>
                    <input class="login-form-control" type="password" name="password" id="password" placeholder=" " required />
                    <span class="error-message"><?php if (isset($errors['password'])) { echo $errors['password']; } ?></span>
                </div>
            </div>

            <div class="login-form-group">
                <button type="submit" class="btn">Войти</button>
            </div>

            <p class="login-footer">Нет аккаунта? <a href="/registrate">Зарегистрироваться</a></p>
        </form>
    </div>
</main>

<style>
    body {
        background-color: #e9ecef;
        font-family: 'Arial', sans-serif;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .app {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .app-header {
        margin-bottom: 30px;
    }

    .app-logo {
        height: 60px;
        margin-bottom: 10px;
    }

    .app-title {
        font-size: 24px;
        color: #333;
        margin: 0;
    }

    .login-input-group {
        margin-bottom: 20px;
    }

    .login-floating-label-form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .login-form-control {
        width: 100%;
        padding: 10px 15px;
        font-size: 16px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.3s;
        background-color: #f8f9fa;
    }

    .login-form-control:focus {
        border-color: #007bff;
        background-color: #ffffff;
    }

    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
        display: block;
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
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .login-footer {
        margin-top: 15px;
        font-size: 14px;
    }

    .login-footer a {
        color: #007bff;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>
