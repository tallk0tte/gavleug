<?php include '/database/init.php'; ?>

<?php
//Sökfunktion
$output = "";

//Hämta "information" som finns i databasen
if (isset($_POST['search'])) {
    $searchq = $_POST['search'];
    
    $query = mysql_query("SELECT * FROM guestbook WHERE  gb_text LIKE '%$searchq%'") or die("Could not search!");
    $count = mysql_num_rows($query);

    if ($count == 0) {
        $output = "There was no search results!";
    } else {
        while ($row = mysql_fetch_array($query)) {
            $gb_namn = $row['gb_namn'];
            $gb_text = $row['gb_text'];           
            $output .= '<div><p><strong>' . $gb_text . '</strong><br>Author:<u>' . $gb_namn . '</u></p></div><br>';
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
                 //Om användaren har använt sökt så visa upp detta
                if (isset($_POST['search'])) {
                    ?> 
                <h1>You search results...</h1>
                <br>
                
                    <?php
                    echo $output;
                } else {
                    
                    //Annars, vissa upp det här (Det nedanför)
                ?>   
                
                <h1><center>Gästboken</center></h1>
                <br>
                
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <strong>Post something... </strong><br>
                    Name: <br><input type="text" name="gb_namn" maxlength="30"><br>
                    Email:<br><input type="text" name="gb_email" maxlenth="255"><br>
                    Message: <br><textarea name="gb_text" rows="5" cols="30" maxlength="255"></textarea><br>
                    <input type="submit" id="button" value="Post">
                </form>
                <br>
                <br>
                <?php
                if (mysql_connect('localhost', 'root', '') && mysql_select_db('gavleug')) {
                    $time = time();
                    $errors = array();


                    if (isset($_POST['gb_namn'], $_POST['gb_email'], $_POST['gb_text'])) {
                        
                        //Använder mysql_real_escape för att undvika SQL-injections
                        $gb_namn = mysql_real_escape_string(htmlentities($_POST['gb_namn']));
                        $gb_email = mysql_real_escape_string(htmlentities($_POST['gb_email']));
                        $gb_text = mysql_real_escape_string(htmlentities($_POST['gb_text']));
                        /* Kollar om något fällt är tomt */
                        if (empty($gb_namn) || empty($gb_email) || empty($gb_text)) {
                            $errors[] = 'All fields must be filled!';
                        }
                        /* Kollar om något fält är för långt */
                        if (strlen($gb_namn) > 30 || strlen($gb_email) > 255 || strlen($gb_text) > 255) {
                            $errors[] = 'Ett eller flera fält överskrider teckengränserna.';
                        }
                        
                        /* Om det inte finns några error, så lägg till i databasen*/
                        if (empty($errors)) {
                            //SQL-frågan till databasen
                            $insert = "INSERT INTO `guestbook` VALUES ('', '$gb_text', '$gb_namn', '$gb_email', '$time')";
                            if (mysql_query($insert)) {
                                header('Location:' . $_SERVER['PHP_SELF']);
                                die();
                            } else {
                                $errors[] = 'Something went wrong. Please try again soon';
                            }
                        } else {
                            //Foreach loop som skriver ut errors (som ligger i en array, om det nu finns errors
                            foreach ($errors as $errors) {
                                echo'<p><strong>' . $errors . '</strong></p>';
                            }
                        }
                    }
                    
                    //SQL-fråga för att hämta informationen från databasen, för att skriva ut innehållet.
                    $entries = mysql_query("SELECT `gb_date`, `gb_namn`, `gb_email`, `gb_text` FROM guestbook ORDER BY `gb_date` DESC");
                                        
                    if(mysql_num_rows($entries)==0){
                        echo 'No entries yet!';
                    }
                    else{
                        while($entry_row = mysql_fetch_assoc($entries)){
                            $entries_date = date('D M Y @ h:i:s', $entry_row['gb_date']);
                            $entries_namn = $entry_row['gb_namn'];
                            $entries_email = $entry_row['gb_email'];
                            $entries_text = $entry_row['gb_text'];
                            
                            echo '<p><strong>Posted by '.$entries_namn.' on '.$entries_date.'</strong>:<br>'.$entries_text.' </p>';
                        }
                    }
                } else {
                    echo 'Could not connect at this time';
                }
                
                }
                ?>
                <hr>    

                


            </div><!-- end #content-->

            <div id="search">
                <form action="" method="post">
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
