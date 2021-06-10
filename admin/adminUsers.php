<?php
if (!$_SESSION ['auth'])
{
  header("Location: ../index.php"); /* Перенаправление броузера */
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
    <title>Панель администратора</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/sweet-alert.css">
</head>
<body>
    <header>
          <div id="Logo">
            <a href="../index.php" title="Перейти на главную">
              <span>Ф</span>лора
            </a>
            
          
          </p>
          </div>
          
            <a href="" class="admPanel">
                <div>	Панель администратора </div>
            </a>

            <a href="../later.php">
               <div class="menu_none"> Желания </div>
             </a>

             <a href="../cart.php">
                <div class="menu_none"> Корзина </div>
              </a>

              <a href="admin.php">
            <div> Товары интернет-магазина </div>
             </a>


             <p class="menu_none_name" id="name">Пользователь: <?php echo $_SESSION['auth'] ?>

  

             <form method="post">
      <input type="submit" name="destroy" id="destroy" value="Выйти" /><br/>
      </form>
             
        
      </div> 
          
          
  </header>
  

    <div  class="flexf">
    
    <button id="toggleThemeBtn">Сменить тему на тёмную</button>
      <div class="email-field">
        <div class="out"></div>
        <input type="text" placeholder="Логин пользователя!" class="textbox" maxlength="30" id="loginUser">
        <input type="text" placeholder="Email пользователя!" class="textbox" id="emailUser">
        <input type="text" placeholder="Скидку пользователю в рублях!" class="textbox" id="discountsUser">
        <input type="hidden" id="gidUser">
        <button class="add-to-dbUser">Изменить пользователя</button>
        <button id="delit" class="del-to-dbUser">Удалить пользователя</button>
      </div>
      <div class="email-field">
        <div class="ou"></div>
        <textarea type="text" placeholder="Отзыв пользователя!" class="message" id="MessUser"></textarea>
        <input type="hidden" id="gidUserMess">
        <button id="delit" class="del-to-dbUserMess">Удалить отзыв</button>
      </div>
      <div class="email-field">
        <div class="ot"></div>
        <input type="text" placeholder="Имя пользователя!" class="textbox" maxlength="30" id="OrderUser">
        <input type="text" placeholder="Email пользователя!" class="textbox" id="OrderEmail">
	<input type="text" placeholder="Email пользователя!" class="textbox" id="Adres">
        <input type="text" placeholder="Товар!" class="textbox" id="Orders">
        <p><span> 0: Не подтвержденный заказ<br> 1: Подтвержденный заказ<br> 2: Заказ доставлен<br> 3: Заказ не доставлен<br></span> <input type="number" placeholder="Состояние заказа" min="0" max="3" onkeypress="return false" id="filterOrder"></p>
        <input type="text" placeholder="Время заказа" class="textbox" id="dataOrder">
        <input type="text" placeholder="Стоимость заказа!" class="textbox" id="OrderCost">
        <input type="hidden" id="gidUserOrder">
        <button class="add-to-dbOrder">Изменить заказ</button>
        <button id="delit" class="del-to-dbUserOrder">Удалить заказ</button>
      </div>
    </div>
      <div class="clear"><br></div>
      <?php      
      function destroySession()
      {
        unset($_SESSION['auth']);
        header("Location: ../index.php"); /* Перенаправление броузера */
      }
      
      if(array_key_exists('destroy',$_POST)){
        destroySession();
      }
      ?>
      <?php require_once "../blocks/footer.php" ?> <!--Подключение сторонних файлов-->

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script src="js/adminUser.js"></script>
<script src="js/dark.js"></script>
<script src="js/sweet-alert.min.js"></script>
</body>
</html>
