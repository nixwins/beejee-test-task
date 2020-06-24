<?php use Core\Asset; ?>

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
        <h1>Вы не автаризованы.</h1>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginModal">Вход</button>
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