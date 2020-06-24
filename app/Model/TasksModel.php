<?php

namespace App\Model;

use \RedBeanPHP\R as R;

class TasksModel extends Model {

    public function getAll($limit = 100){
        
        $tasks = R::getAll('SELECT users.login, users.name, tasks.*'
                        . ' FROM tasks '
                        . 'LEFT JOIN users '
                        . 'ON tasks.modified_by = users.id '
                        . 'ORDER BY id DESC LIMIT ? ', [$limit]);
        return $tasks;
    }
    public function getWithOffset($limit, $offset, $sortBy="username", $orderBy="DESC") {

        $tasks = R::getAll('SELECT users.login, users.name, tasks.*'
                .' FROM tasks '
                . 'LEFT JOIN users '
                . 'ON tasks.modified_by = users.id '
                . 'ORDER BY ' . $sortBy .'  ' . $orderBy
                . ' LIMIT ? OFFSET ?', [$limit, $offset]);
        return $tasks;
    }

    public function save($username, $email, $taskText) {

        $task = R::dispense('tasks');

        $task->username = $username;
        $task->email = $email;
        $task->text = $taskText;

        $id = R::store($task);
        return $id;
    }
    
    public function update($id, $username, $email, $text, $status, $userID = 0) {

        $task = R::load('tasks', $id);

        $task->username = $username;
        $task->email = $email;
        $task->text = $text;
        $task->status = $status;
        
        if($userID != 0 ){
            $task->modified_by = $userID;
        }
        return  R::store($task);
    }

    public function updateStatus($id, $status) {

        $sql = "UPDATE tasks SET status=:status WHERE id=:id";
        return R::exec($sql, [":status"=>$status, ":id"=>$id]);
    }

    public function getCount() {
        $tasks = R::getAll('SELECT COUNT(*) as count FROM ' . $this->tableName);
        return $tasks;
    }
    
    public function getTask($id){
        return R::getAssocRow("SELECT * FROM tasks WHERE id=:id", [":id"=>$id])[0];
    }

}
