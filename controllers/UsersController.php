<?php

namespace Controllers;

use Classes\Pagination;
use Model\Package;
use Model\Register;
use Model\User;
use MVC\Router;

class UsersController {
    public static function index(Router $router) {
        if(!isAdmin()){
            header('Location: /');
        }

        $current_page = filter_var($_GET['page'], FILTER_VALIDATE_INT); 
        if(!$current_page || $current_page < 1){
            header('Location: /admin/users?page=1');
        }
        $total_registers = Register::count();
        $registers_per_page = 10;
        $pagination = new Pagination($current_page, $registers_per_page, $total_registers);

        if($pagination->totalPages() < $current_page){
            header('Location: /admin/users?page=1');
        }

        $registers = Register::paginate($registers_per_page, $pagination->offset());

        foreach($registers as $register){
            $register->user = User::find($register->userId);
            $register->package = Package::find($register->packageId);
        }

    $router->render('admin/users/index', [
            'title' => 'Registered Users',
            'registers' => $registers,
            'pagination' => $pagination->pagination()
        ]);
    }
}