<?php

namespace Controllers;

use Classes\Pagination;
use MVC\Router;
use Model\Category;
use Model\Day;
use Model\Hour;
use Model\Speaker;
use Model\Event;

class EventsController {
    public static function index(Router $router) {
        if(!isAdmin()){
            header('Location: /');
        }
        $currentPage = $_GET['page'];
        $currentPage = filter_var($currentPage, FILTER_VALIDATE_INT);
    
        if(!$currentPage) {
            header('Location: /admin/events?page=1');
        }

        $perPage = 10;
        $total = Event::count();

        $pagination = new Pagination($currentPage, $perPage, $total);

        $events = Event::paginate($perPage, $pagination->offset());

        foreach($events as $event) {
            $event->category = Category::find($event->categoryId);
            $event->day = Day::find($event->dayId);
            $event->hour = Hour::find($event->hourId);
            $event->speaker = Speaker::find($event->speakerId);
        }

        $router->render('admin/events/index', [
            'title' => 'Conferences and Workshops',
            'events' => $events,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router) {
        if(!isAdmin()){
            header('Location: /');
        }
        $alerts = [];
        $categories = Category::all();
        $days = Day::all('ASC');
        $hours = Hour::all('ASC');
        $event = new Event();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAdmin()){
                header('Location: /');
            }
            $event->sync($_POST);
            $alerts = $event->validate();
            if(empty($alerts)) {
                $result = $event->save();
                if($result) {
                    header('Location: /admin/events');
                }
            }
        }

        $router->render('admin/events/create', [
            'title' => 'Register Event',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
            'event' => $event
        ]);
    }

    public static function update(Router $router){
        if(!isAdmin()){
            header('Location: /');
        }
        $alerts = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id){
            header('Location: /admin/events');
        }

        $categories = Category::all();
        $days = Day::all('ASC');
        $hours = Hour::all('ASC');
        $event = Event::find($id);
        if(!$event){
            header('Location: /admin/events');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAdmin()){
                header('Location: /');
            }
            $event->sync($_POST);
            $alerts = $event->validate();
            if(empty($alerts)) {
                $result = $event->save();
                if($result) {
                    header('Location: /admin/events');
                }
            }
        }

        $router->render('admin/events/update', [
            'title' => 'Edit Event',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
            'event' => $event
        ]);
    }

    public static function delete(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!isAdmin()){
                header('Location: /');
            }
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $event = Event::find($id);
            if(!isset($event)){
                header('Location: /admin/events');
            }
            $result = $event->delete();
            if($result){
                header('Location: /admin/events');
            }
        }
    }
}