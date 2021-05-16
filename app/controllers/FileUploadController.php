<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Filesystem;
use App\Core\Request;

class FileUploadController
{
    public function store()
    {
        if (Request::hasFile('avatar')) {
            $file_tmp = $_FILES['avatar']['tmp_name'];
            $filename = $_FILES['avatar']['name'];
            $folder = uniqid() . '-' . date('Ymdhis');
            $temp_dir = "public/assets/uploads/tmp/";

            Request::storeAs($file_tmp, $temp_dir, $_FILES['avatar']['type'], $folder, $filename);

            echo $folder;
        }

        echo '';
    }

    public function delete()
    {
        $file = new Filesystem;
        $payload = Filesystem::get('php://input');
        if ($file->deleteDirectory("public/assets/uploads/tmp/" . $payload)) {
            die("deleted");
        }
    }
}
