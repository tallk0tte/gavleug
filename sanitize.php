<?php
//måste ha denna för att förhindra SQL-injections
function array_sanitize(&$item){
    $item = mysql_real_escape_string($item);
}

?>
