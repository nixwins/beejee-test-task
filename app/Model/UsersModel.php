<?php

namespace App\Model;

use \RedBeanPHP\R as R;

class UsersModel extends Model {

    public function getUserByLogin($login)
    {
        $user = R::getAll('SELECT * FROM ' . $this->tableName . '  WHERE login = ? ', [$login]);

        if(count($user) == 1)
        {
              return $user[0];
        }
       
        return -1;
     
    }
  

}
