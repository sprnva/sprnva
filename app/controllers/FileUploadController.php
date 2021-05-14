<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

class FileUploadController
{
    public function store()
    {
        if (Request::hasFile('avatar')) {
            $file_tmp = $_FILES['avatar']['tmp_name'];
            $filename = $_FILES['avatar']['name'];
            $folder = randChar(4) . '-' . date('Ymdhis');
            $temp_dir = "public/assets/uploads/tmp/";

            Request::storeAs($file_tmp, $temp_dir, $_FILES['avatar']['type'], $folder, $filename);

            echo $folder;
        }

        echo '';
    }
}
