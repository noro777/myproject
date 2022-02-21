<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }


        $data1 = [
            'name' => $data['name'],
            'email' =>$data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ];
        // dd($data1);


        Mail::send('email',$data1, function ($m) use ($request) {
            $m->from('armpage66@gmail.com', 'Հայերեն Գրքեր');

            $m->to($request->email, $request->name)->subject('Հաղորդագրության Հաստատում');
        });

        Contact::create($data1);
        session()->flash('status', 'Հաղորդագրությունն ուղարկվեց');
        return redirect()->back();

    }
}
