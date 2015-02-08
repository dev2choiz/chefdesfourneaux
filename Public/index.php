<?php
session_start();


/**
 * Chargement de l'autoloader
 */
require_once('../Library/Loader/Autoloader.php');
$autoload = \Library\Loader\Autoloader::getInstance();
$autoload::setBasePath("c:/wamp/www/fourneaux/");


/**
 * Chargement des settings
 */
$config = \Application\Configs\Settings::getInstance();
$config::setBaseUrl("http://localhost");
$config::readSettings();



/**
 * Connexion a la base de donnée
 */
$DB = \Library\Model\Connexion::getInstance();
$DB::addConnexion("localhost", $DB::connectDB('localhost', 'fourneaux', 'root', ''));





/**
 * Chargement du Router
 */
$router = \Library\Router\Router::getInstance();
$router::dispatchPage($_GET['page']);


var_dump($_SESSION);