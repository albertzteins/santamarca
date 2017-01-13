<?php
error_reporting(E_ALL | E_STRICT);
require 'inc/includes.php';

// Controller
require '../models/Project.class.php';
$projects = Project::getAllByName();

$current_nav = 'projects';
include 'header.php';
?>
    <h1>Casos</h1>
    <ul class="nav nav-pills">
      <li>
        <a href="project-add.php">Agregar caso</a>
      </li>
    </ul>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($projects as $project): ?>
        <tr>
          <td><?=$project->getName()?></td>
          <td><a href="project-images.php?id=<?=$project->getId()?>">Imágenes</a></td>
          <td><a href="project-edit.php?id=<?=$project->getId()?>">Editar</a></td>
          <td><a href="project-delete.php?id=<?=$project->getId()?>">Eliminar</a></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
<?php include 'footer.php'; ?>
