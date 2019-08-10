<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>MAIN</title>
</head>
<body>
    <?php

    require_once '../controller.php';
    use CONTROLLER\Autorization;

    session_start();

    $a = new Autorization();

    if(isset($_SESSION['login'])) {      
    ?>

        <h1>Пользоветель - <?=$_SESSION['login']?></h1>
        <a href='edit_account.php'>Изменить учетную запись</a><br>
        <a href='login.php'>Выход</a>

        <table >
            <tr>
                <th>Описание запроса</th>
                <th>Выполнение</th>
            </tr>
            <tr>
                <td>список email'лов встречающихся более чем у одного пользователя</td>
                <td class="href"><a href="resultQuery_1.php">Выполнить</a></td>
            </tr>
            <tr>
                <td>список логинов пользователей, которые не сделали ни одного заказа</td>
                <td class="href"><a href="resultQuery_2.php">Выполнить</a></td>
            </tr>
            <tr>
                <td>список логинов пользователей которые сделали более двух заказов</td>
                <td class="href"><a href="resultQuery_3.php">Выполнить</a></td>
            </tr>
        </table>

        <?php
    }
    else {
        echo "Введены некорректные данные!</br>";
        echo "<a href='login.php'>Авторизация</a>";
    }     
    ?>    
</body>
</html>
