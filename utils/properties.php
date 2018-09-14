<?php

define("BASE_URL", "http://localhost/ecommerce/");

define("MODULE_LOGIN", "comum");
define("PAGE_LOGIN", "login");

define("MODULE_HOME", "anuncio");
define("PAGE_HOME", "feed");

define("ADM_PERFIL", "1");

const PUBLIC_PAGES = array('login' => array('controller' => 'comum'), 
                           'novousuario' => array('controller' => 'comum'),
                           'get_cidades_by_estado' => array('controller' => 'pessoa')
			  );

define("UPLOAD_FOLDER", "/home/wellington/img_ecommerce/");
define("NO_IMAGE_FILE", "no_image.jpg");


define("DB_HOST", "127.0.0.1");
define("DB_PORT", "5432");
define("DB_USER", "postgres");
define("DB_PASSWORD", "postgres");
define("DB_NAME", "ecommerce");

?>