<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Panel de administración | Santamarca</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <style type="text/css">
    body {
      padding-top: 60px;
      padding-bottom: 40px;
    }
    h1 {
      margin-bottom: 40px;
    }
  </style>
</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="brand" href="/">Santamarca</a>
        <ul class="nav">
          <li<?=!isset($current_nav) ? ' class="active"' : null?>><a href="/admin/">Inicio</a></li>
          <li<?=isset($current_nav) && $current_nav == 'backgrounds' ? ' class="active"' : null?>><a href="backgrounds.php">Backgrounds</a></li>
          <li<?=isset($current_nav) && $current_nav == 'projects' ? ' class="active"' : null?>><a href="projects.php">Casos</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container">
