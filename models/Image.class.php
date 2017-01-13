<?php

/* ==========================================================================
   Image class 1.0

   Allows image size manipulation (resize & crop)

   jaimeeee.com
   ========================================================================== */

class Image
{
  private $image;
  private $name;
  
  /* Methods */
  function __construct($source_path, $file_name)
  {
    $file_data = getimagesize($source_path);
    $file_type = $file_data['mime'];
    
    switch($file_type)
    {
      case 'image/jpg':
        $source = imagecreatefromjpeg($source_path);
        break;
      
      case 'image/jpeg':
        $source = imagecreatefromjpeg($source_path);
        break;
      
      case 'image/gif':
        $source = imagecreatefromgif($source_path);
        break;
      
      case 'image/png':
        $source = imagecreatefrompng($source_path);
        break;
      
      default:
        return false;
    }
    
    $this->image = imagecreatetruecolor(imagesx($source), imagesy($source));
    imagecopyresampled($this->image, $source, 0, 0, 0, 0, imagesx($source), imagesy($source), imagesx($source), imagesy($source));
    
    $this->name = $file_name;
  }
  
  function getWidth()
  {
    return imagesx($this->image);
  }
  function getHeight()
  {
    return imagesy($this->image);
  }
  
  function resize($width, $height)
  {
    $new_image = imagecreatetruecolor($width, $height);
    imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
    $this->image = $new_image;
  } 
  function resizeToHeight($height)
  {
    $ratio = $height / $this->getHeight();
    $width = $this->getWidth() * $ratio;
    $this->resize($width, $height);
  }
  function resizeToWidth($width, $max_width = false)
  {
    if (!$max_width || ($max_width && $this->getWidth() > $width))
    {
      $ratio = $width / $this->getWidth();
      $height = $this->getHeight() * $ratio;
      $this->resize($width, $height);
    }
  }
  function resizeToMax($max_width, $max_height, $crop = false)
  {
    if ($crop)
    {
      $ratio = $max_width / $this->getWidth();
      $height = $this->getHeight() * $ratio;
      
      if ($height > $max_height)
        $this->resizeToWidth($max_width);
      else
        $this->resizeToHeight($max_height);
      
      $this->crop($max_width, $max_height);
    }
    else
    {
      if ($this->getWidth() > $this->getHeight())
        $this->resizeToWidth($max_width);
      else
        $this->resizeToHeight($max_height);
    }
  }
  function resizeToFixedWidth($width, $max_height = 0, $min_height = 0)
  {
    $ratio = $width / $this->getWidth();
    $height = $this->getHeight() * $ratio;
    
    if ($min_height && $height < $min_height)
      $this->resizeToHeight($min_height);
    elseif ($this->getWidth() != $width)
      $this->resizeToWidth($width);
    
    if ($max_height && $this->getHeight() > $max_height)
      $this->crop($width, $max_height);
    elseif ($this->getWidth() > $width)
      $this->crop($width, $this->getHeight());
  }
  
  function crop($width, $height)
  {
    $crop_x = ($this->getWidth() - $width) / 2;
    $crop_y = ($this->getHeight() - $height) / 2;
    $new_image = imagecreatetruecolor($width, $height);
    imagecopyresampled($new_image, $this->image, 0, 0, $crop_x, $crop_y, $this->getWidth(), $this->getHeight(), $this->getWidth(), $this->getHeight());
    $this->image = $new_image;
  }

  function addWatermark($watermark_file)
  {
    $new_image = $this->image;
    $watermark = imagecreatefrompng($watermark_file);
    // This is the key. Without ImageAlphaBlending on, the PNG won't render correctly.
    imagealphablending($new_image, true);
    // Copy the watermark onto the master, $offset px from the bottom right corner.
    imagecopy($new_image, $watermark, $this->getWidth() - imagesx($watermark), $this->getHeight() - imagesy($watermark), 0, 0, imagesx($watermark), imagesy($watermark));
    $this->image = $new_image;
  }
  
  function save($compression = 85)
  {
    imagejpeg($this->image, $this->name, $compression);
  }
  
}

?>
