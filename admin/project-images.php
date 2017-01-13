<?php
error_reporting(E_ALL | E_STRICT);
require 'inc/includes.php';

if (isset($_GET['id']) && ctype_digit($_GET['id'])):

  // Controller
  require '../models/Project.class.php';

  $project = Project::get((int)$_GET['id']);

  if (!$project) redirect('projects.php');
  
  require '../models/ProjectImage.class.php';

  // If there is any file, add it
  if (!empty($_FILES))
  {
    $projectImage = new projectImage();

    $projectImage->setProjectId($project->getId());
    $projectImage->setName($project->getId() . '_' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT) . '_' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT));
  
    if ($projectImage->save())
    {
  
      require '../models/Image.class.php';
    
      // Temp file info
      $temp_file = $_FILES['image']['tmp_name'];
    
      // Validate the file type
      $file_types = array('jpg','jpeg', 'png', 'gif'); // File extensions
      $file_parts = pathinfo($_FILES['image']['name']);
    
      // Name of the original image
      $target_file = CONTENT_PATH . 'projects/' . $projectImage->getName() . '_o.jpg';
    
      if (in_array(strtolower($file_parts['extension']), $file_types))
      {
        // Keep the original image
        move_uploaded_file($temp_file, $target_file);

        // Full image
        $image = new Image($target_file, CONTENT_PATH . 'projects/' . $projectImage->getName() . '.jpg');
        $image->resizeToMax(600, 480, true);
        $image->save();

        // Create thumb image
        $image = new Image($target_file, CONTENT_PATH . 'projects/' . $projectImage->getName() . '_t.jpg');
        $image->resizeToMax(274, 182, true);
        $image->save();
    
      }

    }
    else
      $imageError = true;
  } elseif (getFormValue('priority') !== false && getFormValue('image')) {

    $imageEdit = ProjectImage::get((int)getFormValue('image'));

    if ($imageEdit)
    {
      $imageEdit->setPriority(getFormValue('priority'));
      $imageEdit->update();
    }

  }

  // If there is any image to delete
  if (isset($_GET['delete']) && ctype_digit($_GET['delete']))
  {
    $imageDelete = ProjectImage::get((int)$_GET['delete']);

    if ($imageDelete)
    {
      if ($imageDelete->delete())
      {
        unlink(CONTENT_PATH . 'projects/' . $imageDelete->getName() . '_o.jpg');
        unlink(CONTENT_PATH . 'projects/' . $imageDelete->getName() . '_t.jpg');
        unlink(CONTENT_PATH . 'projects/' . $imageDelete->getName() . '.jpg');
      }
    }
  }

  $images = ProjectImage::getAllForProjectId((int)$project->getId());
  
  $current_nav = 'projects';
  include 'header.php';
?>
    <h1><?=$project->getName()?>: imágenes</h1>
    <form action="/admin/project-images.php?id=<?=$project->getId()?>" method="post" enctype="multipart/form-data">
      <fieldset>
        <label for="image">Imagen</label>
        <input type="file" name="image" id="image" />
        <br /><br />
        <div class="control-group">
          <button type="submit" class="btn btn-primary">Agregar imagen al caso</button>
        </div>
      </fieldset>
    </form>
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($images as $image): ?>
        <tr>
          <td><img src="/content/projects/<?=$image->getName()?>_t.jpg" style="width:200px;" /></td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="image" value="<?=$image->getId()?>" />
              <input type="text" class="text input-mini" name="priority" value="<?=$image->getPriority()?>" />
            </form>
          </td>
          <td><a href="/admin/project-images.php?id=<?=$project->getId()?>&amp;delete=<?=$image->getId()?>">eliminar</a></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
<?php include 'footer.php'; ?>
<?php else: redirect('projects.php'); ?>
<?php endif; ?>
