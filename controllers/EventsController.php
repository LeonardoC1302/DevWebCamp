<?php

namespace Controllers;

use MVC\Router;
use Model\Category;
use Model\Day;
use Model\Hour;
use Model\Event;

class EventsController {
    public static function index(Router $router) {
        $router->render('admin/events/index', [
            'title' => 'Conferences and Workshops'
        ]);
    }

    public static function create(Router $router) {
        $alerts = [];
        $categories = Category::all();
        $days = Day::all('ASC');
        $hours = Hour::all('ASC');
        $event = new Event();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}