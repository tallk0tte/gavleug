<?php
include 'database/init.php';
if (empty($_POST) === false) {
    $error = array();
    
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $message    = $_POST['message'];
    
    if(empty($name) === true || empty($email) === true || empty($message) === true){
       $errors[] = 'Name, email and message are required!';
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errors[] = 'That\'s not a valid email dude, try again';
        }
    }
        
    if (empty($errors) === true){
        mail('', 'Contact form', $message, 'From: ' . $email);
        header('Location: about.php?sent');
        exit();
        
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Webbprojekt</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="css/images/favoicon.ico" >
    </head>
    <body>
        <div id="wrapper">

            <div id="header">

            </div><!-- end #header-->

            <?php include 'includes/menu.php'; ?>
            <?php include 'includes/sidebar.php'; ?>
           


                <div id="content">
                    
                     <?php 
                    if (isset($_GET['sent']) === true){
                    echo '<p>Thanks for contacting us!</p>';
                     } else {

                    ?>

                    <?php
                    if (empty($errors) === false){
                    echo '<ul>';
                    foreach($errors as $error){
                    echo '<li>', $error,'</li>';
                    }
                    echo '</ul>';
                    }
                    ?>

                    <h2>About us</h2>
                    
                     <form action="" method="post">
                    <p>
                        <label for="name">Name:</label><br>
                        <input type="text" name="name" id="name" <?php if (isset($_POST['name']) === true ) { echo 'value="', strip_tags($_POST['name']), '"';} ?>>
                    </p>
                    <p>
                        <label for="email">Email:</label><br>
                        <input type="text" name="email" id="email" <?php if (isset($_POST['email']) === true ) { echo 'value="', strip_tags($_POST['email']), '"';} ?>>
                    </p>
                    <p>
                        <label for="message">Message:</label><br>
                        <textarea name="message" id="message" <?php if (isset($_POST['message']) === true ) { echo strip_tags($_POST['message']);} ?>> </textarea> 
                    </p>
                    <p>
                        <input type="submit" value="Submit">
                    </p>
                    </form>     

                   <?php
                   }
                   ?>
                
            </div><!-- end #content-->

            <div id="search">
                
            </div><!-- end #search-->

            <div id="sidebar">
                <?php include 'includes/sidebarcontent.php'; ?>
            </div><!-- end #sidebar-->

            <div id="footer">
                <p>&COPY; Gefle Underground</p>
            </div>


        </div><!-- end #wrapper-->
    </body>
</html>
