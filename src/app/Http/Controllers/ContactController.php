<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $tel = implode('-', $request->tel);

        $contact = [
            'last_name'   => $request->last_name,
            'first_name'  => $request->first_name,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'tel'         => $tel,
            'address'     => $request->address,
            'building'    => $request->building,
            'detail'      => $request->detail,
            'category_id' => $request->category_id
        ];

        Contact::create($contact);
        return view('thanks');
    }

    public function admin()
{
    $contacts = Contact::with('category')->get();

    return view('admin', compact('contacts'));
}

}
