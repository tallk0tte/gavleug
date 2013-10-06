<?php
if (isset($_POST['submit'])) {
    $target = "images/";
    $allowedExts = array("jpg", "jpeg");
    $target = $target . basename($_FILES['file_upload']['name']);


    //check for allowed extensions
    if ((($_FILES["file_upload"]["type"] == "image/jpg") || ($_FILES["file_upload"]["type"] == "image/jpeg"))) {
        $photoname = $_FILES["file_upload"]["name"];
        if (file_exists("images/" . $photoname)) {
            $msg = '<div class="error">Sorry <b>' . $photoname . '</b> already exists</div>';
        }
        
        if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target)) {
            $type = $_FILES["file_upload"]["type"];
            switch ($type) {
                case "image/jpeg":
                    $ext = ".jpeg";
                    break;
                case "image/jpg";
                    $ext = ".jpg";
                    break;
            }
            $msg = '<div class="success">
                                        <b>Upload: </b>' . basename($photoname) . '<br />
    					<b>Type: </b>' . $_FILES["file_upload"]["type"] . '<br />
    					<b>Size: </b>' . ceil(($_FILES["file_upload"]["size"] / 1024)) . 'Kb<br />
			  		</div>';
        } else {
            $msg = '<div class="error">Sorry, there was a problem uploading your file.</div>';
        }
    } else {
        $msg = '<div class="error">The file type you are trying to upload is not allowed!</div>';
    }
}
?>



<?php include '/database/init.php'; ?>
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

                <H3>Upload Images Here</H3>(<a href="bilder.php">View Gallery</a>)
                <?php 
                if (logged_in() == true){
                    
                
                ?>
                <div id="upload">
                    <?php echo @$msg; ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="file">Filename:</label>
                        <input type="file" name="file_upload" id="upload_file" />
                        <input type="submit" name="submit" value="Upload" />
                    </form>
                </div>
                <?php
                
                } else {
                    echo "You must be logged in to upload an image.";
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
