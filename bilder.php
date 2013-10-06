

﻿<?php include '/database/init.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title>Webbprojekt</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="css/images/favoicon.ico" >
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">

            <div id="header">

            </div><!-- end #header-->

            <?php include 'includes/menu.php'; ?>
            <?php include 'includes/sidebar.php'; ?>

            <div id="contentGallery">
                <div id="galleriTabell">
                        <img  src="huvudbild.jpg" id="huvudbild" width="680" height="540">
                        <br>
                    <?php
                    include 'gallery.php';
                    $x = getArrayFromPath('images/');
                    writeImagesFromArray($x, 4);
                    ?>

                </div> 
            </div><!-- end #content-->

            

            <div id="footer">
                <p>&COPY; Gefle Underground</p>
            </div>


        </div><!-- end #wrapper-->
    </body>
</html>
