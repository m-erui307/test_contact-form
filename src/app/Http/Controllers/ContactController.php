<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $category = Category::find($contact['category_id']);
        $contact['category_content'] = $category->content;

        session(['contact_input' => $contact]);

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

        session()->forget('contact_input');
        return view('thanks');
    }

    public function admin()
    {
    $contacts = Contact::with('category')->paginate(7);
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
    $keyword     = $request->input('keyword');
    $gender      = $request->input('gender');
    $category_id = $request->input('category_id');
    $date        = $request->input('date');

    $contacts = Contact::query()
        ->keywordSearch($keyword)
        ->genderSearch($gender)
        ->categorySearch($category_id)
        ->dateSearch($date)
        ->with('category')
        ->paginate(7)
        ->appends($request->query());

    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
    Contact::findOrFail($id)->delete();

    return redirect('/admin');
    }

}
