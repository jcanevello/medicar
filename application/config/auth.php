<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(

	'driver'       => 'File',
	'hash_method'  => 'sha256',
	'hash_key'     => sha1(md5('$Proyecto$Medicar$2016$')).sha1(md5('$Canevello$Salazar$2016$')),
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		 'admin' => 'b3154acf3a344170077d11bdb5fff31532f679a1919e716a02',
	),

);