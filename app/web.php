<?php

namespace App;
use App\Core\Router;

Router::get('/', 'HomeController@index');
Router::get('/home', 'HomeController@index');
Router::get('/about', 'AboutController@index');

// ... other route definitions ... 
