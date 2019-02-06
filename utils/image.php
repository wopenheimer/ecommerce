<?php
    include_once("properties.php");
    header('Content-Type: image/jpeg');
    readfile(UPLOAD_FOLDER . $_GET["img"]);
?>