<?php
error_reporting(E_ALL | E_STRICT);
require 'inc/includes.php';

// Controller
require '../models/Background.class.php';

if (!empty($_FILES))
{
  $background = new Background();

  if ($background->save())
  {

    # require '../models/Image.class.php';
  
    // Temp file info
    $temp_file = $_FILES['image']['tmp_name'];
  
    // Validate the file type
    $file_types = array('jpg','jpeg', 'png', 'gif'); // File extensions
    $file_parts = pathinfo($_FILES['image']['name']);
  
    // Name of the original image
    $target_file = CONTENT_PATH . 'backgrounds/' . $background->getId() . '.jpg';
  
    if (in_array(strtolower($file_parts['extension']), $file_types))
    {
  
      move_uploaded_file($temp_file, $target_file);

      list($bgWidth, $bgHeight) = getimagesize($target_file);
  
      $background->setName($background->getId() . '.jpg');
      $background->setHeight($bgHeight);
      $background->setWidth($bgWidth);
      $background->update();
  
    }

    redirect('backgrounds.php');
  }
}

$current_nav = 'backgrounds';
include 'header.php';
?>
    <h1>Agregar fondo</h1>
    <form action="/admin/background-add.php" method="post" enctype="multipart/form-data">
      <fieldset>
        <label for="image">Imagen</label>
        <input type="file" name="image" id="image" />
        <br /><br />
        <div class="control-group">
          <button type="submit" class="btn btn-primary">Agregar fondo</button>
        </div>
      </fieldset>
    </form>
<?php include 'footer.php'; ?>
