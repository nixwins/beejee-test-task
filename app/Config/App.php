<?php

namespace App\Config;

use \RedBeanPHP\R as R;

class App {

    public const dbDriver = "mysql";
    public const host = "localhost";
    public const dbname = "beejeetask";
    public const userName = "root";
    public const pass = "birone89";
    public const PATH_CONTROLLER = '\\App\\Controller\\';
    public const PATH_VIEWS = 'views';

    public static $SERVER_URL;

    public static function initDB() {

        R::setup('mysql:host=localhost;dbname=' . App::dbname, App::userName, App::pass);
    }

    public static function siteURL() {

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'] . '/';
        return $protocol . $domainName;
    }

}
