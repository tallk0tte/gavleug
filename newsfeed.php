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
                
                <?php
                if(logged_in() == true){
                if (mysql_connect('localhost', 'root', '') && mysql_select_db('gavleug')) {
                    $time = time();
                    $errors = array();
                    if (isset($_POST['news_namn'], $_POST['news_text'])) {

                        $news_namn = mysql_real_escape_string(htmlentities($_POST['news_namn']));
                        $news_text = mysql_real_escape_string(htmlentities($_POST['news_text']));
                        /* Checks if the fields are empty */
                        if (empty($news_namn) || empty($news_text)) {
                            $errors[] = 'All fields must be filled!';
                        }
                        if (strlen($news_namn) > 30 || strlen($news_text) > 1000) {
                            $errors[] = 'One of more fields have too many letters!';
                        }

                        if (empty($errors)) {
                            $insert = "INSERT INTO `newsfeed` VALUES ('', '$news_text', '$time', '$news_namn')";
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

                    $entries = mysql_query("SELECT `news_date`, `news_namn`, `news_text` FROM newsfeed ORDER BY `news_date` DESC");
                    
                    if(mysql_num_rows($entries)==0){
                        echo 'No entries yet!';
                    }
                    else{
                        while($entry_row = mysql_fetch_assoc($entries)){
                            $entries_date = date('D M Y @ h:i:s', $entry_row['news_date']);
                            $entries_namn = $entry_row['news_namn'];
                            $entries_text = $entry_row['news_text'];
                            
                            echo '<p><strong>Title: '.$entries_namn.' on '.$entries_date.'</strong>:<br>'.$entries_text.' </p>';
                            echo '<br>';
                        }
                    }
                } else {
                    echo 'Could not connect at this time';
                }
                }
                else{
                    echo 'You must be logged in to use this function!';
                }
                ?>
                <hr>    

                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <strong>Post title and newsfeed</strong><br>
                    Title: <br><input type="text" name="news_namn" maxlength="30"><br>
                    Message: <br><textarea name="news_text" rows="5" cols="30" maxlength="255"></textarea><br>
                    <input type="submit" value="Post">
                </form>
            </div><!-- end #content-->

            <div id="search">
                <input type="text" value="Search" placeholder="Function not available..">
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
