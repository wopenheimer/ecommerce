<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function index() {
    $GLOBALS['mail'] = create_instance_email();
    switch (check_session_active()) {
        case true:
            if (isset($_REQUEST["module"]) && isset($_REQUEST["page"]))  {
              $module = $_REQUEST["module"];
              $page = $_REQUEST["page"];
              if ($page != PAGE_LOGIN) {
                if(isset($module) && $module != ""){
                  if(isset($page) && $page != ""){
                    include("controller/" . $module ."Controller.php");
                  }
                }                   
              } else {
                $_REQUEST["page"] = PAGE_HOME;
                include("controller/" . MODULE_HOME ."Controller.php");                
              }
            } else {
              $_REQUEST["page"] = PAGE_HOME;
              include("controller/" . MODULE_HOME ."Controller.php");                
            }
            break;
        case false:
            $module = MODULE_LOGIN;
            $page = PAGE_LOGIN;        
            if (isset($_REQUEST["module"]) && isset($_REQUEST["page"]))  {
                foreach (PUBLIC_PAGES as $key => $value) {
                  if ($_REQUEST["page"] == $key) {
                    $module = $value['controller'];
                    $page = $key;
                    break;
                  }
                }                
            }    
            $_REQUEST["page"] = $page;
            include("controller/" . $module ."Controller.php");              
            break;        
        default:
            # code...
            break;
    }
}


function render($args, $template){
    include("view/" . $template . ".php");
}


function check_session_active() {
    if (isset($_SESSION["userid"]) &&
            isset($_SESSION["username"]) &&
            isset($_SESSION["useremail"]) &&
            isset($_SESSION["usercpf"])&&
            isset($_SESSION["userperfil"])) {
            return true;
    } else {
        return false;
    }
}


function create_session_user($usuario) {
    if (!isset($_SESSION["userid"]) &&
            !isset($_SESSION["username"]) &&
            !isset($_SESSION["useremail"]) &&
            !isset($_SESSION["usercpf"])&&
            !isset($_SESSION["userperfil"])) {

        $_SESSION["userid"] = $usuario->getId();
        $_SESSION["username"] = $usuario->getPessoa()->getNome();
        $_SESSION["useremail"] = $usuario->getEmail();
        $_SESSION["usercpf"] = $usuario->getPessoa()->getCpf();
        $_SESSION["userperfil"] = $usuario->getPerfil()->getId();
        $_SESSION["UPLOAD_FOLDER"] = UPLOAD_FOLDER;

    } 
}


function is_adm_user() {
    if ($_SESSION["userperfil"] == ADM_PERFIL) {
        return true;
    } else {
        return false;
    }
}


function destroy_session_user() {
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["useremail"]);
    unset($_SESSION["usercpf"]);
    unset($_SESSION["userperfil"]);
    unset($_SESSION["UPLOAD_FOLDER"]);

    session_unset();
    session_destroy();
}


function validInputData($var) {
    if (isset($var)) {
        $var = strip_tags($var);
        $var = addslashes($var);
        $var = trim($var);
        $var = pg_escape_string($var);   
        $chars = [";", "-", "&", "%", "#", "$", "*", "|", "="];
        foreach ($chars as $key => $value) {
            $var = str_replace($value, "", $var);   
        }
        return $var;            
    } else {
        return null;
    }
}   


function validInputDate($data){
    if ( strlen($data) < 8){
        return false;
    }else{
        if(strpos($data, "/") !== FALSE){
            $partes = explode("/", $data);
            $dia = $partes[0];
            $mes = $partes[1];
            $ano = isset($partes[2]) ? $partes[2] : 0;

            if (strlen($ano) < 4) {
                return false;
            } else {
                if (checkdate($mes, $dia, $ano)) {
                     return true;
                } else {
                     return false;
                }
            }
        }else{
            return false;
        }
    }
}

function validInputEmail($email){
    if (!preg_match("/^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})/",$email)){
        return false;
    } else {
        $dominio=explode('@',$email);
        if(!checkdnsrr($dominio[1],'A')){
                return false;
        } else {
            return true;                
        }
    }
}


function generateRandomId() {
    return bin2hex(openssl_random_pseudo_bytes(32));
}


function uploadFile($file) {
    $target_dir = UPLOAD_FOLDER;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($file["name"]);
    $target_name = generateRandomId();
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($file["size"] > 500000) {
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        $target_name = $target_name . '.' . $imageFileType;
        $target_upload = $target_dir . $target_name;
        if (move_uploaded_file($file["tmp_name"], $target_upload)) {
            //echo "The file ". basename( $file["name"]). " has been uploaded.";
            return $target_name;
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }    
}

function create_instance_email() {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = EMAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL_USERNAME;
    $mail->Password = EMAIL_PASSWORD;
    $mail->SMTPSecure = 'tls';
    $mail->Port = EMAIL_PORT;
    $mail->setFrom(EMAIL_FROM, 'Ecommerce');
    $mail->isHTML(true);
    
    return $mail;
}
?>

