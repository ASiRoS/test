<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SpaController
{
    public function index(): View
    {
        return view('index');
    }
}
