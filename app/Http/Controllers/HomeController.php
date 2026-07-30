<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Laravel\Head\Facades\Head;

class HomeController
{
    public function __invoke(): View
    {
        Head::title('Home')
            ->description('Playful, opinionated starter kit for Laravel projects.');

        return view('pages.static.home');
    }
}
