<?php
function __autoload($className){
	require WEBROOT.'class/'.$className.'.class.php';
}

$path=str_replace('\\','/',dirname(__FILE__)).'/';

define('HOST','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DBNAME','');
define('CHARSET','utf8');
define('WEBROOT',$path);
?>