<?php include '/database/init.php'; ?>
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
                
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <strong>Post title and newsfeed</strong><br>
                    Title: <br><input type="text" name="tips_titel" maxlength="30"><br>
                    Email: <br><input type="text" name="tips_email" maxlength="50"><br>
                    Message: <br><textarea name="tips_text" rows="5" cols="30" maxlength="255"></textarea><br>
                    <input type="submit" id="button" value="Post">
                </form>
                <br>
                <br>
                
                <?php
                if (mysql_connect('localhost', 'root', '') && mysql_select_db('gavleug')) {
                    $errors = array();
                    if (isset($_POST['tips_titel'], $_POST['tips_text'], $_POST['tips_email'])) {
                        
                        $tips_titel = mysql_real_escape_string(htmlentities($_POST['tips_titel']));
                        $tips_text = mysql_real_escape_string(htmlentities($_POST['tips_text']));
                        $tips_email = mysql_real_escape_string(htmlentities($_POST['tips_email']));
                        /* Checks if the fields are empty */
                        if (empty($tips_titel) || empty($tips_text) || empty($tips_email)) {
                            $errors[] = 'All fields must be filled!';
                        }
                        if (strlen($tips_titel) > 30 || strlen($tips_text) > 1000) {
                            $errors[] = 'One of more fields have too many letters!';
                        }

                        if (empty($errors)) {
                            $insert = "INSERT INTO `tips` VALUES ('', '$tips_titel', '$tips_text', '$tips_email')";
                            if (mysql_query($insert)) {
                                header('Location:' . $_SERVER['PHP_SELF']);
                                die();
                            } else {
                                $errors[] = 'Something went wrong. Please try again soon';
                            }
                        } else {
                            foreach ($errors as $errors) {
                                echo'<p><strong>' . $errors . '</strong></p>';
                            }
                        }
                    }
                    $entries = mysql_query("SELECT `tips_titel`, `tips_text`, `tips_email` FROM tips");
                    
                    if(mysql_num_rows($entries)==0){
                        echo 'No entries yet!';
                    }
                    else{
                        while($entry_row = mysql_fetch_assoc($entries)){
                            $entries_titel = $entry_row['tips_titel'];
                            $entries_text = $entry_row['tips_text'];
                            $entries_email = $entry_row['tips_email'];
                            
                            echo '<p><strong>'.$entries_titel.' from '. $entries_email.'</strong>:<br>'.$entries_text.' </p>';
                        }
                    }
                    
                } else {
                    echo 'Could not connect at this time';
                }
                
                ?>
                <hr>    

                
            </div><!-- end #content-->

            <div id="search">
                <input type="text" placeholder="Not working on tips yet..">
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
