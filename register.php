<?php include 'database/init.php'; ?>

<?php

/*Validation*/
if (empty($_POST) === false) {
    $required_fields = array('username', 'password', 'password_again', 'name_fname', 'name_surname', 'email',);
    /* Loop which checks if required fields have a value */
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Error. Lacking input in required fields';
            break 1;
        }
    }
    
        
        /* Checks if username already exists */
        if (empty($errors) === true) {
            if (user_exists($_POST['username']) === true) {
                $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
            }
        }
        if (preg_match("/\\s/", $_POST['username']) == true) {
            $errors[] = 'Your username must not contain any spaces!';
        }
        /* Checks if the password is equal or longer than 6, if not, error. */
        if (strlen($_POST['password'] >= 6)) {
            $errors[] = 'Your y
                apssword does not fulfill the requirements.';
        }
        /* Checks if the passwords match */
        if ($_POST['password'] !== $_POST['password_again']) {
            $errors[] = 'Your passwords doesn\'t match!';
        }
        
        if (ctype_alpha($_POST['user_fname']) === false) {
            $errors[] = 'Name cannot contain spaces or numbers!';
        }
        
        if (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'A valid email address is required';
        }
        
        if (email_exists($_POST['user_email']) === true) {
            $errors[] = 'Sorry, the email \'' . $_POST['user_email'] . '\' is already in used.';
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
                <h1>Register</h1>
                
                <?php
                if (isset($_GET['success']) && empty($_GET['success'])) {
                    echo 'You have been registred successfully!';
                }

                if (empty($_POST) === false && empty($errors) === true) {
                   
                    $register_data = array(
                        'username'        =>$_POST['username'],
                        'password'        =>$_POST['password'],
                        'user_fname'      =>$_POST['user_fname'],
                        'user_ename'      =>$_POST['user_ename'],
                        'user_email'      =>$_POST['user_email']
                    );
                    register_user($register_data);
                    header('Location: register.php?success');
                    exit();
                } else if (empty($errors) === false) {
                    echo output_errors($errors);
                }
                ?>
                <form action="" method="post">
                    <ul>
                        <li class="register">
                            Username*:<br>
                            <input type="text" name="username">
                        </li>
                        <li class="register">
                            Password*:<br>
                            <input type="password" name="password">
                        </li>
                        <li class="register">
                            Password again*:<br>
                            <input type="password" name="password_again">
                        </li>
                        <li class="register">
                            First name*:<br>
                            <input type="text" name="user_fname">
                        </li>
                        <li class="register">
                            Surname:<br>
                            <input type="text" name="user_ename">
                        </li>
                        <li class="register">
                            Email*:<br>
                            <input type="text" name="user_email">
                        </li>
                        <li class="register">
                            <br>
                            <input type="submit" id="button" value="Registrera" name="register">
                        </li>

                </form>

            </div><!-- end #content-->

            <div id="search">
                <input type="text" value="Search" placeholder="Search...">
            </div><!-- end #search-->

            <div id="sidebar">
                <h3>Rubrik</h3>
            </div><!-- end #sidebar-->

            <div id="footer">
                <p>&COPY; Gefle Underground</p>
            </div>



        </div><!-- end #wrapper-->
    </body>
</html>
