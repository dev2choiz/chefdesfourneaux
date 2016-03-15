<?php
session_start();

/*==== Chargement de l'autoloader ====*/
require_once('../Library/Loader/Autoloader.php');
$autoload = \Library\Loader\Autoloader::getInstance();

/*---- Si on travaille en ligne ----*/
$lsBasePath = '/homepages/36/d575341982/htdocs/chefdesfourneaux/site/';

/*---- Si on travaille en local ----*/
if ($_SERVER['HTTP_HOST'] === 'localhost') {
	if (file_exists ('c:/wamp/www/chefdesfourneaux/Public/index.php')) {
		$lsBasePath = 'c:/wamp/www/chefdesfourneaux/';
	} else if (file_exists ('c:/wamp/www/PROD/site/Public/index.php')) {
		/*---- c:/wamp/www/chefdesfourneaux/ ne doit pas exister ----*/
		$lsBasePath = 'c:/wamp/www/PROD/site/';
	}
}
$autoload::setBasePath($lsBasePath);



/*==== Chargement des settings====*/
$config = \Application\Configs\Settings::getInstance();
$lsBaseUrl = "http://{$_SERVER['HTTP_HOST']}";
$config::setBaseUrl($lsBaseUrl);
//$config::setBaseUrl("http://partagezvosrecettes.com");
$config::readSettings();



/**
 * Chargement du Router
 */
$router = \Library\Router\Router::getInstance();
$router::dispatchPage($_GET['page']);
	