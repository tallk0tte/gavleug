<?php

$conn = mysql_connect('localhost', 'root', '') or die("Could not connect to database");
if(mysqli_connect_errno($conn)){
    echo 'PROBLEMS! '. mysqli_connect_error(); 
}

$_variabel = mysql_query('SELECT * FROM users');
echo $_variabel;
mysql_select_db('gavleug') or die("Could not select database");

?>
