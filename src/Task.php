<?php
  class Task
  {
      private $description;

      function __construct($description)
      {
        $this->description = $description;
      }

      function setDescription($new_description)
      {
        $this->description = (string) $new_description;
      }

      function getDescription()
      {
        return $this->description;
      }

      function save()
      {
        array_push ($_SESSION['listTask'], $this);
      }

      static function getAll()
      {
        return $_SESSION['listTask'];
      }

      static function deleteAll()
      {
        $_SESSION['listTask'] = array();
      }
  }
 ?>
