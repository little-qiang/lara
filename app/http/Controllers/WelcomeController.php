<?php
namespace App\Http\Controllers;

use Illuminate\Container\Container;
use App\Models\Student;

class WelcomeController
{
	public function index()
	{
		$student = Student::first();
		$data = $student->getAttributes();
		$app = Container::getInstance();
		$factory = $app->make('view');
		return $factory->make('welcome')->with('data', $data);
		// return sprintf('学生id=%s; 学生name=%s; 学生age=%s', $data['id'], $data['name'], $data['age']);
		// return '<h1>控制器成功！！！</h1>';
	}
}