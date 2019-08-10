<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EDIT_ACCOUNT</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php
	require_once '../controller.php';

	use CONTROLLER\EditAccount;
	use CONTROLLER\DataCheck;

	session_start();

	$a = new EditAccount();
	$b = new DataCheck();

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
		<a href="edit_account.php"><---Назад</a>

		<?php

	} else {
		$data_transfer = $b->data_transfer();
		$editToDatabase = $a->editToDatabase($data_transfer);

		if($editToDatabase) {

			?>

			<h1>Учетная запись успешно изменена</h1>
			<a href="view.php">На главную</a>

			<?php

		} else {

			?>

			<h1>Ошибка!</h1>
			<a href="edit_account.php"><---Назад</a>

			<?php

		}
	}

	?>

</body>
</html>