<?php

class Project
{
  private $id;
  private $name;
  private $description;
  private $date;

  private $thumb;

  /* Setters */
  public function setId($id) { $this->id = $id; }
  public function setName($name) { $this->name = $name; }
  public function setDescription($description) { $this->description = $description; }
  public function setDate($date) { $this->date = date(MYSQL_DATETIME, strtotime($date)); }

  /* Getters */
  public function getId() { return $this->id; }
  public function getName() { return $this->name; }
  public function getDescription() { return $this->description; }
  public function getDate($format = MYSQL_DATETIME) { return date($format, strtotime($this->date)); }

  public function getThumb() { return $this->thumb; }

  /* CRUD Methods */
  public function save()
  {
    global $db;

    $sth = $db->prepare("INSERT INTO sm_projects
                          (name, description, date) VALUES (:name, :description, :date)");
    $sth->bindParam(':name', $this->name);
    $sth->bindParam(':description', $this->description);
    $sth->bindParam(':date', $this->date);

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

    $sth = $db->prepare("UPDATE sm_projects
                          SET name = :name, description = :description, date = :date
                          WHERE id = :id
                          LIMIT 1");
    $sth->bindParam(':name', $this->name);
    $sth->bindParam(':description', $this->description);
    $sth->bindParam(':date', $this->date);
    $sth->bindParam(':id', $this->id);

    if ($sth->execute())
      return true;
    else
      return false;
  }

  public function delete()
  {
    global $db;

    $sth = $db->prepare("DELETE FROM sm_projects
                          WHERE id = :id
                          LIMIT 1");
    $sth->bindParam(':id', $this->id);

    if ($sth->execute())
      return true;
    else
      return false;
  }

  /* Public methods */
  public function getImages()
  {
    global $db;

    $sth = $db->prepare("SELECT name
                          FROM sm_images
                          WHERE project_id = :project_id
                          ORDER BY priority DESC, id");
    $sth->bindParam(':project_id', $this->id, PDO::PARAM_INT);
    $sth->execute();

    $sth->setFetchMode(PDO::FETCH_COLUMN, 0);

    return $sth->fetchAll();
  }

  /* Static methods */
  static function get($id)
  {
    if (is_int($id))
    {
      global $db;

      $sth = $db->prepare("SELECT p.id, p.name, p.description, p.date
                            FROM sm_projects p
                            WHERE p.id = :id
                            LIMIT 1");
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();
  
      $sth->setFetchMode(PDO::FETCH_CLASS, 'Project');
  
      return $sth->fetch();
    }
    
  }

  static function getAllByDate()
  {
    global $db;

    $sth = $db->prepare("SELECT p.id, p.name, p.description, p.date, i.id as image_id, i.name as thumb
                          FROM sm_projects p
                          LEFT JOIN sm_images i
                          ON i.project_id = p.id AND i.priority = (SELECT MAX(priority) FROM sm_images WHERE project_id = p.id)
                          GROUP BY p.id
                          ORDER BY date");
    $sth->execute();

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Project');

    return $sth->fetchAll();
  }

  static function getAllByName()
  {
    global $db;

    $sth = $db->prepare("SELECT p.id, p.name, p.description, p.date, i.id as image_id, i.name as thumb
                          FROM sm_projects p
                          LEFT JOIN sm_images i
                          ON i.project_id = p.id AND i.priority = (SELECT MAX(priority) FROM sm_images WHERE project_id = p.id)
                          GROUP BY p.id
                          ORDER BY name");
    $sth->execute();

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Project');

    return $sth->fetchAll();
  }
}

?>
