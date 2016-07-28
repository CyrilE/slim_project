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
		$departments = RedBean::getAll('SELECT departments.name as name, COUNT(employees.id) as count, ROUND(AVG(TIMESTAMPDIFF(YEAR, employees.birthday, curdate()))) as avg FROM departments, employees WHERE departments.id = employees.departments_id GROUP BY departments.name');
		
		echo $this->view->render('reports.html', array('departments' => $departments));		
	}
}