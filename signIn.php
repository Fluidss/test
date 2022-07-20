<?
session_start();
require('functions.php');
require('connect.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:index.php');
    die();
} else {
    $mail = trim($_POST['mail']);
    $pass = trim($_POST['password']);
    if (empty($mail)) {
        $_SESSION['msg'] = 'Заполните поле почты';
        header('Location:index.php');
        die();
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = 'Почта указана не корректно';
        header('Location:register.php');
        die();
    }
    if (empty($pass)) {
        $_SESSION['msg'] = 'Заполните поле пароля';
        header('Location:index.php');
        die();
    }
    $pass = md5($pass);
    $stmt = $dbh->prepare("SELECT COUNT(*)as count FROM `users` WHERE `mail`= '$mail' AND `pass`= '$pass'");
    $stmt->execute();
    $count = $stmt->fetch()['count'];
    if ($count > 0) {
        $stmt = $dbh->prepare("SELECT * FROM `users` WHERE `mail`= '$mail' AND `pass`= '$pass'");
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($userData);
        $_SESSION['user'] = [
            'id' => $userData['id'],
            'name' => $userData['name'],
            'mail' => $userData['mail'],

        ];
        header('Location:profile.php');
    } else {
        $_SESSION['msg'] = 'Такого пользователя нету';
        header('Location:index.php');
        die();
    }
}
