<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateTotalReport;
use App\Service\TotalReportService;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $title = 'Управление отчетами';
        $routes = [
            [
                'title' => 'Отчет "Итого"',
                'url' => \route('admin.reports.total')
            ],
        ];
        return view('admin.index', compact('title', 'routes'));
    }


    public function showTotal(TotalReportService $totalReportService)
    {
        $title = 'Отчет "Итого"';
        $entities = $totalReportService->getEntitiesArray();
        return view('reports.total', compact('title', 'entities'));
    }

    public function createTotal(Request $request)
    {
        $data = $request->validate([
            'entities' => 'required'
        ]);

        $email = auth()->user()->email;
        GenerateTotalReport::dispatch($data['entities'], $email);
        \Session::flash('message', 'Отчет успешно сформирован и отправлен на email ' . $email);

        return back();
    }

}
