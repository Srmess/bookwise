<?php

function loadController($database)
{
    $controller  =  str_replace('/', '', parse_url($_SERVER['REQUEST_URI'])['path']);


    if (!$controller) $controller = 'index';


    if (!file_exists("../controller/{$controller}.controller.php")) {
        abort('404');
    }


    require "../controller/{$controller}.controller.php";
}

loadController($database);
