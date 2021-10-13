<?php

namespace App\Http\Controllers;

use App\Models\Feedback;


class FeedbackController extends Controller
{

    public function index()
    {
        $title = 'Результаты заполнения формы контатов';
        $results = Feedback::latest()->get();
        return view('contacts.index', compact('title', 'results'));
    }

    public function create()
    {
        $title = 'Контакты';
        return view('contacts.create', compact('title'));
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => 'required',
            'message' => 'required',
        ]);

        Feedback::create(request()->all());

        return redirect('/contacts');
    }
}
