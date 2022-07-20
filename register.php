<? session_start(); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        input {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <div class="row ">
            <div class="col align-self-center">
                <h1>Регистрация</h1>
                <form action="signUp.php" method="post">
                    <input type="text" name='name' placeholder=" Имя">
                    <input type="email" name="mail" placeholder="email" required>
                    <input type="password" placeholder="Пароль" name="password" required>
                    <input type="password" placeholder="Повторите пароль" name="passwordApproove" required>
                    <input type="submit" value="Регистрировать">
                </form>
                <p>
                    <a href="index.php">Авторизация</a>
                </p>
            </div>
        </div>
    </div>


    <?php
    if (!empty($_SESSION['msg'])) : ?>
        <p class="alert alert-danger"><?= $_SESSION['msg'] ?></p>
    <? unset($_SESSION['msg']);
    elseif (!empty($_SESSION['success'])) : ?>
        <p class="alert alert-success"><?= $_SESSION['success'] ?></p>
    <? unset($_SESSION['success']);
    endif; ?>
</body>

</html>