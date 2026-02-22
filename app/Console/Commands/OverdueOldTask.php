<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class OverdueOldTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:overdue-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update overdue old tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $update = Task::where('due_date', '<', Carbon::today())
            ->where('status', 'aktif')
            ->update(['status' => 'expired']);

        \Log::info("$update task(s) ditandai expired.");
    }
}
