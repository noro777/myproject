<?php

namespace App\Http\Controllers;

use App\DTO\FilterAuthorsData;
use App\Interfaces\AuthorInterface;
use App\Models\Author;
use App\Service\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * @param AuthorService $authorService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function authors(AuthorService $authorService){

        $authors = $authorService->getAuthors();

        return view('authors',compact('authors'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function author($id){
        $authora = Author::query()->find($id);
        $authors = Author::query()->latest()->paginate(3);

        return view('author',compact('authors','authora'));
    }

    /**
     * @param Request $request
     * @param AuthorInterface $interface
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function authors_search(Request $request,AuthorInterface $interface)
    {
        $data = new FilterAuthorsData($request->all());

        $authors = $interface->authors_search($data);

        return view('authors',compact('authors'));
    }
}
