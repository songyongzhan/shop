<?php

define('ENVIRONMENT', isset($_SERVER['HTTP_ENV']) ? $_SERVER['HTTP_ENV'] : 'product');
isset($_SERVER['HTTP_FETCH_DUMMY']) && define('FETCH_DUMMY', $_SERVER['HTTP_FETCH_DUMMY']);
define('APP_PATH', dirname(__FILE__));
define('CONFIGPATH', APP_PATH . '/app/configs/config.ini');
require_once APP_PATH . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
if (!defined('CONFIGPATH')) echo 'No configpath defined, please define configpath and try again.';

switch (ENVIRONMENT) {
  case 'develop':
    error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set('yaf.environ', 'develop');
    break;
  case 'testing':

  case 'product':
    ini_set('display_errors', 0);

    break;
  default:
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'The application environment is not set correctly.';
    exit(1); // EXIT_ERROR
}


//http://php.net/manual/zh/yaf-application.getconfig.php

global $argc, $argv;
printf("=========notice=========\n 通过cli 传递到控制器方法中是一个数组 \n=========notice=========\n");
if ($argc > 1) {
  $application = new Yaf_Application(CONFIGPATH);

  $requstUri = $argv[1];
  $requstUri = str_replace('request_uri=', '', $requstUri);
  $requestUriArr = explode('/', trim($requstUri, '/'));

  if (count($requestUriArr) < 3) {
    printf("==================\n必须指定模块名\n==================");
  }


  $params = array_slice($argv, 2);

  $moduleName = $requestUriArr[0];
  $controllerClass = $requestUriArr[1];
  $actionName = $requestUriArr[2];

  $result = $application->execute([getInstance($controllerClass, $moduleName), $actionName . 'Action'], $params);
  printf("\n=============result===============\n%s\n=============result===============\n",var_export($result,true));
}

?>
