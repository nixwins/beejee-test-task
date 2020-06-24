<?php

namespace App\Controller;

use Core\View\View;
use App\Config\App;

class Controller {

    protected $render;
    protected $request;
    protected $response;
    protected $service;
    protected $app;
    protected $params;

    public function init($req, $res, $service, $app, $params) {

        $this->request = $req;
        $this->response = $res;
        $this->service = $service;
        $this->app = $app;
        $this->params = $params;
    }

    public function __construct() {

        $this->render = new View();
    }

}
