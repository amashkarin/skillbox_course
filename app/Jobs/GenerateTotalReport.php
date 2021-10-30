<?php

namespace App\Jobs;

use App\Mail\ToatalReport;
use App\Models\Model;
use App\Service\TotalReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\ClassString;

class GenerateTotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $entities;
    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($entities, $email)
    {
        $this->entities = $entities;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TotalReportService $totalReportService)
    {
        $arReportData = [];

        foreach ($this->entities as $entityKey) {
            $modelClass = $totalReportService->getModel($entityKey);
            if (is_null($modelClass)) {
                throw new \Exception('Model class dosen`t found by key "' . $entityKey . '"');
            }

            $arReportData[] = [
                'title' => $totalReportService->getReportTitle($entityKey),
                'value' =>  $modelClass::count(),
            ];
        }

        \Mail::to($this->email)->send(new ToatalReport($arReportData));
    }
}
