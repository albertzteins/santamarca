<?php

function displayError($code = 404)
{
  include 'controllers/ErrorController.php';
}

function getFormValue($name)
{
  if (isset($_POST[$name]))
    return $_POST[$name];
  else
    return false;
}

function redirect($url)
{
  header("Location: " . $url);
}

function get_header($properties = '', $add_to_header = '')
{
  global $root;
  
  if (is_array($properties))
  {
    $body_style = isset($properties['body-style']) ? $properties['body-style'] : '';
  }
  else
  {
    $body_style = $properties ? $properties : '';
  }

  include VIEWS . 'header.php';
}

function get_footer($properties = '', $add_to_footer = '')
{
  global $root;
  
  include 'views/footer.php';
}
