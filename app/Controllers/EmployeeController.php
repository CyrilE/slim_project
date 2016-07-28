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
		$count = RedBean::count('employees', 'id = ?', [ $id ]);
		if ($count == 0){
			return $response->withStatus(404)->withHeader('Content-Type', 'text/html')->write('Page not found');
		}
		$employee = RedBean::load('employees', $id);
		$department = RedBean::load('departments', $employee->departments_id);
		echo $this->view->render('employee_show.html', array('employee' => $employee, 'department' => $department));

		return $response;
	}
	
	public function edit($request, $response, $args)
	{
		$id = $request->getAttribute('id');
		$employee = RedBean::load('employees', $id);
		$departments = RedBean::getAll('select *, '. $employee->departments_id .' as employee_department from departments');
		echo $this->view->render('employee_edit.html', array('employee' => $employee, 'departments' => $departments));

		return $response;
	}

	public function update($request, $response, $args)
	{
		$data = $request->getParsedBody();
		$employee = RedBean::load('employees', $request->getAttribute('id'));
		$employee->fullname = $data['fullname'];
		$employee->birthday = $data['birthday'];
		$employee->departments_id = $data['department'];
		RedBean::store($employee);

		return $response;
	}

	public function create($request, $response, $args)
	{
		$departments = RedBean::findAll('departments');
		echo $this->view->render('employee_create.html', array('departments' => $departments));

		return $response;		
	}

	public function store(Request $request, Response $response, $args)
	{
		$data = $request->getParsedBody();
		
		$employee = RedBean::dispense('employees');
		$employee->fullname = $data['fullname'];
		$employee->birthday = $data['birthday'];
		$id = RedBean::store($employee);

		$department = RedBean::load('departments', $data['department']);
		$department->ownEmployeeList[] = $employee;
		RedBean::store($department);

		return $response;
	}

	public function delete($request, $response, $args)
	{
		$id = $request->getAttribute('id');
		$employee = RedBean::load('employees', $id);
		RedBean::trash($employee);

		return $response;
	}
}