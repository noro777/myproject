<?php

namespace App\Http\Controllers;

use App\DTO\GetContactData;
use App\Http\Requests\ContactRequest;
use App\Interfaces\ContactInterface;

class ContactController extends Controller
{
    public  function index(){
        return view('contact');
    }

    public function store(ContactRequest $request,ContactInterface $interface)
    {
        $data = new GetContactData($request->all());

        $interface->send($request->all());

        $interface->store($data);

        return redirect()->back();

    }
}
