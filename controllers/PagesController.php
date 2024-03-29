<?php 

namespace Controllers;

use Model\Event;
use Model\Category;
use Model\Day;
use Model\Hour;
use Model\Speaker;
use MVC\Router;

class PagesController{
    public static function index(Router $router){
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

        $totalSpeakers = Speaker::count();
        $conferences = Event::count('categoryId', '1');
        $workshops = Event::count('categoryId', '2');

        $speakers = Speaker::all();
        
        $router->render('pages/index', [
            'title' => 'Home',
            'events' => $formattedEvents,
            'totalSpeakers' => $totalSpeakers,
            'conferences' => $conferences,
            'workshops' => $workshops,
            'speakers' => $speakers
        ]); 
    }

    public static function event(Router $router){
        $router->render('pages/devwebcamp', [
            'title' => 'About DevWebCamp'
        ]); 
    }

    public static function packages(Router $router){
        $router->render('pages/packages', [
            'title' => 'DevWebCamp Packages'
        ]); 
    }

    public static function conferences(Router $router){
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

        $router->render('pages/conferences', [
            'title' => 'Conferences & Workshops',
            'events' => $formattedEvents
        ]); 
    }

    public static function error(Router $router){
        $router->render('pages/error', [
            'title' => 'Page Not Found'
        ]); 
    }
}