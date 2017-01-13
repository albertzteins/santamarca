<?php

class Background
{
  private $id;
  private $name;
  private $width;
  private $height;

  /* Setters */
  public function setId($id) { $this->id = $id; }
  public function setName($name) { $this->name = $name; }
  public function setWidth($width) { $this->width = $width; }
  public function setHeight($height) { $this->height = $height; }

  /* Getters */
  public function getId() { return $this->id; }
  public function getName() { return $this->name; }
  public function getWidth() { return $this->width; }
  public function getHeight() { return $this->height; }

  /* CRUD methods */
  public function save()
  {
    global $db;

    $sth = $db->prepare("INSERT INTO sm_backgrounds
                          (name, width, height) VALUES (:name, :width, :height)");
    $sth->bindParam(':name', $this->name);
    $sth->bindParam(':width', $this->width);
    $sth->bindParam(':height', $this->height);

    if ($sth->execute())
    {
      $this->setId($db->lastInsertId());
      return true;
    }
    else
      return false;
  }

  public function update()
  {
    global $db;

    $sth = $db->prepare("UPDATE sm_backgrounds
                          SET name = :name, width = :width, height = :height
                          WHERE id = :id
                          LIMIT 1");
    $sth->bindParam(':name', $this->name);
    $sth->bindParam(':width', $this->width);
    $sth->bindParam(':height', $this->height);
    $sth->bindParam(':id', $this->id);

    if ($sth->execute())
      return true;
    else
      return false;
  }

  public function delete()
  {
    global $db;

    $sth = $db->prepare("DELETE FROM sm_backgrounds
                          WHERE id = :id
                          LIMIT 1");
    $sth->bindParam(':id', $this->id);

    if ($sth->execute())
      return true;
    else
      return false;
  }

  /* Static methods */
  static function get($id)
  {
    if (is_int($id))
    {
      global $db;
  
      $sth = $db->prepare("SELECT id, name, width, height
                            FROM sm_backgrounds
                            WHERE id = :id
                            LIMIT 1");
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();
  
      $sth->setFetchMode(PDO::FETCH_CLASS, 'Background');
  
      return $sth->fetch();
    }
  }

  static function getAll()
  {
    global $db;

    $sth = $db->prepare("SELECT id, name, width, height
                          FROM sm_backgrounds");
    $sth->execute();

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Background');

    return $sth->fetchAll();
  }

  static function getRandom()
  {
    global $db;

    $sth = $db->prepare("SELECT id, name, width, height
                          FROM sm_backgrounds
                          ORDER BY RAND()
                          LIMIT 1");
    $sth->execute();

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Background');

    return $sth->fetch();
  }
}

?>
