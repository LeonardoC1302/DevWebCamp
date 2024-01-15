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
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}

function isAuth() : bool {
    session_start();
    return isset($_SESSION['name']) && !empty($_SESSION);
}

function isAdmin() : bool {
    session_start();
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}
