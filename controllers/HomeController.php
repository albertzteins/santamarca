<?php

require 'models/Background.class.php';
require 'models/Project.class.php';

$background = Background::getRandom();
$projects = Project::getAllByDate();

include VIEWS . 'home.php';

?>
