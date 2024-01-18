<?php

namespace Controllers;

use Model\Register;
use Model\User;
use Model\Package;
use MVC\Router;

class RegisterController {
    public static function create(Router $router) {
        if(!isAuth()){
            header('Location: /');
        }

        $register = Register::where('userId', $_SESSION['id']);
        if(isset($register) && $register->packageId === '3'){
            header('Location: /ticket?id=' . urlencode($register->token));
        }

        $router->render('register/create', [
            'title' => 'Finish Registration'
        ]);
    }

    public static function free(Router $router) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAuth()){
                header('Location: /login');
            }

            $register = Register::where('userId', $_SESSION['id']);
            if(isset($register) && $register->packageId === '3'){
                header('Location: /ticket?id=' . urlencode($register->token));
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            
            $data = [
                'packageId' => 3,
                'paymentId' => '',
                'token' => $token,
                'userId' => $_SESSION['id']
            ];

            $register = new Register($data);
            $result = $register->save();
            if($result){
                header('Location: /ticket?id=' . urlencode($register->token));
            }
            
        }
    }

    public static function ticket(Router $router) {
        $id = $_GET['id'];
        if(!$id || !(strlen($id) === 8)){
            header('Location: /');
        }
        $register = Register::where('token', $id);
        if(!$register){
            header('Location: /');
        }

        $register->user = User::find($register->userId);
        $register->package = Package::find($register->packageId);

        $router->render('register/ticket', [
            'title' => 'Attendance to DevWebCamp',
            'register' => $register
        ]);
    }

    public static function pay(Router $router) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAuth()){
                header('Location: /login');
            }

            if(empty($_POST)){
                echo json_encode([]);
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            
            $data = $_POST;
            $data['token'] = $token;
            $data['userId'] = $_SESSION['id'];

            try{
                $register = new Register($data);
                $result = $register->save();
                echo json_encode($result);
            } catch(\Throwable $th){
                echo json_encode([
                    'result' => 'error'
                ]);
                return;
            }
            
        }
    }
}