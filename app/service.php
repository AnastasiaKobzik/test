<?php

class AuthValidate{

	protected $errorsAuth = [];

	function validate (array $request){
		
        if (!isset($request['loginIn']) || empty($request['loginIn'])) {
            $this->errorsAuth[]['loginIn'] = 'Логин не указан';
        }

        if (!isset($request['passwordIn']) || empty($request['passwordIn'])) {
            $this->errorsAuth[]['passwordIn'] = 'Пароль не указан';
        }

        return $this->errorsAuth;
	}
}

class SignValidate{

	public $errorsSign = [];

	function validateSign(array $request){
		$nameRegEx = "/^[а-я]+$/ui";
        $passwordRegEx = "/(?=.+[0-9])(?=.+[a-z])/i";
        $spase = "/[\s]+/";
        $simbol = "/[\W]+/";

        if (!isset($request['name']) || empty($request['name'])) {
            $this->errorsSign[]['name'] = 'Имя не указано';
        }elseif (mb_strlen($request['name']) < 2) {
            $this->errorsSign[]['name'] = 'Имя должно быть больше 2х символов';
        }elseif (!preg_match($nameRegEx,$request['name'])) {
            $this->errorsSign[]['name'] = 'Имя должно состоять из букв русского алфавита';
        }

        if (!isset($request['login']) || empty($request['login'])){
            $this->errorsSign[]['login'] = 'Логин не указан';
        }elseif (mb_strlen($request['login']) < 6) {
            $this->errorsSign[]['login'] = 'Логин должен быть минимум из 6 символов';
        }elseif (preg_match($spase,$request['login'])) {
            $this->errorsSign[]['login'] = 'Логин не может содержать пробелы';
        }

        if (!isset($request['email']) || strlen($request['email']) == 0) {
            $this->errorsSign[]['email'] = 'Email не указан';
        } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errorsSign[]['email'] = 'Неправильный формат email';
        }

        if (!isset($request['password']) || empty($request['password'])) {
            $this->errorsSign[]['password'] = 'Пароль не указан';
        }elseif (mb_strlen($request['password']) < 6) {
            $this->errorsSign[]['password'] = 'Пароль должен быть минимум из 6 символов';
        }elseif (!preg_match($passwordRegEx,$request['password'])) {
            $this->errorsSign[]['password'] = 'Пароль должен содержать цифры и буквы латинского алфавита';
        }elseif (preg_match($simbol,$request['password'])) {
            $this->errorsSign[]['password'] = 'Пароль не может содержать пробелы и спецсимволы';
        }

        if (!isset($request['confirmPassword']) || empty($request['confirmPassword'])) {
            $this->errorsSign[]['confirmPassword'] = 'Повторите пароль';
        } elseif ((isset($request['password']) && isset($request['confirmPassword'])) && ($request['password'] != $request['confirmPassword'])) {
            $this->errorsSign[]['confirmPassword'] = 'Пароли не совпадают';
        }

        return $this->errorsSign;
	}
}

?>