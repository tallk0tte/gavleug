<?php include 'database/init.php'; ?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
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
                if (isset($_POST['description'], $_POST['evdate'], $_POST['title'])) {
                    
                    //Använder mysql_real_escape för att undvika SQL-injections
                    $title = mysql_real_escape_string(htmlentities($_POST['title']));
                    $description = mysql_real_escape_string(htmlentities($_POST['description']));
                    $evdate = mysql_real_escape_string(htmlentities($_POST['evdate']));
                    
                    /* Kollar om något fällt är tomt */
                    if (empty($description) || empty($evdate) || empty($title)) {
                        $errors[] = 'All fields must be filled!';
                    }
                    
                    if(strlen($title) > 40){
                        $errors [] = 'Error. You can enter maximum 40 characters.';
                    }
                    
                    if(strlen($description) > 255){
                        $errors [] = 'Error. You can enter maximum 40 characters.';
                    }
                    
                    if(strlen($evdate) > 10){
                        $errors [] = 'Error. Date cannot be longer than 10 chars, M/DD/YEAR (3/29/2013)';
                    }
                    
                    if (empty($errors)) {
                        //Lägger till i databasen
                        $insert = "INSERT INTO `events` VALUES ('', '$title','$description', '$evdate')";
                        if (mysql_query($insert)) {
                            echo 'Event succesfully added!';
                        } else {
                            $errors[] = 'Something went wrong. Please try again soon';
                        }
                    } else {
                        foreach ($errors as $errors) {
                            echo'<p><strong>' . $errors . '</strong></p>';
                        }
                    }
                }
                ?>
                
                <form action="" method="POST">
                    <br>
                    Title:<br>
                    <input type="text" name="title">
                    <br>
                    <br>
                    Event information:<br>
                    <textarea name="description" rows="5" cols="30"></textarea>
                    <br>
                    Datum:<br>
                    <input type="text" name="evdate">(M/DD/YEAR, exempel: 3/25/2013)
                    <br>
                    <input type="submit" value="Lägg till...">
                </form>


            </div><!-- end #content-->

            <div id="search">
                <form action="" method="POST">
                    <input type="text" name="search" placeholder="Search...">
                </form>
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
