<!DOCTYPE html>
<html lang="ru">
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
<div id="obert">
    <h1 id="head_goods">Описание товара</h1>
    <main class="flexf" >

        <div class="goods-out-g"></div>
    </main>
</div>

<?php if ( isset ($_SESSION['logged_user']) ) : ?>
    <div class="block_main">
          <h2>Доска отзывов</h2>
          
          <form method="post" class="block_pocht" action="shout.php">
             <div class="mess_get"> Имя: <input type="text" id="name" name="name" /> </div>
             <div class="mess_get"> Сообщение: <textarea type="text" id="message" name="message" class="message mesheiight"></textarea></div>
              <input type="submit" id="submit" value="Отправить" />
          </form>
          
          <div id="shout">
          </div>
    </div>

      <?php else : ?>
        <div class="block_main">
        <h3>Для того что бы добавить отзыв, авторизуйтесь в личном кабинете.</h3>
        </div>
      <?php endif; ?>
    
      



  <div class="clear"><br></div>
  <?php require_once "blocks/footer.php" ?> <!--Подключение сторонних файлов-->

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script src="js/goods.js"></script>
  <script src="js/dark.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/sweet-alert.min.js"></script>
</body>
</html>
