<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Result_First_Query</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php
	require_once '../controller.php';
	use CONTROLLER\Inquiries;

	session_start();

	$a = new Inquiries();
	$result = $a->FirstQuery(); 

	if (empty($result)) {
		?>
		<p>*У всех пользователей уникальный <strong>Email</strong> в базе данных!</p>
		<a href="view.php"><---Назад</a>
		<?php
	}
	?>
	
</body>
</html>