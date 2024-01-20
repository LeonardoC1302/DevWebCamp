<?php

namespace Controllers;

use Model\Gift;
use Model\Register;

class APIGifts {
    public static function index(){
        if(!isAdmin()){
            echo json_encode([]);
            return;
        }
        $gifts = Gift::all();

        foreach($gifts as $gift) {
            $gift->total = Register::totalArray(['giftId' => $gift->id, 'packageId' => '1']);
        }

        echo json_encode($gifts);
        return;
    }
}