<?php

namespace Controllers;

use Model\EventSchedule;

class APIEvents {
    public static function index(){
        $day = $_GET['day'] ?? '';
        $day = filter_var($day, FILTER_VALIDATE_INT);

        $categoryId = $_GET['categoryId'] ?? '';
        $categoryId = filter_var($categoryId, FILTER_VALIDATE_INT);


        if(!$day || !$categoryId) {
            echo json_encode([]);
            return;
        }

        $events = EventSchedule::whereArray(['dayId' => $day, 'categoryId' => $categoryId]) ?? [];
        echo json_encode($events);
    }
}