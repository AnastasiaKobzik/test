<?php

require("../app/dataBase.php");
require("../app/service.php");

$authValidate = new AuthValidate();
$dataDase = new DataBase();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    if (!empty($_POST)){

        header('Content-Type: application/json');
        
        $errors = $authValidate->validate($_POST);

        if (empty($errors)){

            $readeErrors = $dataDase->readeUser($_POST);

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