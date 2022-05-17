<?php

require_once "db_connect.php";

$db_connect = mysqli_connect('localhost', '2095334_db', 'XXX' ,'2095334_db');

// if ($db_connect -> connect_error ){
//     die('connect Error ('. $db_connect->connect_errno . ') '. $db_connect ->connect_error);
// }

if(mysqli_connect_errno()){
die('Connect Error(' . mysqli_connect_errno(). ') '. mysqli_connect_error());
}else{
   // echo("connected");
}


?>