<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function books_search(Request $request)
    {
        $request = $request->all()['query'];
        $books = Book::where('name','LIKE','%'.$request.'%')
        ->orWhere('text','LIKE','%'.$request.'%')
        ->latest()
        ->get();
        session()->put('books',$books);

        return view('books');
    }
}
