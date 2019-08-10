<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>REGISTARION</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php
	require_once '../controller.php';

	use CONTROLLER\Registration;
	use CONTROLLER\DataCheck;

	session_start();

	$a = new Registration();
	$b = new DataCheck();

	$result = $a->existInTheDB();
	$result = $b->data_checking();    

	if($result != '') {
		$array_data = $b->get_data();
		?>

		<h1>Ошибка!</h1><br>
		<p><?="$result"?></p><br>
		<?php
			$_SESSION['e_mail'] = $array_data[0];
			$_SESSION['login'] = $array_data[1];
			$_SESSION['surname'] = $array_data[2];
			$_SESSION['name'] = $array_data[3];
			$_SESSION['patronymic'] = $array_data[4];
		?>
		<a href="registration.php"><---Назад</a>

		<?php

	} else {
		$data_transfer = $b->data_transfer();
		$addToDatabase = $a->addToDatabase($data_transfer);

		if($addToDatabase) {
			$fst_name = $b->get_name();

			?>

			<h1><?="$fst_name"?>, Вы успешно зарегистрировались!</h1>
			<p>Авторизируйтесь, чтобы войти в свою учётную запись!</p>
			<a href="login.php">Авторизация</a>

			<?php

		} else {

			?>

			<h1>Ошибка!</h1>
			<a href="registration.php"><---Назад</a>

			<?php

		}
	}

	?>

</body>
</html>