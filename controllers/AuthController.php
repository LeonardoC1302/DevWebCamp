<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {

        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $user = new User($_POST);

            $alerts = $user->validateLogin();
            
            if(empty($alerts)) {
                $user = user::where('email', $user->email);
                if(!$user || !$user->confirmed ) {
                    user::setAlert('error', 'The user does not exist or is not confirmed');
                } else {
                    if( password_verify($_POST['password'], $user->password) ) {

                        session_start();    
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name;
                        $_SESSION['lastName'] = $user->lastName;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['admin'] = $user->admin ?? null;
                        
                    } else {
                        user::setAlert('error', 'Incorrect password');
                    }
                }
            }
        }

        $alerts = user::getalerts();
        
        $router->render('auth/login', [
            'title' => 'Login',
            'alerts' => $alerts
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
       
    }

    public static function register(Router $router) {
        $alerts = [];
        $user = new user;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user->sync($_POST);
            
            $alerts = $user->validateAccount();

            if(empty($alerts)) {
                $userExists = user::where('email', $user->email);

                if($userExists) {
                    user::setAlert('error', 'The user already exists');
                    $alerts = user::getalerts();
                } else {
                    $user->hashPassword();
                    unset($user->password2);

                    $user->createToken();

                    $result =  $user->save();

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();
                    

                    if($result) {
                        header('Location: /message');
                    }
                }
            }
        }

        $router->render('auth/register', [
            'title' => 'Create a DevWebcamp Account',
            'user' => $user, 
            'alerts' => $alerts
        ]);
    }

    public static function forgot(Router $router) {
        $alerts = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new user($_POST);
            $alerts = $user->validateEmail();

            if(empty($alerts)) {
                $user = user::where('email', $user->email);

                if($user && $user->confirmed) {
                    $user->createToken();
                    unset($user->password2);
                    $user->save();
                    $email = new Email( $user->email, $user->name, $user->token );
                    $email->sendInstructions();
                    $alerts['success'][] = 'We have sent you an email with instructions to reset your password';
                } else {
                    $alerts['error'][] = 'The user does not exist or is not confirmed';
                }
            }
        }

        $router->render('auth/forgot', [
            'title' => 'Forgot My Password',
            'alerts' => $alerts
        ]);
    }

    public static function reset(Router $router) {

        $token = s($_GET['token']);

        $invalidToken = true;

        if(!$token) header('Location: /');
        $user = user::where('token', $token);

        if(empty($user)) {
            user::setAlert('error', 'Invalid Token, try again');
            $invalidToken = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sync($_POST);
            $alerts = $user->validatePassword();

            if(empty($alerts)) {
                $user->hashPassword();
                $user->token = null;
                $result = $user->save();

                if($result) {
                    header('Location: /');
                }
            }
        }

        $alerts = user::getalerts();

        $router->render('auth/reset', [
            'title' => 'Reset Password',
            'alerts' => $alerts,
            'invalidToken' => $invalidToken
        ]);
    }

    public static function message(Router $router) {

        $router->render('auth/message', [
            'title' => 'Account Created Successfully'
        ]);
    }

    public static function confirm(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        $user = user::where('token', $token);

        if(empty($user)) {
            user::setAlert('error', 'Invalid Token, account not confirmed');
        } else {
            $user->confirmed = 1;
            $user->token = '';
            unset($user->password2);
            
            $user->save();

            user::setAlert('success', 'Account confirmed successfully');
        }

     

        $router->render('auth/confirm', [
            'title' => 'Confirm Your DevWebcamp Account',
            'alerts' => user::getalerts()
        ]);
    }
}