<?php
// DIC configuration
$container = $app->getContainer();
// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------
$container[App\Controllers\HomeController::class] = function ($c) {
    return new App\Controllers\HomeController($c);
};

$container['db'] = function($c){
    $settings = $c->get('settings');
    RedBeanPHP::setup('mysql:host=localhost;dbname=company',
        'root', '');
};

/*$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    //$view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    //$view->addExtension(new Twig_Extension_Debug());
    return $view;
};*/