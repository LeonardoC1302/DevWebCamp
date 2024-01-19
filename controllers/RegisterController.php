<?php

namespace Controllers;

use Model\Register;
use Model\User;
use Model\Package;
use Model\Category;
use Model\Day;
use Model\Hour;
use Model\Speaker;
use Model\Event;
use Model\EventsXRegister;
use Model\Gift;
use MVC\Router;

class RegisterController {
    public static function create(Router $router) {
        if(!isAuth()){
            header('Location: /');
            return;
        }

        $register = Register::where('userId', $_SESSION['id']);
        if(isset($register) && ($register->packageId === '3'  || $register->packageId === '2')){
            header('Location: /ticket?id=' . urlencode($register->token));
            return;
        }

        if(isset($register) && $register->packageId === '1'){
            header('Location: /finish-registration/conferences');
            return;
        }

        $router->render('register/create', [
            'title' => 'Finish Registration'
        ]);
    }

    public static function free(Router $router) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAuth()){
                header('Location: /login');
                return;
            }

            $register = Register::where('userId', $_SESSION['id']);
            if(isset($register) && $register->packageId === '3'){
                header('Location: /ticket?id=' . urlencode($register->token));
                return;
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
                return;
            }
            
        }
    }

    public static function ticket(Router $router) {
        $id = $_GET['id'];
        if(!$id || !(strlen($id) === 8)){
            header('Location: /');
            return;
        }
        $register = Register::where('token', $id);
        if(!$register){
            header('Location: /');
            return;
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
                return;
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

    public static function conferences(Router $router) {
        if(!isAuth()){
            header('Location: /login');
            return;
        }
        $userId = $_SESSION['id'];
        $register = Register::where('userId', $userId);

        if(isset($register) && $register->packageId === '2'){
            header('Location: /ticket?id=' . urlencode($register->token));
            return;
        }

        if(!$register || $register->packageId !== '1'){
            header('Location: /');
            return;
        }

        $finishedRegister = EventsXRegister::where('registerId', $register->id);
        if(isset($finishedRegister)){
            header('Location: /ticket?id=' . urlencode($register->token));
            return;
        }

        $events = Event::order('hourId', 'ASC');
        
        $formattedEvents = [];
        foreach($events as $event){
            $event->category = Category::find($event->categoryId);
            $event->day = Day::find($event->dayId);
            $event->hour = Hour::find($event->hourId);
            $event->speaker = Speaker::find($event->speakerId);

            if($event->dayId === "1" && $event->categoryId === "1"){
                $formattedEvents['conferences_f'][] = $event;
            }
            if($event->dayId === "2" && $event->categoryId === "1"){
                $formattedEvents['conferences_s'][] = $event;
            }
            if($event->dayId === "1" && $event->categoryId === "2"){
                $formattedEvents['workshops_f'][] = $event;
            }
            if($event->dayId === "2" && $event->categoryId === "2"){
                $formattedEvents['workshops_s'][] = $event;
            }
        }

        $gifts = Gift::all('ASC');

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAuth()){
                header('Location: /login');
                return;
            }

            $events = explode(',', $_POST['events']);
            if(empty($events)){
                echo json_encode(['result' => false]);
                return;
            }

            $register = Register::where('userId', $_SESSION['id']);
            if(!isset($register) || $register->packageId !== '1'){
                echo json_encode(['result' => false]);
                return;
            }

            $eventsArray = [];
            foreach($events as $event){
                $event = Event::find($event);
                if(!isset($event) || $event->availables === '0'){
                    echo json_encode(['result' => false]);
                    return;
                }
                $eventsArray[] = $event;
            }
            foreach($eventsArray as $event){
                $event->availables -= 1;
                $event->save();

                $data = [
                    'eventId' => $event->id,
                    'registerId' => $register->id
                ];
                $userRegister = new EventsXRegister($data);
                $userRegister->save();
            }
            $register->sync(['giftId' => $_POST['giftId']]);
            $result = $register->save();

            if($result){
                echo json_encode(['result' => $result, 'token' => $register->token]);
            } else{
                echo json_encode(['result' => false]);
            }

            return;
        }

        $router->render('register/conferences', [
            'title' => 'Choose Workshops and Conferences',
            'events' => $formattedEvents,
            'gifts' => $gifts
        ]);
    }
}