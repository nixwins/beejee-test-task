<?php

namespace App\Controller;
    
use App\Controller\Controller;
use App\Helper\Auth;
use App\Model\UsersModel;
use Core\Response;
use App\Model\TasksModel as Task;
use App\Config\App;

class UserController extends Controller{
    
    public function login(){
        
        $login = isset($this->params["login"]) ? $this->params["login"] : null;
        $pass = isset($this->params["login"]) ? $this->params["password"] : null;
        $_SESSION["isLogin"] = false;

        $response = new Response();
        
        if($login !== null && $pass !== null){
            
            $userModel = new UsersModel();
            $userFromDB = $userModel->getUserByLogin($login);
            
            if($userFromDB != -1){
                
                if (Auth::verify($pass, $userFromDB["password"])) {
                    
                    $_SESSION["isLogin"] = true;
                    $_SESSION["login"] = $userFromDB["login"];
                    $_SESSION["user_id"] = $userFromDB["id"];
                   // header("Location: /user/");
                   
                     $response->json(["isLogin" => true, "message" => "Авторизация прошла успешно."]);
                }
                else{
                    $response->json(["isLogin" => false, "message"=>"Имя пользователя или пароль неправильно."]);
                }
            } else {
                $response->json(["isLogin" => false, "message" => "Имя пользователя или пароль неправильно."]);
            }
        }
    }
    
    public function showProfile(){
               
        if ($_SESSION['isLogin'] == true){
            
            $taskModel = new Task();

            $taskCount = $taskModel->getCount()[0]["count"];

            //$tasks = $taskModel->getWithOffset(3, 0);
            $tasks = $taskModel->getAll();
            $userModel = new UsersModel();
            $userFromDB = $userModel->getUserByLogin($_SESSION["login"]);
            $user["login"] = $userFromDB["login"];
            $user["name"] = $userFromDB["name"];

            $this->render->view("profile.admin", ["data" => ["user"=>$user, "tasks" => $tasks, "count" => $taskCount]]);
            
        }else{
               $this->render->view("login", ["data" => ""]);
        }
    }
    
    public function adminPage(){
        
         if ($_SESSION["isLogin"] == true) {
             
            $page = isset($this->params["page"]) ? $this->params["page"] : 1;
            $limit = 3;

            $offset = $limit * ($page - 1);

            $taskModel = new Task();

            $taskCount = $taskModel->getCount()[0]["count"];

            $sortedBy = '';
            $orderBy = '';

            if (isset($_SESSION['sort']) && isset($_SESSION['order'])) {
                $sortedBy = $_SESSION['sort'];
                $orderBy = $_SESSION['order'];
            }

            $tasks = $taskModel->getWithOffset($limit, $offset);
           
                  $this->render->view('profile.admin', ['data' => ["tasks" => $tasks, "count" => $taskCount]]);
            }
    }
    
    public function logout(){
        //unset($_SESSION['isLogin'])
       //$url = App::siteURL();
        $_SESSION['isLogin'] = false;
        header("Location:". App::siteURL(), true, 301);
        exit();
    }
   
}