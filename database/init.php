<?php
require 'connectDatabase.php';
require 'functions.php';

error_reporting(0);
session_start();
header("Content-Type: text/html; charset=UTF-8");

if (logged_in() === true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($session_user_id['user_id'], 'username');
}

?>
