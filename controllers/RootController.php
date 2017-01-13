<?php

class RootController
{
  private $name;
  private $uri;
  private $title;
  private $page_handlers = array();
  private $default_file;
  private $views_path;
  private $error_file;
  
  private $current_page = '';
  
  function __construct($uri, $name, $default_file, $views_path, $error_file)
  {
    $this->uri = $uri;
    $this->name = $name;
    $this->default_file = $default_file;
    $this->views_path = $views_path;
    $this->error_file = $error_file;
  }
  
  /* Setters */
  function setName($name) { $this->name = $name; }
  function setTitle($title) { $this->title = $title; }
  function setURI($uri) { $this->uri = $uri; }
  function setViewsPath($views_path) { $this->views_path = $views_path; }
  
  /* Getters */
  function getCurrentPage() { return $this->current_page; }
  function getName() { return $this->name; }
  function getTitle() { return $this->title; }
  function getURI() { return $this->uri; }
  function getViewsPath() { return $this->views_path; }
  
  /* Methods */
  function addPageHandler($uri, $file, $params = array())
  {
    $this->page_handlers[$uri] = array(
      'file' => $file,
      'params' => $params
      );
  }
  
  function includeFile($file)
  {
    include $this->views_path . '/' . $file;
  }
  
  function getControllerToInclude()
  {
    /* Remove the useless stuff from the URI */
    $page_uri = $_SERVER['REQUEST_URI'];
    $pos = strpos($page_uri, '?');
    if ($pos) $page_uri = substr($page_uri, 0, $pos);
    $page_uri = str_replace('dctm', '', $page_uri);
    $page_uri = trim($page_uri, '/');

    /* Still has something? Lets parse it! */
    if ($page_uri)
    {
      $page_uri = explode('/', $page_uri);
      
      if (array_key_exists($page_uri[0], $this->page_handlers)) { // We have a handler, let's deliver!
        
        if ((count($page_uri) - 1) <= count($this->page_handlers[$page_uri[0]]['params'])) {
          
          // First let's register the globals, if any
          foreach($this->page_handlers[$page_uri[0]]['params'] as $uri_position => $param_name) {
            $GLOBALS[$param_name] = isset($page_uri[$uri_position]) ? $page_uri[$uri_position] : false;
          }
          
          $this->current_page = $page_uri[0];
          return $this->page_handlers[$page_uri[0]]['file'];
        
        } else
          return $this->error_file; // There are too many params, so it is fake!
        
      } else
        return $this->error_file; // We don't have a handler for that yet, let's just throw an error page
      
    }
    else // No luck, let's just return the index page
    {
      $this->current_page = 'index';
      return $this->default_file;
    }
  }
  
}

?>
