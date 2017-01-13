<?php
require 'inc/includes.php';

if (isset($_GET['id']) && ctype_digit($_GET['id'])):

  // Controller
  require '../models/Background.class.php';

  $background = Background::get((int)$_GET['id']);

  if (!$background) redirect('backgrounds.php');
  
  if (isset($_GET['delete']) && $_GET['delete'])
  {

    if ($background->delete())
    {
      unlink(CONTENT_PATH . 'backgrounds/' . $background->getId() . '.jpg');
      redirect('backgrounds.php');
    }

  }
  
  $current_nav = 'backgrounds';

  include 'header.php';
?>
    <h1>Eliminar fondo</h1>
    <p>¿Estás seguro que deseas eliminar este fondo?</p>
    <a href="?id=<?=$background->getId()?>&amp;delete=true" class="btn btn-danger">Sí, eliminar</a>
<?php include 'footer.php'; ?>
<?php else: redirect('backgrounds.php'); ?>
<?php endif; ?>
