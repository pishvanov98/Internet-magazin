<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=localhost;dbname=host1828673','host1828673', 'RpC29dOecz' ); 
if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');

}
?>