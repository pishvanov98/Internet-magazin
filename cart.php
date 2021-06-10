<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
    <title>Флора</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/sweet-alert.css">
</head>
<body>
<?php require_once "blocks/header.php" ?> <!--Подключение сторонних файлов-->
<main class="flexf">
<?php if ( isset ($_SESSION['logged_user']) ) : ?>
    
    <div class="main-cart"></div>

      <?php else : ?>
        <div class="cart-fail" >
        <h3>Для того что бы заказать товар, авторизуйтесь в личном кабинете.</h3>
      </div>
      <?php endif; ?>
    <div class="email-field">
        <input type="text" placeholder="Укажите имя!" class="textbox" id="ename">
        <input type="email" placeholder="Укажите email!" class="textbox" id="email">
        <input type="text" placeholder="Укажите номер!" class="textbox" id="ephone">
	<input type="text" placeholder="Укажите адрес доставки!" class="textbox" id="eadres">
        <input type="submit" class="send-email" value="Отправить заказ"></input>
    </div>
</main>

<div class="clear"><br></div>
<?php require_once "blocks/footer.php" ?> <!--Подключение сторонних файлов-->

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script src="js/cart.js"></script>
<script src="js/dark.js"></script>
<script src="js/menu.js"></script>
<script src="js/sweet-alert.min.js"></script>
</body>
</html>
