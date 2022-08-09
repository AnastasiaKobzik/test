<?php

require("../app/functions.php");

$logSignClass = new LogSignClass();
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
   if (!empty($_POST)){
        header('Content-Type: application/json');
        $errors = $logSignClass->validate($_POST);

        if (empty($errors)) {
            $createErrors = $logSignClass->create($_POST);
            if ($createErrors == 0) {
                http_response_code(201);
                
                echo json_encode([
                    'success' => true
                ]);
                exit();
            }
            http_response_code(422);
            $data_json = json_encode([
                'success' => false,
                'errors' => $createErrors
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