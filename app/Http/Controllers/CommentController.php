<?php

namespace App\Http\Controllers;

use App\Models\comment as ModelsComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'message'=>'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        if($request->has('book_id') ){
            ModelsComment::create([
                'name' => $data['name'],
                'message' =>$data['message'],
                'book_id' => $data['book_id'],
                ]);

        }else{
            ModelsComment::create([
                'name' => $data['name'],
                'message' =>$data['message'],
                'author_id' => $data['author_id'],
                ]);

        }




        return redirect()->back();
    }
}
