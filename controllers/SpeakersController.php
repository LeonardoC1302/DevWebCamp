<?php

namespace Controllers;

use Classes\Pagination;
use Model\Speaker;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class SpeakersController {
    public static function index(Router $router) {
        if(!isAdmin()){
            header('Location: /');
        }

        $current_page = filter_var($_GET['page'], FILTER_VALIDATE_INT); 
        if(!$current_page || $current_page < 1){
            header('Location: /admin/speakers?page=1');
        }
        $total_registers = Speaker::count();
        $registers_per_page = 10;
        $pagination = new Pagination($current_page, $registers_per_page, $total_registers);

        if($pagination->totalPages() < $current_page){
            header('Location: /admin/speakers?page=1');
        }

        $speakers = Speaker::paginate($registers_per_page, $pagination->offset());

        $router->render('admin/speakers/index', [
            'title' => 'Speakers / Lecturers',
            'speakers' => $speakers,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router) {
        if(!isAdmin()){
            header('Location: /');
        }
        $alerts = [];
        $speaker = new Speaker;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAdmin()){
                header('Location: /');
            }
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
            'speaker' => $speaker,
            'socials' => json_decode($speaker->socials)
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
            header('Location: /admin/speakers');
        }

        $speaker = Speaker::find($id);
        if(!$speaker){
            header('Location: /admin/speakers');
        }

        $speaker->currentImage = $speaker->image;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!isAdmin()){
                header('Location: /');
            }
            if(!empty($_FILES['image']['tmp_name'])){
                $image_folder = '../public/img/speakers';
                if(!is_dir($image_folder)) {
                    mkdir($image_folder, 0775, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 680)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800, 680)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            } else{
                $_POST['image'] = $speaker->currentImage;
            }

            $_POST['socials'] = json_encode($_POST['socials'], JSON_UNESCAPED_SLASHES);
            $speaker->sync($_POST);

            $alerts = $speaker->validate();
            if(empty($alerts)){
                if(isset($image_name)){
                    $image_png->save($image_folder . '/' . $image_name . '.png');
                    $image_webp->save($image_folder . '/' . $image_name . '.webp');
                }
                // DELETE OLD IMAGE
                if(isset($speaker->currentImage) && $speaker->currentImage !== $speaker->image){
                    // debug($speaker->currentImage);
                    unlink($image_folder . '/' . $speaker->currentImage . '.png');
                    unlink($image_folder . '/' . $speaker->currentImage . '.webp');
                }
                $result = $speaker->save();
                if($result) {
                    header('Location: /admin/speakers');
                }
            }
        }

        $router->render('admin/speakers/update', [
            'title' => 'Update Speaker',
            'alerts' => $alerts,
            'speaker' => $speaker,
            'socials' => json_decode($speaker->socials)
        ]);
    }

    public static function delete(Router $router){
        if(!isAdmin()){
            header('Location: /');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!isAdmin()){
                header('Location: /');
            }
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $speaker = Speaker::find($id);
            if(!isset($speaker)){
                header('Location: /admin/speakers');
            }
            // DELETE SPEAKER IMAGE
            $image_folder = '../public/img/speakers';
            unlink($image_folder . '/' . $speaker->image . '.png');
            unlink($image_folder . '/' . $speaker->image . '.webp');

            $result = $speaker->delete();
            if($result){
                header('Location: /admin/speakers');
            }
        }
    }
}