<?php

function randomString() {
    $char = '123456789qwertyuioplkjhgfdsazxcvbnmMNBVCXZASDFGHJKLPOIUYTREWQ';
    $random = '';
    for ($i=0; $i<20; $i++) {
        $random .= $char[rand(0, strlen($char)-1)];
    }
    return $random;
}

session_start();
$connection = new PDO('mysql:host=localhost; dbname=train1; charset=utf8', 'root', 'root');

if ($_POST['login']) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authKey = randomString();
    $add= $connection->query("INSERT INTO login (email, login, password, auth) VALUES ('$email', '$login', '$password', '$authKey')");

    if ($add) {
        mail($email, 'Подтвердите почту', "http://train1/?auth=$authKey");
        echo 'Подтвердите почту';
    } else {
        $search = $connection->query("SELECT * FROM login WHERE email = '$email'");
        $search = $search->fetch();
        if ($search) {
            echo 'Вы уже зарегестрированы';
        } else {
            echo 'Подтвердите почту';
        }
    }
}

if ($_GET['auth']) {
    $auth = $_GET['auth'];
    $connection->query("UPDATE login SET  timeEnd = current_timestamp WHERE auth = '$auth'");
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    <input type="email" name="email" required placeholder="Почта"> <br/>
    <input type="login" name="login" required placeholder="Логин"><br/>
    <input type="password" name="password" required placeholder="Пароль"><br/>
    <input type="submit" value="Зарегестрироваться">
</form>

</body>
</html>
