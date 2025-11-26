<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'select', 'content']);

        return view('confirm', compact('contact'));
    }

    public function store()
    {
      $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'select', 'content']);
    }

}
