<?php
// читать json файл
$json = file_get_contents('../goods.json');
$json = json_decode($json, true);

//письмо
$message = '';
$message .= '<h1>Заказ в магазине</h1>';
$message .='<p>Телефон: '.$_POST['ephone'].'</p>';
$message .='<p>Почта: '.$_POST['email'].'</p>';
$message .='<p>Клиент: '.$_POST['ename'].'</p>';
$message .='<p>Адрес: '.$_POST['eadres'].'</p>';

$cart = $_POST['cart'];
$sum = 0;
foreach ($cart as $id=>$count) {
    $message .=$json[$id]['name'].' в количестве ';
    $message .=$count.' штук ';
    $message .=$count*$json[$id]['cost'].' руб ';
    $message .='<br>';
}
$message .='Всего: '. $_COOKIE["price"].' руб';


//print_r($message);


$to = 'pishvanov98@gmail.com'.',';

$to .=$_POST['email'];
$spectext = '<!DOCTYPE HTML><html><head><title>Заказ в интернет магазине</title></head><body>';

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: Интернет магазин Флора <pishvanov98@gmail.com>\r\n"; 
$headers .= "Reply-To: pishvanov98@gmail.com\r\n"; 

$m = mail($to, 'Заказ в интернет магазине', $spectext.$message.'</body></html>', $headers);


if ($m) {echo 1;} else {echo 0;}
