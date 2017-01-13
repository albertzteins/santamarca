<?php

class ProjectImage
{
  private $id;
  private $project_id;
  private $name;
  private $priority;

  /* Setters */
  public function setId($id) { $this->id = $id; }
  public function setProjectId($project_id) { $this->project_id = $project_id; }
  public function setName($name) { $this->name = $name; }
  public function setPriority($priority) { $this->priority = $priority; }

  /* Getters */
  public function getId() { return $this->id; }
  public function getProjectId() { return $this->project_id; }
  public function getName() { return $this->name; }
  public function getPriority() { return $this->priority; }

  /* CRUD Methods */
  public function save()
  {
    global $db;

    $sth = $db->prepare("INSERT INTO sm_images
                          (project_id, name) VALUES (:project_id, :name)");
    $sth->bindParam(':project_id', $this->project_id);
    $sth->bindParam(':name', $this->name);

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

    $sth = $db->prepare("UPDATE sm_images
                          SET project_id = :project_id, name = :name, priority = :priority
                          WHERE id = :id
                          LIMIT 1");
    $sth->bindParam(':project_id', $this->project_id);
    $sth->bindParam(':name', $this->name);
    $sth->bindParam(':priority', $this->priority);
    $sth->bindParam(':id', $this->id);

    if ($sth->execute())
      return true;
    else
      return false;
  }

  public function delete()
  {
    global $db;

    $sth = $db->prepare("DELETE FROM sm_images
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
  
      $sth = $db->prepare("SELECT id, project_id, name, priority
                            FROM sm_images
                            WHERE id = :id
                            LIMIT 1");
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();
  
      $sth->setFetchMode(PDO::FETCH_CLASS, 'ProjectImage');
  
      return $sth->fetch();
    }
    else
      throw new Exception('Not integer', 1);
      
  }
  static function getAllForProjectId($project_id)
  {
    global $db;

    $sth = $db->prepare("SELECT id, project_id, name, priority
                          FROM sm_images
                          WHERE project_id = :project_id
                          ORDER BY priority DESC, id");
    $sth->bindParam(':project_id', $project_id, PDO::PARAM_INT);
    $sth->execute();

    $sth->setFetchMode(PDO::FETCH_CLASS, 'ProjectImage');

    return $sth->fetchAll();
  }
}

?>
