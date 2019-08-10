<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../css/style.css">
	<meta charset="UTF-8">
	<title>REGISTRATION</title>
</head>
<body>
	<div class="block_reg">
	<h1>Регистрация</h1>
	<?php
		session_start();
		if (isset($_SESSION['name'])) {
  ?>  
      <form action="registration_2.php" method="POST" class="block_reg__form">
			
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
	   
	   
			<input type="submit" value="Зарегистрироваться">
    
    </form> 
  <?php 

    } else {

  ?> 
  	<form action="registration_2.php" method="POST" class="block_reg__form">
			
			<label for="e_mail">E-mail</label>
	    <input type="email" id="e_mail" name="e_mail" placeholder="e-mail" required>

	    <label for="login">Логин</label>
			<input type="text" id="login" name="login" placeholder="Логин" required>
			
			<label for="password">Пароль</label>
			<input type="password" id="password" name="password" placeholder="Пароль" required>
	    
	    <label for="password_rep">Повторите пароль</label>
	    <input type="password" id="password_rep" name="password_rep" placeholder="Повторите пароль" required>

	    <label for="surname">Фамилия</label>
			<input type="text" id="surname" name="surname" placeholder="Фамилия"  required>

			<label for="name">Имя</label>
			<input type="text" id="name" name="name" placeholder="Имя" required>
			
			<label for="patronymic">Отчество</label>
			<input type="text" id="patronymic" name="patronymic" placeholder="Отчество"  required>	    
			
			<input type="submit" value="Зарегистрироваться">
    
    </form>

  <?php  	

    }

	?>

    <a href="login.php">Авторизация</a>

	</div>
	
</body>
</html>
<!-- <input type="password" id="password" placeholder="Пароль"  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" required> -->