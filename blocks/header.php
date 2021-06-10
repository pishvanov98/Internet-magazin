<?php
$host = 'localhost'; // адрес сервера
$database = 'host1828673'; // имя базы данных
$user = 'host1828673'; // имя пользователя
$password = 'RpC29dOecz'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $select= mysqli_query ($link, "SELECT log, passw FROM authu");
    $row = mysqli_fetch_row ($select);

// выполняем операции с базой данных

// закрываем подключение
mysqli_close($link);
?>
<header>
      <div id="Logo">
        <a href="index.php" title="Перейти на главную">
          <span>Ф</span>лора
        </a>
		
      </div>
	  
	  <div id="sidebar">
			<div class="toggle-btn">
			<span></span>
			<span></span>
			<span></span>
			</div>
			<ul>
				<li>Меню сайта</li>
				<li><a data-fancybox data-src="#modal_admin" href="javascript:;" href="#">Панель администратора</a></li>
				<li><a href="later.php">Желания</a></li>
				<li><a href="cart.php">Корзина</a></li>
				<li><a id="kabinet" data-fancybox data-src="#modal" href="javascript:;" href="#">Личный кабинет</a></li>
				<div class="index-cart"></div><br>
				<button  id="del-to-cart-tho">Очистить корзину</button>
				<button class="menu_black_tho" id="toggleThemeBtn_tho">Сменить тему на тёмную</button>
			</ul>
		</div>
		
      <a class="menu_none" data-fancybox data-src="#modal_admin" href="javascript:;" href="#">
              <div>	Панель администратора </div>
          </a>

        <a class="menu_none" href="later.php">
           <div> Желания </div>
         </a>

         <a class="menu_none" href="cart.php">
            <div> Корзина </div>
          </a>

          <a class="menu_none" id="kabinet" data-fancybox data-src="#modal" href="javascript:;" href="#">
            <div> Личный кабинет </div>
          </a>

          <button class="menu_black" id="toggleThemeBtn">Сменить тему на тёмную</button>

      <div id="search">
          <input type="text" name="referal" placeholder="Поиск по сайту" value="" class="who"  autocomplete="off">
          <div class="vyvod">
          <ul class="search_result"></ul>
        
      </div> 

</header>


<div style="display: none;" id="modal">
      <?php 
        require 'db.php';
        
      ?>
	
      <?php if ( isset ($_SESSION['logged_user']) ) : ?>
        <div class="sig">
        Авторизован! <br/>
        <?php  if (isset($_COOKIE['discounts'])) echo "У вас скидка: " . $_COOKIE["discounts"] . " рублей при заказе <br> выше 1000 рублей<br>";   ?>

        <a href="user_logout.php">Выйти</a>
      </div>
      <?php else : ?>
        <div id="fansbox">
      Вы не авторизованы<br/>
      <a href="user_login.php">Авторизация</a>
      <a href="user_signup.php">Регистрация</a>
      </div>
      <?php endif; ?>
</div>



<div style="display: none;" id="modal_admin">
        <span id="form_adm">Авторизуйтесь</span>
        <div class="clear"><br></div>
          <div class="authentication">
          <form method="post">
          <input name="log" placeholder="Укажите Логин" autocomplete="off" class="passlog"  type="text" /><br/>
          <input name="passw" placeholder="Укажите пароль" class="passlog" type="password" /><br/>
          <input type="submit" class="form-button" name="button" style="cursor:pointer" />
          </form>
        </div>
              </div>

        <!--<div  class="flexf">-->
              <br>
          

          <h2>
            <?php
            if ($_POST['button'])
            {

              
              $log = $_POST['log'];
              $passw = $_POST['passw'];
              $passw = sha1($passw);
//в SHA1 хеширую введенный пароль пользователем если одинаково то пропускаю
              if (($log === $row[0]) and ($passw === $row[1]))
              {
                $_SESSION['auth'] = $log;
                header('Location: admin/admin.php');
              }
              else
              {
                echo "<script>alert(\"Вы ввели не верное имя или пароль.\");</script>";
              }

            }
            ?>
        </h2>
</div>