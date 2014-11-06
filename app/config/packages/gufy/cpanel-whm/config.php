<?php 
return [
	/*
	|--------------------------------------------------------------------------
	| Host of your server
	|--------------------------------------------------------------------------
	|
	| Please provide this by its full URL including its protocol and its port
	|
	*/
	'host'=>$_ENV['WHM_HOST'],

	/*
	|--------------------------------------------------------------------------
	| Remote Access key
	|--------------------------------------------------------------------------
	|
	| You can find this remote access key on your CPanel/WHM server. 
	| Log in to your server using root, and find `Remote Access Key`.
	| Copy and paste all of the string
	|
	*/
	'auth'=>$_ENV['WHM_HASH'],

	/*
	|--------------------------------------------------------------------------
	| Username
	|--------------------------------------------------------------------------
	|
	| By default, it will use root as its username. If you have another username,
	| make sure it has the same privelege with the root or at least it can access
	| External API which is provided by CPanel/WHM
	|
	*/
	'username'=>$_ENV['WHM_USERNAME'],

];