<?php

namespace Controllers;

use Model\Speaker;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class SpeakersController {
    public static function index(Router $router) {
        $router->render('admin/speakers/index', [
            'title' => 'Speakers / Lecturers'
        ]);
    }

    public static function create(Router $router) {
        $alerts = [];
        $speaker = new Speaker;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!empty($_FILES['image']['tmp_name'])){
                $image_folder = '../public/img/speakers';
                if(!is_dir($image_folder)) {
                    mkdir($image_folder, 0775, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 680)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800, 680)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            }
            $_POST['socials'] = json_encode($_POST['socials'], JSON_UNESCAPED_SLASHES);
            $speaker->sync($_POST);


            $alerts = $speaker->validate();

            if(empty($alerts)){
                $image_png->save($image_folder . '/' . $image_name . '.png');
                $image_webp->save($image_folder . '/' . $image_name . '.webp');

                $result = $speaker->save();
                if($result) {
                    header('Location: /admin/speakers');
                }
            }
        }

        $router->render('admin/speakers/create', [
            'title' => 'Register Speaker',
            'alerts' => $alerts,
            'speaker' => $speaker
        ]);
    }
}