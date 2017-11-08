<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function index() {
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
            $_REQUEST["page"] = PAGE_LOGIN;
            include("controller/" . MODULE_LOGIN ."Controller.php");              
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
            isset($_SESSION["usercpf"])) {
            return true;
    } else {
        return false;
    }
}


function create_session_user($usuario) {
    if (!isset($_SESSION["userid"]) &&
            !isset($_SESSION["username"]) &&
            !isset($_SESSION["useremail"]) &&
            !isset($_SESSION["usercpf"])) {

        $_SESSION["userid"] = $usuario->getId();
        $_SESSION["username"] = $usuario->getPaciente()->getNome();
        $_SESSION["useremail"] = $usuario->getEmail();
        $_SESSION["usercpf"] = $usuario->getPaciente()->getCpf();

    } 
}


function destroy_session_user() {
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["useremail"]);
    unset($_SESSION["usercpf"]);

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


?>

