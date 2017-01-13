<?php
error_reporting(E_ALL | E_STRICT);
require 'inc/includes.php';

// Controller
require '../models/Project.class.php';

if ($_POST)
{
  $project = new Project();

  $project->setName(getFormValue('name'));
  $project->setDescription(getFormValue('description'));
  $project->setDate(date(MYSQL_DATETIME));

  if ($project->save())
    redirect('projects.php');
}

$current_nav = 'projects';
include 'header.php';
?>
    <h1>Agregar caso</h1>
    <form action="/admin/project-add.php" method="post">
      <fieldset>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="input-xlarge" />
        <label for="description">Descripción</label>
        <textarea id="description" name="description" class="input-xxlarge"></textarea>
        <br /><br />
        <div class="control-group">
          <button type="submit" class="btn btn-primary">Agregar caso</button>
        </div>
      </fieldset>
    </form>
<?php include 'footer.php'; ?>
