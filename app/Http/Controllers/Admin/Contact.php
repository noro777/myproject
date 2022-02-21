<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact as ModelsContact;
use Illuminate\Http\Request;

class Contact extends Controller
{
    public function admin_contact()
    {
        session()->put('contacts',ModelsContact::latest()->get());
        return redirect()->route('admin.contacts');
    }

    public function contact_search(Request $request)
    {
        $request = $request->all()['search'];
        $contacts = ModelsContact::where('name','LIKE','%'.$request.'%')
        ->orWhere('email','LIKE','%'.$request.'%')
        ->orWhere('subject','LIKE','%'.$request.'%')
        ->get();
        session()->put('contacts',$contacts);

        return redirect()->route('admin.contacts');

    }
    public function contact_delete($id)
    {
        $contact = ModelsContact::find($id);

        $contact->delete();

        return redirect()->route('admin.contact');

    }
}
