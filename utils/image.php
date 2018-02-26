<?php
    session_start();
	header('Content-Type: image/jpeg');
    readfile($_SESSION["UPLOAD_FOLDER"] . $_GET["img"]);
?>