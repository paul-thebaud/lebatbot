<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class IndexController extends AbstractController
{
    public function __invoke(): View
    {
        return view('index');
    }
}
