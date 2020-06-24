<?php

namespace Core;

class Validator {

    public static function isEmail($email) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return true;
        } else {
            return false;
        }
    }

    public static function validUsername($username) {

        if (!empty($username) && (strlen($username) >= 2)) {
            return true;
        }

        return false;
    }

    public static function validTaskText($text) {

        if (!empty($text) && (strlen($text) >= 2)) {
            return true;
        }

        return false;
    }

    public static function validateAll($email, $username, $tasktext) {

        $errors = [];
        if (!self::isEmail($email)) {
            $errors[] = ["valid_status" => false, "message" => "E-mail адрес указан неверно.", "input" => "email"];
            //$this->render->view('task.create', ['data' => ["valid_status" => false, "message" => "E-mail адрес указан неверно."]]);
            // $response->json(["valid_status" => false, "message" => "E-mail адрес указан неверно.", "email"]);
        }

        if (!self::validUsername($username)) {
            $errors[] = ["valid_status" => false, "message" => "Имя пользавателя указан неверно. Не должно быть пустым", "input" => "username"];
            // $response->json(["valid_status" => false, "message" => "Имя пользавателя указан неверно. Не должно быть пустым"]);
            //$this->render->view('task.create', ['data' => ["valid_status" => false, "message" => "Имя пользавателя указан неверно. Не должно быть пустым"]]);
        }

        if (!self::validUsername($tasktext)) {
            $errors[] = ["valid_status" => false, "message" => "Описание задачи не должно быть пустым", "input" => "tasktext"];
            //  $response->json(["valid_status" => false, "message" => "Описание задачи не должно быть пустым"]);
            // $this->render->view('task.create', ['data' => ["valid_status" => false, "message" => "Описание задачи не должно быть пустым"]]);
        }
        //print_r($errors);
        return $errors;
    }

}
