<?php
/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'host1828673';

/*** mysql password ***/
$password = 'RpC29dOecz';

$dbname = 'host1828673';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

if($_POST['name']) {
    $name       = $_POST['name'];
    $message    = $_POST['message'];
    $sort = $_POST['sort'];
    /*** set all errors to execptions ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO shoutbox (date_time, name, message, sort)
            VALUES (NOW(), :name, :message, :sort)";
    /*** prepare the statement ***/
    $stmt = $dbh->prepare($sql);

    /*** bind the params ***/
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->bindParam(':sort', $sort, PDO::PARAM_STR);

    /*** run the sql statement ***/
    if ($stmt->execute()) {
        populate_shoutbox();
    }
} 
}
catch(PDOException $e) {
    echo $e->getMessage();
}

if($_POST['refresh']) {
    populate_shoutbox();
}


function populate_shoutbox() {
    global $dbh;
    $sort = $_POST['sort'];
    $sql = "select * from shoutbox where sort= ' $sort' order by date_time desc limit 10 ";
    echo '<ul>';
    foreach ($dbh->query($sql) as $row) {
        echo '<li>';
        echo '<span class="date">'.date("d.m.Y H:i", strtotime($row['date_time'])).'</span>';
        echo '<span class="name">'.htmlspecialchars ($row['name']).'</span>';
        echo '<span class="message">'.htmlspecialchars ($row['message']).'</span>';
        echo '</li>';
    }
    echo '</ul>';
}
?>