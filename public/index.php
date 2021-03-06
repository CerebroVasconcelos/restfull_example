<?php


// configurações do Vasconcelos

 /**
  * Display all errors when APPLICATION_ENV is development.
  * Coloquei este troço para exibir os erros. By Vasconcelos
  */
 //if ($_SERVER['APPLICATION_ENV'] == 'development') {
     error_reporting(E_ALL);
     ini_set("display_errors", 1);
 //}

//tempo máximo de execução
set_time_limit(9);
ini_set('max_execution_time', 15);

// timezone
if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('America/Manaus');
}


define('ROOT_PATH', dirname(__DIR__));


// fim configurações do Vasconcelos


/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';


// coisa do Ab%Api
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}
// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
