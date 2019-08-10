<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../css/style.css">
	<meta charset="UTF-8">
	<title>EDIT_ACCOUNT</title>
</head>
<body>
	<div class="block_reg">
		<h1>Изменение учетной записи</h1> 
		<?php

		require_once '../controller.php';

		use CONTROLLER\EditAccount;

		session_start();

		$a = new EditAccount();

		if (isset($_SESSION['name'])) {
			?> 
			<form action="edit_account_2.php" method="POST" class="block_reg__form">

				<label for="e_mail">E-mail</label>
				<input type="email" id="e_mail" name="e_mail" placeholder="e-mail" value="<?=$_SESSION['e_mail']?>" required>

				<label for="login">Логин</label>
				<input type="text" id="login" name="login" placeholder="Логин" value="<?=$_SESSION['login']?>" required>

				<label for="password">Пароль</label>
				<input type="password" id="password" name="password" placeholder="Пароль" required>

				<label for="password_rep">Повторите пароль</label>
				<input type="password" id="password_rep" name="password_rep" placeholder="Повторите пароль" required>

				<label for="surname">Фамилия</label>
				<input type="text" id="surname" name="surname" placeholder="Фамилия" value="<?=$_SESSION['surname']?>"  required>

				<label for="name">Имя</label>
				<input type="text" id="name" name="name" placeholder="Имя" value="<?=$_SESSION['name']?>" required>

				<label for="patronymic">Отчество</label>
				<input type="text" id="patronymic" name="patronymic" placeholder="Отчество" value="<?=$_SESSION['patronymic']?>"  required>


				<input type="submit" value="Изменить">

			</form> 
			<?php 

		} elseif (isset($_SESSION['login'])) {
			$data = $a->getData();
			?>  
			<form action="edit_account_2.php" method="POST" class="block_reg__form">

				<label for="e_mail">E-mail</label>
				<input type="email" id="e_mail" name="e_mail" placeholder="e-mail" value="<?=$data[1]?>" required>

				<label for="login">Логин</label>
				<input type="text" id="login" name="login" placeholder="Логин" value="<?=$data[2]?>" required>

				<label for="password">Пароль</label>
				<input type="password" id="password" name="password" placeholder="Пароль" required>

				<label for="password_rep">Повторите пароль</label>
				<input type="password" id="password_rep" name="password_rep" placeholder="Повторите пароль" required>

				<label for="surname">Фамилия</label>
				<input type="text" id="surname" name="surname" placeholder="Фамилия" value="<?=$data[4]?>"  required>

				<label for="name">Имя</label>
				<input type="text" id="name" name="name" placeholder="Имя" value="<?=$data[5]?>" required>

				<label for="patronymic">Отчество</label>
				<input type="text" id="patronymic" name="patronymic" placeholder="Отчество" value="<?=$data[6]?>"  required>


				<input type="submit" value="Изменить">

			</form> 

			<?php  	

		}

		?>

		<a href="view.php">Назад</a>

	</div>
	
</body>
</html>
<!-- <input type="password" id="password" placeholder="Пароль"  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" required> -->