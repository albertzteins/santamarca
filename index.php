<?php
header ('Content-type: text/html; charset=utf-8');

# Includes
require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'controllers/RootController.php';

if (DEVELOPMENT) error_reporting(E_ALL | E_STRICT);
else error_reporting(0);

# Set dabatase
require 'inc/database.php';

# Set the site's URI, name, index page and error page
$root = new RootController(SITE_URI, SITE_NAME, 'controllers/HomeController.php', 'views', 'controllers/ErrorController.php');

define('VIEWS', $root->getViewsPath() . '/');

# Add each page handler
$root->addPageHandler('ajax', 'controllers/AjaxController.php', array(1 => 'script'));

$controller = $root->getControllerToInclude();
$current_page = $root->getCurrentPage();
require $controller;

# Close database connection
$db = null;

?>
