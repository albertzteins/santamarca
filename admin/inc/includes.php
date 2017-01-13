<?php

# Includes
require_once '../inc/config.php';
require_once '../inc/functions.php';

define('VIEWS', '../views/');

if (DEVELOPMENT) error_reporting(E_ALL | E_STRICT);
else error_reporting(0);

# Set dabatase
require '../inc/database.php';

?>
