<?php

$app->group('/company/departments', function(){
	$this->get('', '\App\Controllers\DepartmentController:index');
	$this->get('/create', '\App\Controllers\DepartmentController:create');
	$this->get('/{id}', '\App\Controllers\DepartmentController:show');
	$this->get('/{id}/edit', '\App\Controllers\DepartmentController:edit');
	$this->put('/{id}', '\App\Controllers\DepartmentController:update');
	$this->post('', '\App\Controllers\DepartmentController:store');
	$this->delete('/{id}', '\App\Controllers\DepartmentController:delete');
});
