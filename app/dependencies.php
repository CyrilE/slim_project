<?php
// DIC configuration
$container = $app->getContainer();

$container['db'] = function($c){
    $settings = $c->get('settings');
    $host = $settings['db']['host'];
    $dbname = $settings['db']['database'];
    $username = $settings['db']['username'];
    $password = $settings['db']['password'];
    \RedBeanPHP\Facade::setup("mysql:host=$host;dbname=$dbname", $username, $password);
};

$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $loader = new \Twig_Loader_Filesystem($settings['view']['template_path']);
    $view = new \Twig_Environment($loader, $settings['view']['twig']);
    return $view;
}; 

$container[App\Controllers\DepartmentController::class] = function ($c) {
    return new App\Controllers\DepartmentController($c->get('view'), $c->get('db'));
};

$container[App\Controllers\EmployeeController::class] = function ($c) {
    return new App\Controllers\EmployeeController($c->get('view'), $c->get('db'));
};

$container[App\Controllers\HomeController::class] = function ($c) {
    return new App\Controllers\HomeController($c->get('view'), $c->get('db'));
};