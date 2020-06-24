<?php

use Core\Asset;
$task = $data["task"];
$updated = isset($data["updated"]) ? $data["updated"] : false;
//print_r($task);
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
        <div class="topbar col col-lg-12">
            <form action="/user/logout" method="GET">
                <button type="submit" class="btn btn-info">Выход</button>
            </form>


        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form method="POST" action="/task/edit">
                        <input type="hidden" class="form-control" id="task_id" name="id" value="<?php echo $task["id"]; ?>">
                        <input type="hidden" class="form-control" id="update" name="update" value="true">
                        <div class="form-group">
                            <label for="username">Имя ползователя</label>
                            <input type="text" class="form-control"  name="username" id="username" value="<?php echo $task["username"]; ?>">

                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?php echo $task["email"]; ?>">

                        </div>
                        
                        <div class="form-group">
                            <label for="taskText">Текст задачи</label>
                            <textarea class="form-control" name="taskText" id="taskText" rows="3"><?php echo $task["text"]; ?></textarea>
                        </div>
                        <?php if($task["status"] === "done"){ ?>
                        <div class="form-group form-check">
                            <input type="radio" name="status" value="done" checked=""  value="done" class="form-check-input" id="statusDone">
                            <label class="form-check-label" for="statusDone">Выполнено</label>
                        </div>

                        <div class="form-group form-check">
                            <input type="radio" name="status" value="progress" class="form-check-input" id="statusUndone">
                            <label class="form-check-label" for="statusUndone">Выполняется</label>
                        </div>
                        
                        <?php } else { ?>
                        
                        <div class="form-group form-check">
                            <input type="radio" name="status"   value="done" class="form-check-input" id="statusDone">
                                <label class="form-check-label" for="statusDone">Выполнено</label>
                            </div>

                            <div class="form-group form-check">
                                <input type="radio" name="status" value="progress"  checked class="form-check-input" id="statusUndone">
                                <label class="form-check-label"  for="statusUndone">Выполняется</label>
                            </div>
                        
                        <?php } ?>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                    <?php if($updated): ?>
                        <p>Обновили.</p>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
      




        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="<?php echo Asset::includeJS("main.js"); ?>"></script>
    </body>
</html>