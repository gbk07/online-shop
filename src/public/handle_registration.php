<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    echo 'name не указан';
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    echo 'email не указан';
}

if (isset($_POST['psw'])) {
    $psw = $_POST['psw'];
} else {
    echo 'password не указан';
}

if (isset($_POST['psw-repeat'])) {
    $pswRep = $_POST['psw-repeat'];
} else {
    echo 'pswRep не указан';
}
$pdo = new PDO('pgsql:host=db;port=5432;dbname=dbname', 'dbuser', 'dbpwd');
function validate($name, $email, $psw, $pswRep, $pdo) {
    $errors = [];

    if (empty($name)) {
        $errors['name'] = 'Заполните поле Name';
    } elseif (strlen($name) < 2) {
        $errors['name'] = ' должен иметь от 2 символов';
    } elseif (preg_match("/[0-9]/", $name)) {
        $errors['name'] = ' не должен содержать цифр';
    }

    if (empty($email)) {
        $errors['email'] = ' не указан';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = ' адрес указан неверно';
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            $errors['email'] = ' ранее зарегистрирован в базе данных';
        }
    }

    if (empty($psw)) {
        $errors['psw'] = ' не указан';
    } elseif (strlen($psw) < 6) {
        $errors['psw'] = ' должен иметь от 6 символов';
    }

    if (empty($pswRep)) {
        $errors['psw-repeat'] = ' не указан';
    } elseif ($psw !== $pswRep) {
        $errors['psw-repeat'] = 'Пароли не совпадают';
    }

    return $errors;
}

$errors = validate($name, $email, $psw, $pswRep, $pdo);

if (empty($errors)) {

    $psw = password_hash($psw, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :psw)");
    $stmt->execute([':name' => $name, ':email' => $email, ':psw' => $psw]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $result = $stmt->fetch();
    print_r($result);
} else {
    require_once './get_registration.php';
}
?>