<?php

namespace App\Controllers;

use App\Services\Router;
use App\Services\ValidationCheck;

class Auth
{
    public function register($data, $files){

        $password = ValidationCheck::protectionAgainstXss($data['password']);
        $passwordConfirm= ValidationCheck::protectionAgainstXss($data['passwordConfirm']);
        $email = ValidationCheck::protectionAgainstXss($data['email']);
        $lastname = ValidationCheck::protectionAgainstXss($data['lastname']);
        $name = ValidationCheck::protectionAgainstXss($data['name']);
        $date = $data['date'];
        $pol = $data['check'];


        $avatar = $files['avatar'];


        if($avatar['name']){
                $fileName = time() . '_' . $avatar['name'];
                $path ='uploads/' . $fileName;
                move_uploaded_file($avatar['tmp_name'],$path);
        }
        else{
            die('аватарка не загружена');
        }

        $errorFields = [];


        if($date === ''){
            $errorFields[] =  'date';
        }

        if($password === '' || strlen($password) < 8 || strlen($password) > 24  ||  preg_match('/[А-Яа-яЁё_ -]/iu', $password)){
            $errorFields[] =  'password';
        }

        if($email === '' || strlen($email) < 3 || strlen($email) > 42 || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errorFields[] = 'email';
        }

        if($name === '' || strlen($name) > 32 || strlen($name) < 3){
            $errorFields[] =  'name';
        }

        if($lastname === '' || strlen($lastname) > 32 || strlen($lastname) < 3){
            $errorFields[] =  'lastname';
        }

        if(!empty($errorFields)){
            die('ошибки валидации полей');
        }



        $user = \R::findOne('users' , 'email = ?', [$email]);

        if($user){
            die('такая почта уже зарегана');
        }

        if($password !== $passwordConfirm){
            die('пароли не совпадают');
        }

        $age = explode("-", $date);
        $age = 2022-$age[0];
        if($age<18){
            die('Вам нет 18');
        }

        $user = \R::dispense('users');
        $user->email = $email;
        $user->password = password_hash($password,PASSWORD_DEFAULT);
        $user->lastname = $lastname;
        $user->name = $name;
        $user->avatar = $path;
        $user->date = $date;
        $user->pol = $pol;
        $user->age = $age;
        echo $age;
        $user->group = 1; // 1-пользователь , 2 - админ
        \R::store($user);


        Router::redirect('/login');

    }

    public function login($data){
        $email =  ValidationCheck::protectionAgainstXss($data['email']);
        $password = ValidationCheck::protectionAgainstXss($data['password']);

        $user = \R::findOne('users' , 'email = ?' , [$email]);

        if(!$user){
            die('пользователь не найден');
        }

        if(password_verify($password, $user->password)){
            session_start();
            $_SESSION['user']=[
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'group' => $user->group,
                'pol' => $user->pol,
                'date' => $user->date,
                'avatar' => $user->avatar

            ];
            Router::redirect('/profile');
        }else{
            die('неверный логин или пароль');
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        Router::redirect('/login');
    }
}