<?php

require_once './vendor/autoload.php';
session_start();

use App\Config\App;

App::initDB();

require_once './route.php';


