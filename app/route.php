<?php

$app->group('/departments', function(){
	$this->get('', '\App\Controllers\DepartmentController:index');
	$this->get('/create', '\App\Controllers\DepartmentController:create');
	$this->get('/{id}', '\App\Controllers\DepartmentController:show');
	$this->get('/{id}/edit', '\App\Controllers\DepartmentController:edit');
	$this->put('/{id}', '\App\Controllers\DepartmentController:update');
	$this->post('', '\App\Controllers\DepartmentController:store');
	$this->delete('/{id}', '\App\Controllers\DepartmentController:delete');
});

$app->group('/employees', function(){
	$this->get('', '\App\Controllers\EmployeeController:index');
	$this->get('/create', '\App\Controllers\EmployeeController:create');
	$this->get('/{id}', '\App\Controllers\EmployeeController:show');
	$this->get('/{id}/edit', '\App\Controllers\EmployeeController:edit');
	$this->put('/{id}', '\App\Controllers\EmployeeController:update');
	$this->post('', '\App\Controllers\EmployeeController:store');
	$this->delete('/{id}', '\App\Controllers\EmployeeController:delete');
});

$app->get('/', '\App\Controllers\HomeController:index');
$app->get('/reports', '\App\Controllers\HomeController:reports');
