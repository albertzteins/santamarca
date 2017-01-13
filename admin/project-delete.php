<?php
require 'inc/includes.php';

if (isset($_GET['id']) && ctype_digit($_GET['id'])):

  // Controller
  require '../models/Project.class.php';

  $project = Project::get((int)$_GET['id']);

  if (!$project) redirect('projects.php');
  
  if (isset($_GET['delete']) && $_GET['delete'])
  {

    if ($project->delete())
      redirect('projects.php');
    else
      $deleteError = true;

  }
  
  $current_nav = 'projects';

  include 'header.php';
?>
    <h1>Eliminar caso</h1>
    <p>¿Estás seguro que deseas eliminar el caso <strong><?=$project->getName()?></strong>?</p>
    <a href="?id=<?=$project->getId()?>&amp;delete=true" class="btn btn-danger">Sí, eliminar</a>
<?php include 'footer.php'; ?>
<?php else: redirect('projects.php'); ?>
<?php endif; ?>
