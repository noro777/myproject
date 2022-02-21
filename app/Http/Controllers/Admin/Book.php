<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book as ModelsBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class Book extends Controller
{
    public function  admin_book()
    {
        session()->put('books',ModelsBook::all());
        return redirect()->route('admin.books');
    }

    public function  admin_book_create_view()
    {
        session()->put('users',Author::all());
        return redirect()->route('admin.book.create');
    }

    public function  admin_book_update_view($id)
    {
        session()->put('users',Author::all());
        return view('admin.book.book_update',compact('id'));
    }

    public function create_books(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name'=>'required',
            'image'=>'required',
            'text'=>'required',
            'file'=>'required',
            // 'author_id'=>'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $image      = $request->file('image');
        $imageName   = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/books',$imageName);

        $fileName = time().'.'.$request->file->extension();
        $request->file->move('files/books', $fileName);

        $data1 = [
            'name' => $data['name'],
            'image' =>$imageName,
            'text' => $data['text'],
            'file' => $fileName,
            'author_id' => $data['author_id']
        ];

        ModelsBook::create($data1);
        return redirect()->route('admin.book');


    }

    public function update_books(Request $request)
    {
        $data = $request->all();

        $book = ModelsBook::find($data['id']);

        $validator = Validator::make($data, [
            'name'=>'required',
            'image'=>'required',
            'text'=>'required',
            'file'=>'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        if (File::exists(public_path('images/books/'.$book->image))) {
            File::delete(public_path('images/books/'.$book->image));
        }

        if (File::exists(public_path('files/books/'.$book->file))) {
            File::delete(public_path('files/books/'.$book->file));
        }


        $image      = $request->file('image');
        $imageName   = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/books',$imageName);

        $fileName = time().'.'.$request->file->extension();
        $request->file->move('files/books', $fileName);


        $data1 = [
            'name' => $data['name'],
            'image' =>$imageName,
            'text' => $data['text'],
            'file' => $fileName,
            'author_id' => $data['author_id']
        ];

        $book->update($data1);

        return redirect()->route('admin.book');

    }

    public function delete_books($id)
    {
        $book = ModelsBook::find($id);

        if (File::exists(public_path('images/books/'.$book->image))) {
            File::delete(public_path('images/books/'.$book->image));
        }

        if (File::exists(public_path('files/books/'.$book->file))) {
            File::delete(public_path('files/books/'.$book->file));
        }


        $book->delete();

        return redirect()->route('admin.book');

    }

    public function search(Request $req)
    {
        $request = $req->all()['search'];
        $books = ModelsBook::where('name','LIKE','%'.$request.'%')
        ->orWhere('text','LIKE','%'.$request.'%')
        ->get();
        session()->put('books',$books);

        return redirect()->route('admin.books');
    }
}
