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

<main class="flexf">
    <!--<div class="index-cart"></div><br>
    <button  id="del-to-cart">Очистить корзину</button>-->
		<div class="controls">
			<a href="cart.php" class="check_sum">
				<img src="img/cart.png" alt="Корзина" title="Корзина" >
				<div id="check_sum"></div>
			</a>
  			  <button  id="del-to-cart">Очистить корзину</button>
			<div class="kategoria">
				<label >Категории</label>
				<select id="sort" name="sort" class="form-control">
				<?php
				 if ($_COOKIE['kategory'] == "Kom_ras"){
					?>
					<option id="all">Всё</option>
					<option id="kom_ras"selected>Комнатные растения</option>
					<option id="palm">Пальмы</option>
					<option id="wood">Деревья бонсай</option>
					<?php
				}
				else if ($_COOKIE['kategory'] == "Palm"){
					?>
					<option id="all">Всё</option>
					<option id="kom_ras">Комнатные растения</option>
					<option id="palm"selected>Пальмы</option>
					<option id="wood">Деревья бонсай</option>
					<?php
				}
				else if ($_COOKIE['kategory'] == "Wood"){
					?>
					<option id="all">Всё</option>
					<option id="kom_ras">Комнатные растения</option>
					<option id="palm">Пальмы</option>
					<option id="wood"selected>Деревья бонсай</option>
					<?php
				}
				else if ($_COOKIE['kategory'] == "all"){
					?>
					<option id="all"selected>Всё</option>
					<option id="kom_ras">Комнатные растения</option>
					<option id="palm">Пальмы</option>
					<option id="wood">Деревья бонсай</option>
					<?php
				}
				else{
					?>
					<option id="all"selected>Всё</option>
					<option id="kom_ras">Комнатные растения</option>
					<option id="palm">Пальмы</option>
					<option id="wood">Деревья бонсай</option>
					<?php
				}
				?>
				</select>
			</div>
			<div class="sort">
				<label >Сортировка</label>
				<select  id="sort" name="sort_a" class="form-control">
					<option id="sort_stok" value="1"selected>По умолчанию</option>
					<option id="sort_costa" value="2">По цене, сначала дешевые</option>
					<option id="sort_costb" value="3">По цене, сначала дорогие</option>
					<option id="sort_namea" value="4">По названию, А-Я</option>
					<option id="sort_nameb" value="5">По названию, Я-А</option>
				</select>
			</div>

		</div>
			
	
	
	

    <div class="goods-out"></div>
</main>
<div class="clear"><br></div>
<?php require_once "blocks/footer.php" ?> <!--Подключение сторонних файлов-->

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script src="js/main.js"></script>
<script src="js/dark.js"></script>
<script src="js/menu.js"></script>
<script src="js/sweet-alert.min.js"></script>
</body>
</html>
