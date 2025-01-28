<?php
	require './vendor/autoload.php';

	use App\Router;
	use App\Controllers\User;

	$routes = [
		'user/:id' => User::class,
	];

	new Router($routes);