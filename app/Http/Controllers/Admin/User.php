<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function  admin_user()
    {
        session()->put('users',ModelsUser::all());
        return redirect()->route('admin.users');
    }

    public function register_users(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed'
        ]);


        if ($validator->fails()) {
            return $validator->errors()->all();
        }

            $data1 = [
                'name' => $data['name'],
                'email' => $data['email'],
                // 'phone'=>$data['phone'],
                'password' => Hash::make($data['password']),
            ];

            ModelsUser::create($data1);
        return redirect()->route('admin.user');

    }

    public function update_users(Request $request)
    {
        $data = $request->all();

        $student = ModelsUser::find($data['id']);

        if($data['email'] != $student->email){
            $validator = Validator::make($data, [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|confirmed'
            ]);

            if ($validator->fails()) {
                return $validator->errors()->all();
            }
        }else{
            $validator = Validator::make($data, [
                'name'=>'required',
                'password'=>'required|confirmed'
            ]);

            if ($validator->fails()) {
                return $validator->errors()->all();
            }
        }

        $data1 = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        $student->update($data1);

        return redirect()->route('admin.user');

    }

    public function delete_users($id)
    {
        $student = ModelsUser::find($id);
        $student->delete();

        return redirect()->route('admin.user');

    }

    public function search(Request $req)
    {
        $request = $req->all()['search'];
        $users = ModelsUser::where('name','LIKE','%'.$request.'%')
        ->orWhere('email','LIKE','%'.$request.'%')
        ->get();
        session()->put('users',$users);

        return redirect()->route('admin.users');
    }

}
