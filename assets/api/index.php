<?php
require 'vendor/autoload.php';
require '..actions/Connection.php';
require 'tasks/TaskService.php';

$app = new \Slim\Slim();


$app->get('/pets/', function() use ( $app ) {
    $tasks = TaskService::listTasks();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($tasks);
});

$app->post('/pets/', function() use ( $app ) {
    $taskJson = $app->request()->getBody();
    $newTask = json_decode($taskJson, true);
    if($newTask) {
        $task = TaskService::add($newTask);
        echo "Task added";
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

$app->put('/pets/', function() use ( $app ) {
    $taskJson = $app->request()->getBody();
    $updatedTask = json_decode($taskJson, true);
    
    if($updatedTask && $updatedTask['id']) {
        if(TaskService::update($updatedTask)) {
          echo "Task updated";  
        }
        else {
          $app->response->setStatus('404');
          echo "Task not found";
        }
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

$app->delete('/pets/:id', function($id) use ( $app ) {
    if(TaskService::delete($id)) {
      echo "Task with id = $id was deleted";
    }
    else {
      $app->response->setStatus('404');
      echo "Task not found";
    }
});

$app->run();
?>
