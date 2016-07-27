<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\Facade as RedBean;

class HomeController
{
	private $view;

   	public function __construct($container) {
	    $this->view = $container->get('view');
	    $container->get('db'); // initializtion to connect db
   	}

	public function index($request, $response, $args)
	{
		echo $this->view->render('index.html');

		return $response;
	}

	public function reports($request, $response, $args)
	{

	}
}