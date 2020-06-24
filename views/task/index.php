<?php

//print_r($arr);

use Core\Asset;

//
$tasks = $data["tasks"];
$count = $data["count"];
//print_r($data["count"]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Список задач</title>
        <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" type="">
        <link  rel="stylesheet"  href="<?php echo Asset::includeCss("main.css") ?>" type="">
    </head>
    <body>
        <div class="container">
            <div class="row">
             
                <div class="topbar col col-lg-12">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginModal">Вход</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createTaskModal">Добавить </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    
                    <form id="sortForm" action="/tasks/filter" method="GET" >
                         <div class="form-group">
                             <label for="sortBySelect">Сортировка</label>
                             <select class="form-control" id="sortBySelect" name="sort">
                                 
                                 <?php if($_SESSION["sort"] === 'username'){ ?>
                                                    <option  value="username" selected>Имя пользователя</option>
                                                    <option value="email" >Email</option>
                                                    <option value="status" >Статус</option>
                                <?php }elseif($_SESSION["sort"] === 'email'){ ?>
                                                    <option  value="username" >Имя пользователя</option>
                                                   <option value="email" selected>Email</option>
                                                   <option value="status" >Статус</option>
                                <?php }elseif ($_SESSION["sort"] === 'status') { ?> 
                                                    <option  value="username" >Имя пользователя</option>
                                                    <option value="email" >Email</option>
                                                    <option value="status" selected>Статус</option>
                                <?php  }else{ ?>
                                                    <option  value="username" selected>Имя пользователя</option>
                                                        <option value="email" >Email</option>
                                                        <option value="status" >Статус</option>
                                <?php } ?>
                                                    
                               </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="orderBySelect">Порядок</label>
                            <select class="form-control" id="orderBySelect" name="order">
                                
                                <?php if ($_SESSION["order"] == 'desc') { ?>
                                                <option value="desc" selected>в порядке убывания </option>
                                                <option value="asc">в порядке возрастания </option>
                                 <?php } elseif ($_SESSION["order"] == 'asc') { ?>
                                                <option value="desc" >в порядке убывания </option>
                                                <option value="asc" selected>в порядке возрастания </option>
                                <?php }else {?>
                                                <option value="desc" selected>в порядке убывания </option>
                                                <option value="asc" >в порядке возрастания </option>
                                <?php }?>
                                         
                             </select>
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" id="sortFormAcceptBtn">Применить</button>
                        </div>

                       
                    </form>
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

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): ?>
                                <tr>
                                    <td> <?php echo $task["username"]; ?></td>
                                    <td><?php echo $task["email"]; ?></td>
                                    <td><?php echo $task["text"] ?></td>
                                    <td>
                                        <?php if($task["status"] == "done"){ ?>
                                                         <span>Выполнено</span>
                                        <?php }else{  ?>
                                                             <span>Выполняется</span>
                                        <?php } ?>
                                        <p><?php if($task["modified_by"] != 0) { echo "Отредактирована " . $task["login"]; } ?></p>
                                    </td>

                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($i = 0; $i < $count / 3; $i++): ?>
                                <li class="page-item"><a class="page-link" href="/page/<?php echo $i + 1; ?>"><?php echo $i + 1; ?> </a></li>
                            <?php endfor; ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Create task modal -->

        <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog"  data-keyboard="false" data-backdrop="static" aria-labelledby="createTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTaskModalLabel">Создать задачу</h5>
                        <button type="button" id="createTaskModalCloseIc" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="taskForm" action="/task/create" method="POST">
                            <div class="form-group">
                                <label for="user-name" class="col-form-label">Имя:</label>
                                <input type="text" name="username" class="form-control" id="user-name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="task-text" class="col-form-label">Описание:</label>
                                <textarea class="form-control"  name="tasktext" id="task-tex"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="createTaskModalCloseBtn" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary" id="sendTask">Добавить</button>

                            </div>

                        </form>
                        <p id="status-msg">..</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- END create task modal -->

        <!-- User login modal  -->

        <div class="modal fade" id="loginModal" tabindex="-2" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Авторизация</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm" method="POST" action="/user/login">
                            <div class="form-group">
                                <label for="login">Логин</label>
                                <input type="text" required  name="login" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Введите логин">

                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" required name="password" class="form-control" id="password" placeholder="Пароль">
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Войти</button>
                            </div>

                        </form>
                        <p id="login-status-msg">..</p>
                    </div>
        
                </div>
            </div>
        </div>

        <!-- END  User login modal -->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="<?php echo Asset::includeJS("main.js"); ?>"></script>
    </body>
</html>