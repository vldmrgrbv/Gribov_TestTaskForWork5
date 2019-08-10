<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Result_Second_Query</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php
	require_once '../controller.php';
	use CONTROLLER\Inquiries;

	session_start();

	$a = new Inquiries();
	$result = $a->SecondQuery();  
	?>
	<table>
		<tr>
			<th>Логины</th>
		</tr>
		<?php
		foreach($result as $res) {
			?>
			<tr>
				<td><?=$res?></td>
			</tr>
			<?php
		}
		?>
	</table>
	<a href="view.php"><---Назад</a>
</body>
</html>