<?php


namespace App\Service;


use App\Models\comment as ModelsComment;

class CommentService
{
    public function store(array $request){
        if(isset($request['book_id'])){
            ModelsComment::create([
                'name' => $request['name'],
                'message' =>$request['message'],
                'book_id' => $request['book_id'],
            ]);

        }else{
            ModelsComment::create([
                'name' => $request['name'],
                'message' =>$request['message'],
                'author_id' => $request['author_id'],
            ]);

        }
    }

}
