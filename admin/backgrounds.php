<?php
require 'inc/includes.php';

// Controller
require '../models/Background.class.php';
$backgrounds = Background::getAll();

$current_nav = 'backgrounds';
include 'header.php';
?>
    <h1>Backgrounds</h1>
    <ul class="nav nav-pills">
      <li>
        <a href="background-add.php">Agregar fondo</a>
      </li>
    </ul>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Fondo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($backgrounds as $background): ?>
        <tr>
          <td><img src="/content/backgrounds/<?=$background->getName()?>" style="width: 200px;" /></td>
          <td><a href="background-delete.php?id=<?=$background->getId()?>">Eliminar</a></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
<?php include 'footer.php'; ?>
