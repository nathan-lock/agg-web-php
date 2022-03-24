<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');

$page = $_GET['p'];
if(!$page){
  $page = "home";
}
session_start();
require_once(__DIR__.'/php_modules/sendgrid-php/sendgrid-php.php');
require_once(__DIR__.'/includes/autoloader.php');
require_once(__DIR__.'/includes/database.php');
require_once(__DIR__.'/includes/header.php');
require_once(__DIR__.'/pages/'.$page.'.php');
require_once(__DIR__.'/includes/footer.php');