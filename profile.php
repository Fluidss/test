<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($_SESSION['user'])) {
        echo '<p class="alert alert-primary"> Добро пожаловать ' . $_SESSION['user']['name'] . '</p>';
    }
    ?>
    <a href="logout.php">Выйти</a>
</body>

</html>