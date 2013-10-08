<?php require './sanitize.php';?>
<?php

//Kollar om man är inloggad
function logged_in() {
    return (isset($_SESSION['user_id'])) ? true : false;
}

/*Register users*/
function register_user($register_data){
    array_walk($register_data, 'array_sanitize');
    $register_data['password'] = md5($register_data['password']);
    
    $fields = '`' . implode('`, `', array_keys($register_data)) . '`';
    $data = '\'' . implode('\', \'', $register_data) . '\'';
    
    echo "INSERT INTO `users`($fields) VALUES ($data)";
    mysql_query("INSERT INTO `users`($fields) VALUES ($data)");
}

//Skriver ut errors
function output_errors($errors){
    $output = array();
    foreach ($errors as $error) {
        $output[] = '<li>'. $error. '</li>';               
    }
    return '<ul>'. implode('', $output) .'</ul>';
}

//Om användaren existerar
function user_exists($username) {
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' ");
    return (mysql_result($query, 0) == 1) ? true : false;
}


//om emailen existerar
function email_exists($email){
    return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_email` = '$email'"), 0) == 1) ? true : false;
}

//Hämtar user id från username
function user_id_from_username($username) {
    return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'"), 0, 'user_id');
}

//Kollar om inmatade username finns i databasen och om lösenord matchar deb
function login($username, $password) {
    $user_id = user_id_from_username($username);
    return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' 
        AND `password` = '$password'"), 0) == 1) ? $user_id : false;
}

//Skriver info om user
function user_data($user_id) {
    $data = array();
    $user_id = (int)$user_id;
    
    $func_num_args = func_num_args();
    $func_get_args = func_get_args();
    
    if($func_num_args > 0){
        unset($func_get_args[0]);
        
        $fields = '`' . implode('`, `', $func_get_args ) . '`';
        $data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));
        
        return $data;
    }
    
}

?>
