<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AUTORIZATION</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="block_reg">
        <?php
        require_once '../controller.php';
        use CONTROLLER\Login;

        session_start();

        $a = new Login();
        $a->login();
        $login = $a->get_login();      
        ?>
        <h1>Авторизация</h1>
        <form action="view.php" enctype='multipart/form-data' method="POST" class="block_reg__form">
            <label for="login">Логин</label>
            <input type="text" name="login" id="login" placeholder="login" value=<?=$login?>>
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" placeholder="password">
            <input type="submit" value="Войти">
        </form>
        <br>
        <a href="registration.php">Регистрация</a>

    </div>
</body>
</html>