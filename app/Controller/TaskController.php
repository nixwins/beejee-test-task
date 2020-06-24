<?php

namespace App\Controller;

use App\Model\TasksModel as Task;
use Core\Validator as V;
use Core\Response;

class TaskController extends Controller {

    public function create() {


        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $taskText = isset($_POST['tasktext']) ? $_POST['tasktext'] : '';
        $taskStatus = "progress";

        $response = new Response();

        $valid = V::validateAll($email, $username, $taskText);


        if (V::isEmail($email) && V::validUsername($username) && V::validUsername($taskText)) {

            $taskModel = new Task();
            $taskID = $taskModel->save($username, $email, $taskText);

            if (!empty($taskID)) {
                $task = ["email" => $email, "username" => $username, "tasktext" => $taskText, "status" => $taskStatus];

                $this->render->view('task.create', ['data' => ["save" => true, "task_id" => $taskID, "task" => $task]]);
            }
        } else {

            $response->json($valid);
        }
    }
    
    public function filter(){
        
        $sortBy = isset($_GET["sort"]) ? $_GET["sort"] : "";
        $orderBy = isset($_GET["order"]) ? $_GET["order"] : "";

        if(!empty($sortBy) && !empty($orderBy))
        {
            $_SESSION["sort"] = $sortBy;
            $_SESSION["order"] = $orderBy;
        }
        
        
         $taskModel = new Task();

        $taskCount = $taskModel->getCount()[0]["count"];

        $tasks = $taskModel->getWithOffset(3, 0,  $_SESSION["sort"],  $_SESSION["order"]);
        
             $this->render->view('task.index', ['data' => ["tasks" => $tasks, "count" => $taskCount]]);
    }
    
    public function updateStatus(){
        
        $id = $this->params["id"];
        $status = $this->params["status"];
        
        $taskModel = new Task();
         $count = $taskModel->updateStatus($id, $status);
         
         $response = new Response();
         
        if(!empty($count) && $count > 0){
             $response->json(["updated"=>true, "count"=>$count]);
         }else{
             $response->json(["updated" => true, "count" => $count]);
        }
    }
    
     public function showTaskEditForm() {

        if ($_SESSION['isLogin'] == true) {

            $id = $this->params["id"];
            $update = $this->params["update"];

            $taskModel = new Task();
            $task = $taskModel->getTask($id);
            
            $this->render->view("task.update", ["data" => ["task"=>$task]]);
        } else {
            $this->render->view("login", ["data" => ""]);
        }
     }
        public function editTask(){
        
        if($_SESSION['isLogin'] == true){

              $taskModel = new Task();
              $update = $this->params["update"];
            if ($update == true) {
                
                $id = $this->params["id"];
                $username = $this->params["username"];
                $email = $this->params["email"];
                $text = $this->params["taskText"];
                $status = $this->params["status"];
                $userID = $_SESSION["user_id"];
                //echo $userID;
                $updated = $taskModel->update($id, $username, $email, $text, $status, $userID);
            }     

            $task = $taskModel->getTask($id);
            $this->render->view("task.update", ["data" => ["task" => $task, "updated"=>true]]);
            
        } else {
            $this->render->view("login", ["data" => ""]);
        }
    }
}
