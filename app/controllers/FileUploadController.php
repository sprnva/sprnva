<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

class FileUploadController
{
    public function store()
    {
        // // $request = Request::validate('/');
        // if (Request::hasFile('avatar')) {
        //     die(var_dump(["has a file"]));
        // }

        // die(var_dump(Request::hasFile('avatar')));
        redirect('/profile')
    }
}
