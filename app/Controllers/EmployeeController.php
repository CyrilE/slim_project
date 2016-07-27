<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\Facade as RedBean;

class EmployeeController
{
	private $view;

   	public function __construct($container) {
	    $this->view = $container->get('view');
	    $container->get('db'); // initializtion to connect db
   	}

	public function index($request, $response, $args)
	{
		$employees = RedBean::findAll('employees');
		echo $this->view->render('employee_index.html', array('employees' => $employees));

		return $response;
	}

	public function show($request, $response, $args)
	{
		$id = $request->getAttribute('id');
		$employee = RedBean::load('employees', $id);
		$department = RedBean::load('departments', $employee->departments_id);
		echo $this->view->render('employee_show.html', array('employee' => $employee, 'department' => $department));

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
		echo $this->view->render('employee_create.html');

		return $response;		
	}

	public function store(Request $request, Response $response, $args)
	{
		//var_dump($request);
		$data = $request->getParsedBody();
		
		$employee = RedBean::dispense('employees');
		$employee->fullname = $data['fullname'];
		$employee->birthday = $data['birthday'];
		$id = RedBean::store($employee);

		$department = RedBean::load('departments', $data['department_id']);
		$department->ownEmployeeList[] = $employee;
		RedBean::store($department);

		return header('Location: /employees');
	}

	public function delete($request, $response, $args)
	{
		
	}
}