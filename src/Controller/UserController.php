<?php
require_once './../Model/User.php';
class UserController
{
    public function registrate()
    {
        $errors = $this->validate($_POST);
        if (empty($errors)) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $psw = $_POST['psw'];
            $pswRep = $_POST['psw-repeat'];

            $pswHash = password_hash($psw, PASSWORD_DEFAULT);

            $pdo = new PDO('pgsql:host=db;port=5432;dbname=dbname', 'dbuser', 'dbpwd');

            $userModel = new User();
            $userModel->create($name, $email, $pswHash);

            $userModel->getOneByEmail($email);

            header('Location: /get_login.php');
        }
        require_once './../View/get_registration.php';
    }


    public function login()
    {
        $errors = $this->validateLogin($_POST);
        if(empty($errors)) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $pdo = new PDO('pgsql:host=db;port=5432;dbname=dbname', 'dbuser', 'dbpwd');

            $userModel = new User();
            $result = $userModel->getOneByEmail($username);


            if (empty($result)) {
                $errors['username'] = 'email or password is incorrect';
            } else {
                if (password_verify($password, $result["password"])) {
                    session_start();
                    $_SESSION["logged_in_user_id"] = $result["id"];
                    header("Location: /cart.php");
                } else {
                    $errors['password'] = 'email or password is incorrect';
                }
            }
            require_once './../View/get_login.php';
        }
    }
    private function validate(array $data) {
        $errors = [];
        if (isset($data['name'])) {
            $name = $data['name'];
            if (empty($name)) {
                $errors['name'] = 'Заполните поле Name';
            } elseif (strlen($name) < 2) {
                $errors['name'] = ' должен иметь от 2 символов';
            } elseif (preg_match("/[0-9]/", $name)) {
                $errors['name'] = ' не должен содержать цифр';
            }
        } else{
            $errors['name'] = 'name не указан';
        }
        if (isset($data['email'])) {
            $email = $data['email'];
            if (empty($email)) {
                $errors['email'] = ' не указан';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = ' адрес указан неверно';
            } else {
                $userModel = new User();
                $result = $userModel->getOneByEmail($data['email']);
                if (!empty($result)) {
                    $errors['email'] = ' ранее зарегистрирован в базе данных';
                }
            }
        } else{
            $errors['email'] = 'email не указан';
        }

        if (isset($data['psw'])) {
            $psw = $data['psw'];
            if (empty($psw)) {
                $errors['psw'] = ' не указан';
            } elseif (strlen($psw) < 6) {
                $errors['psw'] = ' должен иметь от 6 символов';
            }
        } else{
            $errors['psw'] = 'password не указан';

        }

        if (isset($data['psw-repeat'])) {
            $pswRep = $data['psw-repeat'];
            if (empty($pswRep)) {
                $errors['psw-repeat'] = ' не указан';
            } elseif ($psw !== $pswRep) {
                $errors['psw-repeat'] = 'Пароли не совпадают';
            }
        } else{
            $errors['psw-repeat'] = 'pswRep не указан';
        }
        return $errors;
    }
    function validateLogin(array $data) {
        $errors = [];
        if (isset($data['username'])) {
            $username = $data['username'];
            if (empty($username)) {
                $errors['username'] = 'Заполните поле username';
            }
        } else{
            $errors['username'] = 'name не указан';
        }

        if (isset($data['password'])) {
            $password = $data['password'];
            if (empty($password)) {
                $errors['password'] = 'заполните поле password';
            }
        } else{
            $errors['password'] = 'password не указан';

        }
        return $errors;
    }
}