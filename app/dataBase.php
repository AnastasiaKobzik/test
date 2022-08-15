<?php

class DataBase{
	
	protected $file = '../page/users.json';
	protected $errors = [];
	protected $str = "соль";

	function createUser(array $post){
		$data = array();

		$data['id'] = time();
		$data['name'] = trim($post['name']);
		$data['login'] = trim($post['login']);
		$data['email'] = trim($post['email']);
		$data['password'] = trim($this->str.md5($post['password']));

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


	function readeUser(array $post){
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
}

?>