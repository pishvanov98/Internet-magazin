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
   <h1 id="hed">Ваши желания</h1>
      <button id="del-to-later">Очистить желания</button>
      <div class="goods-out-g"></div>
  </main>
  <div class="clear"><br></div>

  <?php require_once "blocks/footer.php" ?> <!--Подключение сторонних файлов-->

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script src="js/later.js"></script>
<script src="js/dark.js"></script>
<script src="js/menu.js"></script>
<script src="js/sweet-alert.min.js"></script>
</body>
</html>
