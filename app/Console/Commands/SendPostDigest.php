<?php

namespace App\Console\Commands;

use App\Mail\PostsDigest;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;


class SendPostDigest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post_digest:send
    {days_ago : Количество дней назад от момента запуска команды. Определяет начало периода выборки}
    {days : Длина периода в днях для выборки статей }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отсылает информацию об опубликованных статьях за указанный период';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $daysAgo = $this->argument('days_ago');
        $days = $this->argument('days');
        $startPeriodDate = (new Carbon())->subDays($daysAgo)->startOfDay();
        $endPeriodTime = (clone $startPeriodDate)->addDays($days)->endOfDay();

        $emails = User::pluck('email');

        $posts = Post::whereBetween('created_at', [$startPeriodDate, $endPeriodTime])
            ->where('published', true)
            ->latest()
            ->get();

        if ($posts->count() == 0) {
            $this->warn('Не найдено ни одной статьи за указанный период');
            return Command::SUCCESS;
        }

        foreach ($emails as $email) {
            \Mail::to($email)->send(new PostsDigest($posts));
        }
        $this->info('Рассылка отправлена на адреса: ' . $emails->implode(','));

        return Command::SUCCESS;
    }
}
