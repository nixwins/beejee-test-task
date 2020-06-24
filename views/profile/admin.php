<?php 

//print_r($user);
?>
<?php

//print_r($arr);

use Core\Asset;

//
$user = isset($data["user"]) ? $data["user"] : ["login"=>$_SESSION["login"]];
$tasks = $data["tasks"];
$count = $data["count"];
//print_r($data["count"]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Админка</title>
        <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" type="">
        <link  rel="stylesheet"  href="<?php echo Asset::includeCss("main.css") ?>" type="">
    </head>
    <body>
        <div class="container">
            <div class="row">
               
                <div class="topbar col col-lg-12">
                    <form action="/user/logout" method="GET">
                        <button type="submit" class="btn btn-info">Выход</button>
                    </form>
                    
                  
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">

                <?php echo $user["login"]; ?>
                </div>
                <div class="col-sm-10">

                    <table id="task-list" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">имя пользователя
                                </th>
                                <th class="th-sm">email
                                </th>
                                <th class="th-sm">текст задачи
                                </th>
                                <th class="th-sm">статус
                                </th>
                                <th class="th-sm">действие
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): ?>
                                <tr>
                                    <td> <?php echo $task["username"]; ?></td>
                                    <td><?php echo $task["email"]; ?></td>
                                    <td><?php echo $task["text"]; ?></td>
                                    <td class="status-td">
                                        
                                        <?php if($task["status"] === "done"){ ?>
                                               
                                                        <p><?php echo "Выполнено"; ?> </p>
                                                        <form name="statusForm" action="/task/update/status" method="POST">
                                                                <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
                                                                <input type="hidden" name="status" value="progress">
                                                                <button type="submit"  class="btn btn-primary statusChangeBtn">Изменить </button>
                                                        </form>
                                                                    
                                        <?php } else{ ?>
                                                        <p><?php echo "Выполняется"; ?> </p>
                                                        <form name="statusForm" action="/task/update/status" method="POST">
                                                            <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
                                                            <input type="hidden" name="status" value="done">
                                                            <button type="submit"  class="btn btn-primary statusChangeBtn">Изменить </button>
                                                        </form>
                                        <?php } ?>
                                                          
                                    </td>
                                    <td> <a  class="btn btn-info" href="/task/edit/show/<?php echo $task["id"]; ?>">Редактировать</a> </td>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
            
                </div>
            </div>
        </div>

    

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="<?php echo Asset::includeJS("main.js"); ?>"></script>
    </body>
</html>