<?php 
define("DB_HOST","localhost");
define("DB_NAME","host1828673");
define("DB_USER","host1828673");
define("DB_PASSWORD","RpC29dOecz");
define("PREFIX","");	
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli -> query("SET NAMES 'utf8'") or die ("Ошибка соединения с базой!");
if(!empty($_POST["referal"])){
$referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));
$referal = preg_replace("/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя0-9]/", " ", $_POST['referal']);
$db_referal = $mysqli -> query("SELECT * from ".PREFIX."goods WHERE name LIKE '%$referal%' AND id ")
or die('Ошибка №'.__LINE__.'<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');
while ($row = $db_referal -> fetch_array()) 
{
    $id = $row["id"];
    echo "\n<li><a href='./goods.php#$id.'>".$row["name"]."</a></li>";}

}
?>