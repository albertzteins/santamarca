<?php
error_reporting(E_ALL | E_STRICT);
require 'inc/includes.php';

if (isset($_GET['id']) && ctype_digit($_GET['id'])):

  // Controller
  require '../models/Project.class.php';

  $project = Project::get((int)$_GET['id']);

  if (!$project) redirect('projects.php');

  if ($_POST)
  {
  
    $project->setName(getFormValue('name'));
    $project->setDescription(getFormValue('description'));
  
    if ($project->update())
      redirect('projects.php');
    else
      $editError = true;
  }
  
  $current_nav = 'projects';
  include 'header.php';
?>
    <h1>Editar caso</h1>
    <form action="/admin/project-edit.php?id=<?=$project->getId()?>" method="post">
      <fieldset>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="input-xlarge" value="<?=$project->getName()?>" />
        <label for="description">Descripción</label>
        <textarea id="description" name="description" class="input-xxlarge"><?=$project->getDescription()?></textarea>
        <br /><br />
        <div class="control-group">
          <button type="submit" class="btn btn-primary">Editar caso</button>
        </div>
      </fieldset>
    </form>
<?php include 'footer.php'; ?>
<?php else: redirect('projects.php'); ?>
<?php endif; ?>
