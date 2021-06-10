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

              <a href="adminUsers.php">
            <div> Пользователи интернет-магазина </div>
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
        <input type="text" placeholder="Укажите имя товара!" class="textbox" maxlength="30" id="gname">
        <input type="text" placeholder="Укажите стоимость товара!" class="textbox" id="gcost">
        <p><span> 1: Комнатные растения<br> 2: Пальмы<br> 3: Деревья бонсай<br></span> <input type="number" placeholder="Укажите категорию" min="1" max="3" onkeypress="return false" id="gfilter"></p>
        <textarea placeholder="Характеристика товара" class="message" id="gdescr"></textarea>
        <textarea placeholder="Описание товара" class="message" id="gdescrtwo"></textarea>
        <input type="text" placeholder="Укажите имя изображения!" class="textbox" id="gimg">
        <input type="hidden" id="gid">
        <button class="add-to-db">Добавить товар</button>
        <button id="delit" class="del-to-db">Удалить товар</button>
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
<script src="js/admin.js"></script>
<script src="js/dark.js"></script>
<script src="js/sweet-alert.min.js"></script>
</body>
</html>
