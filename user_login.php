<?php $discounts = $_SESSION['logged_user']->discounts;//вывод скидки через куки в корзину
setcookie("discounts", $discounts); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
    <title>Флора</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
</head>
<body>
<?php require_once "blocks/header.php" ?> <!--Подключение сторонних файлов-->
<div class="flexf">
		<?php 	
			$data = $_POST;
			if ( isset($data['do_login']) )
			{
				$user = R::findOne('users', 'login = ?', array($data['login']));
				if ( $user )
				{
					//логин существует
					if ( password_verify($data['password'], $user->password) )
					{
						//если пароль совпадает, то нужно авторизовать пользователя
						$_SESSION['logged_user'] = $user; 
						
					?>
					
					<div class="sig" style="color:green;">
					Привет, 
					<?php 
						echo $_SESSION['logged_user']->login;?> </div> <?php
						$discounts = $_SESSION['logged_user']->discounts;//вывод скидки через куки в корзину
						setcookie("discounts", $discounts);
						echo '<div class="sig" style="color:green;">Вы авторизованы!<br/> Можете перейти на <a href="index.php">главную</a> страницу.</div><hr>';
					}else
					{
						$errors[] = 'Неверно введен пароль!';
					}

				}else
				{
					$errors[] = 'Пользователь с таким логином не найден!';
				}
				
				if ( ! empty($errors) )
				{
					//выводим ошибки авторизации
					echo '<div class="sig" style="color:red;">' .array_shift($errors). '</div><hr>';
				}

			}

		?>
		<div class="authentication_reg">
			<form action="user_login.php" method="POST">
				<input type="text" name="login" placeholder="Укажите Логин" autocomplete="off" class="passlog" value="<?php echo @$data['login']; ?>"><br/>
				<input type="password" name="password" placeholder="Укажите Пароль" class="passlog" value="<?php echo @$data['password']; ?>"><br/>
				<a href="user_email_pass.php" class="info_pass">Не получается войти</a>
				<button type="submit" class="form-button" name="do_login" style="cursor:pointer">Войти</button>
			</form>
		</div>
	</div>

<div class="clear"><br></div>
<?php require_once "blocks/footer.php" ?> <!--Подключение сторонних файлов-->

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script src="js/dark.js"></script>
<script src="js/menu.js"></script>
</body>
</html>
