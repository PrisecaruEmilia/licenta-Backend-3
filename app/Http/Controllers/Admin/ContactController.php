<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function PostContactDetails(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        date_default_timezone_set('Europe/Bucharest');
        $contact_time = date('h:i:sa');
        $contact_date = date('d-m-Y');

        $result = Contact::insert([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'contact_time' => $contact_time,
            'contact_date' => $contact_date
        ]);

        return $result;
    }

    public function GetAllMessage()
    {

        $message = Contact::latest()->get();
        return view('backend.contact.contact_all', compact('message'));
    }

    public function DeleteMessage($id)
    {

        Contact::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Mesaj șters cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
