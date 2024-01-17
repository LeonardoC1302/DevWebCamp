<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function current_page($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}

function isAuth() : bool {
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['name']) && !empty($_SESSION);
}

function isAdmin() : bool {
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function animations() : void{
    $effects = ['fade-up', 'fade-down', 'fade-right', 'fade-left', 'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out'];
    $effect = array_rand($effects, 1);
    echo ' data-aos="' . $effects[$effect] . '" ';
}
