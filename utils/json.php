<?php
    session_start();
    header('Content-Type: application/json;charset=utf-8');
    print json_encode(array('content' => $_SESSION["json_content"]));
?>

