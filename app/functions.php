<?php

class LogSignClass
{
    private $file = '../page/users.json';
    protected $errors = [];
    protected $str = "соль";


    function create(array $post){
        $data = array();
        
        
        $data['id'] = time();
        $data['name'] = trim($post["name"]);
        $data['login'] = trim($post["login"]);
        $data['email'] = trim($post["email"]);
        $data['password'] = trim($this->str.md5($post["password"]));
        $file_data = json_decode(file_get_contents($this->file), true);
        for ($i=0; $i < count($file_data); $i++) {
            if ($file_data[$i]['email'] == $post['email']) {
                $this->errors[]['email'] = 'Пользователь с таким email уже существует';
            }
            if ($file_data[$i]['login'] == $post['login']) {
                $this->errors[]['login'] = 'Пользователь с таким логином уже существует';
            }
                
        }
        if (count($this->errors) > 0) {
            return $this->errors;
        }else{

            $file_data = json_decode(file_get_contents($this->file), true);

            $file_data[] = $data;

            file_put_contents($this->file, json_encode($file_data));

            if(session_status()!=PHP_SESSION_ACTIVE) session_start();
            $_SESSION['nameUser'] = $data['name'];
        }

        return count($this->errors);
    }

    function reade(array $post){
        
        $file_data = json_decode(file_get_contents($this->file), true);

        for ($i=0; $i < count($file_data); $i++) {

            if ($file_data[$i]['login'] != trim($post['loginIn'])){
                
                $this->errors[]['loginIn'] = 'Пользователя с таким логином не существует';
            
            }elseif ($file_data[$i]['login'] == trim($post['loginIn'])){

                $this->errors = [];
                
                if ($file_data[$i]['password'] == trim($this->str.md5($post['passwordIn']))) {
                    
                    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
                    $_SESSION['nameUser'] = $file_data[$i]['name'];
                    
                    return count($this->errors);

                }else{
                
                    $this->errors[]['passwordIn'] = 'Неверный пароль';
                    break;
                    
                }
            }            
                
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        }
    }

    function validate(array $request){
        $nameRegEx = "/^[а-я]+$/ui";
        $passwordRegEx = "/[A-Za-z]+[0-9]+/";

        if (!isset($request['name']) || empty($request['name'])) {
            $this->errors[]['name'] = 'Имя не указано';
        }elseif (mb_strlen($request['name']) < 2) {
            $this->errors[]['name'] = 'Имя должно быть больше 2х символов';
        }elseif (!preg_match($nameRegEx,$request['name'])) {
            $this->errors[]['name'] = 'Имя должно состоять из букв русского алфавита';
        }

        if (!isset($request['login']) || empty($request['login'])){
            $this->errors[]['login'] = 'Логин не указан';
        }elseif (mb_strlen($request['login']) < 6) {
            $this->errors[]['login'] = 'Логин должен быть минимум из 6 символов';
        }

        if (!isset($request['email']) || strlen($request['email']) == 0) {
            $this->errors[]['email'] = 'Email не указан';
        } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[]['email'] = 'Неправильный формат email';
        }

        if (!isset($request['password']) || empty($request['password'])) {
            $this->errors[]['password'] = 'Пароль не указан';
        }elseif (mb_strlen($request['password']) < 6) {
            $this->errors[]['password'] = 'Пароль должен быть минимум из 6 символов';
        }elseif (!preg_match($passwordRegEx,$request['password'])) {
            $this->errors[]['password'] = 'Пароль должен содержать цифры и буквы латинского алфавита';
        }

        if (!isset($request['confirmPassword']) || empty($request['confirmPassword'])) {
            $this->errors[]['confirmPassword'] = 'Повторите пароль';
        } elseif ((isset($request['password']) && isset($request['confirmPassword'])) && ($request['password'] != $request['confirmPassword'])) {
            $this->errors[]['confirmPassword'] = 'Пароли не совпадают';
        }

        return $this->errors;
    }
}

?>