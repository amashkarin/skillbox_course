<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Service\ModelCacheService;


class FeedbackController extends Controller
{

    public function index(ModelCacheService $modelCacheService)
    {
        $title = 'Результаты заполнения формы контактов';
        $sortField = 'created_at';
        $sortDirection = 'desc';
        $model = new Feedback();
        $results = \Cache::tags($modelCacheService->getListCacheTag($model))->rememberForever($modelCacheService->getListCacheKey($model, [$sortField, $sortDirection]), function () {
            return Feedback::latest()->get();
        });

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
