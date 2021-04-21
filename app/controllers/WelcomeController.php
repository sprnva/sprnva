<?php

namespace App\Controllers;

class WelcomeController
{
    protected $pageTitle;

    public function home()
    {
        $pageTitle = "Home";

        return view('/home', compact('pageTitle'));
    }
}
