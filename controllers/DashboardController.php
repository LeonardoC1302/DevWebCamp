<?php

namespace Controllers;

use Model\Event;
use Model\Package;
use Model\Register;
use Model\User;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {

        $registers = Register::get(5);
        foreach($registers as $register){
            $register->user = User::find($register->userId);
            $register->package = Package::find($register->packageId);
        }

        $virtuals = Register::count('packageId', 2);
        $inperson = Register::count('packageId', 1);

        $revenue = ($virtuals * 46.41) + ($inperson * 189.54);

        $less_available = Event::orderLimit('availables', 'ASC', 5);
        $more_available = Event::orderLimit('availables', 'DESC', 5);

        $router->render('admin/dashboard/index', [
            'title' => 'Administration Panel',
            'registers' => $registers,
            'revenue' => $revenue,
            'less_available' => $less_available,
            'more_available' => $more_available
        ]);
    }
}