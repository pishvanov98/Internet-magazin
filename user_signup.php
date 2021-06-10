<?php session_start (); ?>
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

			function captcha_show(){
				$questions = array(
					1 => 'Столица России',
					2 => 'Столица США',
					3 => '2 + 3',
					4 => '15 + 14',
					5 => '45 - 10',
					6 => '33 - 3'
				);
				$num = mt_rand( 1, count($questions) );
				$_SESSION['captcha'] = $num;
				echo $questions[$num];
			}

			//если кликнули на button
			if ( isset($data['do_signup']) )
			{
			// проверка формы на пустоту полей
				$errors = array();
				if ( trim($data['login']) == '' )
				{
					$errors[] = 'Введите логин';
				}

				if ( trim($data['email']) == '' )
				{
					$errors[] = 'Введите Email';
				}

				if ( $data['password'] == '' )
				{
					$errors[] = 'Введите пароль';
				}

				if ( $data['password_2'] != $data['password'] )
				{
					$errors[] = 'Повторный пароль введен не верно!';
				}

				//проверка на существование одинакового логина
				if ( R::count('users', "login = ?", array($data['login'])) > 0)
				{
					$errors[] = 'Пользователь с таким логином уже существует!';
				}
			
			//проверка на существование одинакового email
				if ( R::count('users', "email = ?", array($data['email'])) > 0)
				{
					$errors[] = 'Пользователь с таким Email уже существует!';
				}

				//проверка капчи
				$answers = array(
					1 => 'москва',
					2 => 'вашингтон',
					3 => '5',
					4 => '29',
					5 => '35',
					6 => '30'
				);
				if ( $_SESSION['captcha'] != array_search( mb_strtolower($_POST['captcha']), $answers ) )
				{
					$errors[] = 'Ответ на вопрос указан не верно!';
				}


				if ( empty($errors) )
				{
					//ошибок нет, теперь регистрируем
					$user = R::dispense('users');
					$user->login = $data['login'];
					$user->email = $data['email'];
					$user->discounts = 0;
					$user->password = password_hash($data['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
					R::store($user);
					echo '<div class="sig" style="color:green;">Вы успешно зарегистрированы!</div><hr>';
				}else
				{
					echo '<div class="sig" style="color:red;">' .array_shift($errors). '</div><hr>';
				}

			}

		?>
		<div class="authentication_reg">
			<form action="user_signup.php" method="POST">
				<input type="text" name="login" placeholder="Укажите Логин" autocomplete="off" class="passlog" value="<?php echo @$data['login']; ?>"><br/>
				<input type="email" name="email" placeholder="Укажите Email" autocomplete="off" class="passlog" value="<?php echo @$data['email']; ?>"><br/>
				<input type="password" name="password" placeholder="Укажите Пароль" class="passlog" value="<?php echo @$data['password']; ?>"><br/>
				<input type="password" name="password_2" placeholder="Повторите Пароль" class="passlog" value="<?php echo @$data['password_2']; ?>"><br/>
				<input type="text" name="captcha" placeholder="<?php captcha_show(); ?> ?" class="passlog" ><br/>
				<button type="submit" class="form-button" name="do_signup" style="cursor:pointer">Регистрация</button>
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
