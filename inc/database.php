<?php

try
{
  $pdo_options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
  );
  $db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=UTF8', MYSQL_USER, MYSQL_PASS, $pdo_options);
}
catch (PDOException $e)
{
  if (DEVELOPMENT)
    echo 'Error: ' . $e->getMessage() . '<br />' . chr(10);
  else
    echo 'Hubo un error al conectarse a la base de datos.' . chr(10);
  die();
}

?>
