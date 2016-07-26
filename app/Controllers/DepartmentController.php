<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\Facade as RedBean;
use Slim\Views\Twig;

class DepartmentController
{
	private $view;

   	public function __construct(Twig $view) {
	    $this->view = $view;
   	}

	public function index($request, $response, $args)
	{
		RedBean::setup('mysql:host=localhost;dbname=company', 'root', 'foo1024');
		$dep = RedBean::findAll('departments');
		$loader = new Twig_Loader_Filesystem('../templates');
		$twig = new Twig_Environment($loader);
		$twig->render('index.twig', array('dep' => $dep));
		//$this->view->render($response, 'index.twig');

		return $response;
	}

	public function show($request, $response, $args)
	{
		RedBean::setup('mysql:host=localhost;dbname=company', 'root', 'foo1024');
		$id = $request->getAttribute('id');
		$dep = RedBean::load('departments', $id);
		var_dump($dep);
		$response->getBody()->write("show $id");

		return $response;
	}
	
	public function edit($request, $response, $args)
	{
		
	}

	public function update($request, $response, $args)
	{
		
	}

	public function create($request, $response, $args)
	{
		
	}

	public function store($request, $response, $args)
	{
		
	}

	public function delete($request, $response, $args)
	{
		
	}
}