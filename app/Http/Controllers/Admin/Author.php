<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author as ModelsAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Author extends Controller
{
    public function  admin_author()
    {
        session()->put('authors',ModelsAuthor::all());
        return redirect()->route('admin.authors');
    }


    public function create_authors(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'=>'required',
            'image'=>'required',
            'text'=>'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $image      = $request->file('image');
        $imageName   = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/authors',$imageName);

        $data1 = [
            'name' => $data['name'],
            'image' =>$imageName,
            'text' => $data['text'],
        ];

        ModelsAuthor::create($data1);
        return redirect()->route('admin.author');
    }

    public function update_authors(Request $request)
    {
        $data = $request->all();

        $author = ModelsAuthor::find($data['id']);

        $validator = Validator::make($data, [
            'name'=>'required',
            'image'=>'required',
            'text'=>'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        if (File::exists(public_path('images/authors/'.$author->image))) {
            File::delete(public_path('images/authors/'.$author->image));
        }


        $image      = $request->file('image');
        $imageName   = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/authors',$imageName);


        $data1 = [
            'name' => $data['name'],
            'image' =>$imageName,
            'text' => $data['text'],
        ];
        $author->update($data1);

        return redirect()->route('admin.author');

    }

    public function delete_authors($id)
    {
        $author = Modelsauthor::find($id);

        if (File::exists(public_path('images/authors/'.$author->image))) {
            File::delete(public_path('images/authors/'.$author->image));
        }


        $author->delete();

        return redirect()->route('admin.author');

    }

    public function search(Request $req)
    {
        // dd($req->all());
        $request = $req->all()['search'];
        $authors = ModelsAuthor::where('name','LIKE','%'.$request.'%')
        ->orWhere('text','LIKE','%'.$request.'%')
        ->get();
        session()->put('authors',$authors);

        return redirect()->route('admin.authors');
    }
}
