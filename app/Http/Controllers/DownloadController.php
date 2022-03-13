<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function __invoke($filename){
        $file_path = public_path() .'/files/books/'. $filename;
        if (file_exists($file_path))
        {
            return response()->download($file_path, $filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit(__('file1'));
        }
    }
}
