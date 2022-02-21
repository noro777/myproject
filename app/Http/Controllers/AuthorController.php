<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function authors_search(Request $request)
    {
        $request = $request->all()['query'];
        $authors = Author::where('name','LIKE','%'.$request.'%')
        ->orWhere('text','LIKE','%'.$request.'%')
        ->latest()
        ->get();
        session()->put('authors',$authors);

        return view('authors');
    }
}
