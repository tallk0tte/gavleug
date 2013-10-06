<?php include 'database/init.php'; ?>
<?php
if (empty($_POST) === false) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    //Om username eller password är tomt
    if (empty($username) === true || empty($password) === true) {
        $errors [] = 'You must enter username and password';
    } else if (user_exists($username) === false) {
        $errors [] = 'We can\'t find that username';
    } else {
        $login = login($username, $password);

        if ($login === false) {
            $errors [] = 'That username or password is incorrect';
        } else {
            $_SESSION['user_id'] = $login;
            header('Location: index.php');
            exit();
        }
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
                if (empty($errors) == false) {
                    echo output_errors($errors);
                }
                ?>
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
