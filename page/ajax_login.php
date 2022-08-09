<?php

require("../app/functions.php");

$logSignClass = new LogSignClass();
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    if (!empty($_POST)){

        header('Content-Type: application/json');
        
        $errors = array();
        if (!isset($_POST['loginIn']) || empty($_POST['loginIn'])){
            $errors[]['loginIn'] = 'Имя не указано';
        }
        if(!isset($_POST['passwordIn']) || empty($_POST['passwordIn'])){
            $errors[]['passwordIn'] = 'Пароль не указан';
        }

        if (empty($errors)){

            $readeErrors = $logSignClass->reade($_POST);

            if ($readeErrors == 0) {
                
                http_response_code(201);
                $data_json = json_encode([
                    'success' => true
                ]);
                echo $data_json;
                exit();
            }

            http_response_code(422);
            $data_json = json_encode([
                'success' => false,
                'errors' => $readeErrors
            ]);
            echo $data_json;
            exit();
        }
        http_response_code(422);

        $data_json = json_encode([
            'success' => false,
            'errors' => $errors
        ]);
        echo $data_json;
        exit();
    }
}

?>