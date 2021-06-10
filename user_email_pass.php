<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
    <title>Флора</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
		<link rel="stylesheet" href="css/sweet-alert.css">
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
			
			
				
			if ( isset($data['do_login']) )
			{
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
					echo '<div class="sig" style="color:red;">Ответ на вопрос указан не верно!</div><hr>';
				}
				else{
				$user = R::findOne('users', 'email = ?', array($data['email']));
				if ( $user )
				{
                    $newpas = uniqid();//генирирую пароль
                    $user->password = password_hash($newpas, PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
                    R::store($user);
                    //письмо
                    $message = '';
                    $message .= '<h1>Интернет магазин Флора</h1>';
                    $message .='<p>Email: '.$_POST['email'].'</p>';
                    $message .='<p>Ваш новый пароль: '.$newpas.'</p>';
                    $to .=$_POST['email'];
                    $spectext = '<!DOCTYPE HTML><html><head><title>Смена пароля</title></head><body>';
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					$headers .= "From: Интернет магазин Флора <pishvanov98@gmail.com>\r\n"; 
					$headers .= "Reply-To: pishvanov98@gmail.com\r\n"; 
                    $m = mail($to, 'Смена пароля', $spectext.$message.'</body></html>', $headers);
					echo '<div class="sig" style="color:green;">Сообщение с паролем отправлено на вашу почту!</div><hr>';

				}else
				{
					echo '<div class="sig" style="color:red;">Пользователь с такой почтой не найден!</div><hr>';
				}

			}
			}

		?>
		<div class="authentication_reg">
			<form action="user_email_pass.php" method="POST">
				<input type="text" name="email" placeholder="Укажите Email" class="passlog" value="<?php echo @$data['email']; ?>"><br/>
				<input type="text" name="captcha" placeholder="<?php captcha_show(); ?> ?" class="passlog" ><br/>
				<button type="submit" class="form-button" name="do_login" style="cursor:pointer">Отправить пароль</button>
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
<script src="js/sweet-alert.min.js"></script>
</body>
</html>
