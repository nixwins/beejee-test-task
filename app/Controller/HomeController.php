<?php

namespace App\Controller;

use App\Model\TasksModel as Task;

class HomeController extends Controller {

    public function index() {


        $taskModel = new Task();

        $taskCount = $taskModel->getCount()[0]["count"];
 
        $tasks = $taskModel->getWithOffset(3, 0);

        $this->render->view('task.index', ['data' => ["tasks" => $tasks, "count" => $taskCount]]);
    }

    public function page() {

        $page = isset($this->params["page"]) ? $this->params["page"] : 1;
        $limit = 3;

        $offset = $limit * ($page - 1);

        $taskModel = new Task();

        $taskCount = $taskModel->getCount()[0]["count"];

        $sortedBy = '';
        $orderBy = '';
        
        if(isset($_SESSION['sort']) && isset($_SESSION['order'])){
            $sortedBy = $_SESSION['sort'];
            $orderBy = $_SESSION['order'];
        }
        
        $tasks = [];
        if($sortedBy !== '' && $orderBy !== ''){
             $tasks = $taskModel->getWithOffset($limit, $offset, $sortedBy, $orderBy);
        }else{
            $tasks = $taskModel->getWithOffset($limit, $offset);
        }
        
//            if($_SESSION["isLogin"] == true && $_SERVER['REQUEST_URI'] !== '/'){
//                  $this->render->view('profile.admin', ['data' => ["tasks" => $tasks, "count" => $taskCount]]);
//            }else{
                  $this->render->view('task.index', ['data' => ["tasks" => $tasks, "count" => $taskCount]]);
//            }
          
    }

   
}
