<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        // Render the home page view
        require_once __DIR__ . '/../views/home/index.php';
    }
}
