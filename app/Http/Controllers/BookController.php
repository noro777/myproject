<?php

namespace App\Http\Controllers;

use App\DTO\FilterBooksData;
use App\Interfaces\BookInterface;
use App\Models\Book;
use App\Service\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @param BookService $bookService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public  function books (BookService $bookService){
        $books = $bookService->getBooks();

        return view('books',compact('books'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function book($id){
        $booka = Book::query()->find($id);
        $books = Book::query()->latest()->paginate(3);

        return view('book',compact('books','booka'));
    }

    /**
     * @param Request $request
     * @param BookInterface $interface
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function books_search(Request $request,BookInterface $interface)
    {
        $data = new  FilterBooksData($request->all());

        $books = $interface->books_search($data);

        return view('books',compact('books'));
    }
}
