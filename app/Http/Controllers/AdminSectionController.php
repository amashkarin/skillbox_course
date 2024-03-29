<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminSectionController extends Controller
{
    public function index()
    {
        $title = 'Административный раздел';
        $routes = [
            [
                'title' => 'Управление статьями',
                'url' => \route('admin.posts')
            ],
            [
                'title' => 'Управление новостями',
                'url' => \route('admin.news')
            ],
            [
                'title' => 'Управление отчетами',
                'url' => \route('admin.reports')
            ],
            [
                'title' => 'Обратная связь',
                'url' => \route('admin.feedback')
            ],
        ];
        return view('admin.index', compact('title', 'routes'));
    }
}
