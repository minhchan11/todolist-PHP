<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Task.php";



  session_start();

  if (empty($_SESSION['listTask'])) {
    $_SESSION['listTask'] = array();
  };

  $app = new Silex\Application();

  $app->get("/", function(){

    $output = "";
    $list_tasks = Task::getAll();
    if(!empty($list_tasks))
    {
      $output = $output . "
      <h1>To Do List</h1>
      <p>
        All your tasks
      </p>
      ";
      foreach ($list_tasks as $task) {
        $output = $output . "<p>" . $task->getDescription() . "</p>";
      }
    }

    $output = $output . "
    <form action='/tasks' method='post'>
      <label for='description'>Task Description<label>
      <input type='text' name='description' id='description'>

      <button type='submit' name='button'>Submit</button>
    </form>
    ";

    $output = $output . "
    <form action='/delete_tasks' method='post'>
      <button type='submit' name='button'>Delete</button>
    </form>
    ";

    return $output;
  });

  $app->post("/tasks", function(){
    $task = new Task($_POST['description']);
    $task->save();
    return "
    <h1>You created a task</h1>
    <p>" . $task->getDescription() .
    "</p>
    <p>
      <a href='/'>List of tasks to do</a>
    </p>
    ";
  });

  $app->post("/delete_tasks",function (){
    Task::deleteAll;

    return "
      <h1>List Cleared!</h1>
      <p><a href='/'>Home</a></p>
  ";
});

  return $app;
?>
