<?php
  //set up modules
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Task.php";


  //Instantiate session
  session_start();

  if (empty($_SESSION['listTask'])) {
    $_SESSION['listTask'] = array();
  };

  //Initialize app and template
  $app = new Silex\Application();
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));

  //Get tasks route
  $app->get("/", function() use ($app){
    return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
  });

  //Post save task
  $app->post("/tasks", function() use ($app){
    $task = new Task($_POST['description']);
    $task->save();
    return $app['twig']->render('create_task.html.twig', array('newtask' => $task));
  });

  //Post delete
  $app->post("/delete_tasks",function () use($app){
    Task::deleteAll();
    return $app['twig']->render('delete_tasks.html.twig');
});

  return $app;
?>
