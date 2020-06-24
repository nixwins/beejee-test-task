<?php

header("Content-type:application/json");

$task = $data["task"];


$content = '<tr><td>' . $task["username"] . '</td>
    <td>' . $task["email"] . '</td>
    <td>' . $task["tasktext"] . '</td>
    <td>' . $task["status"] . '</td></tr>';

$data["html"] = $content;



echo json_encode($data);
?>
