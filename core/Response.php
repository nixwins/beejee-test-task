<?php

namespace Core;

class Response {

    private $contentType = [
        "json" => "application/json",
        "html" => "text/html"];

    public function json($data) {
        header("Content-type:" . $this->contentType["json"]);
        echo json_encode($data);
    }

}
