<?
session_start();
require('functions.php');
require('connect.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:register.php');
    die();
} else {
    $name = trim($_POST['name']);
    $mail = trim($_POST['mail']);
    $pass = trim($_POST['password']);
    $passwordApproove = trim($_POST['passwordApproove']);
    if (empty($name)) {
        $_SESSION['msg'] = 'Заполните поле имя';
        header('Location:register.php');
        die();
    }
    if (empty($mail)) {
        $_SESSION['msg'] = 'Заполните поле почты';
        header('Location:register.php');
        die();
    }
    if (empty($pass)) {
        $_SESSION['msg'] = 'Заполните поле пароля';
        header('Location:register.php');
        die();
    }
    if (empty($passwordApproove)) {
        $_SESSION['msg'] = 'Заполните второе поле пароля';
        header('Location:register.php');
        die();
    }
    if ($pass === $passwordApproove) {
        $pass = md5($pass);
        $stmt = $dbh->query("SELECT COUNT(*)as count FROM `users` WHERE `mail`= '$mail'");
        $count = $stmt->fetch()['count'];
        if ($count > 0) {
            $_SESSION['msg'] = 'Такой пользователь уже существует';
            header('Location:register.php');
            die();
        } else {
            $stmt = $dbh->prepare("INSERT INTO `users` (name, mail, pass) VALUES (:name,:mail, :pass)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':pass', $pass);
            $stmt->execute();
            $_SESSION['success'] = 'Регистрация прошла успешно';
            $from = "test@mail.ru";
            $subject = "Регистрация на сайте test";
            $message = "Спасибо за регистрацию $name \n
            Ваша логин: $mail \n
            Ваш пароль: $passwordApproove 
            ";
            $headers = "From:" . $from;
            mail($mail, $subject, $message, $headers);
            header('Location:register.php');
        }
    } else {
        $_SESSION['msg'] = 'Пароли не совпадают';
        header('Location:register.php');
        die();
    }
}
