<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Service\CommentService;

class CommentController extends Controller
{
    public function store(CommentRequest $request,CommentService $service)
    {
        $data = $request->all();

        $service->store($data);

        return redirect()->back();
    }
}
