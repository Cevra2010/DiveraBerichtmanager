<?php

namespace App\Console\Commands;

use App\Models\PrinterJob;
use Illuminate\Console\Command;
use Zis\Ext\SettingsManager\Setting;

class PrinterJobsCommand extends Command
{
    protected $signature = 'do_printer_jobs';
    protected $description = 'Looking for printer Jobs';

    public function handle()
    {
        $job = PrinterJob::where('isDone',null)->first();
        if($job) {
            $file = \Storage::path($job->file);
            exec('lp -d "'.Setting::get('printer_name').'" '.$file);
            $job->delete();
        }
    }
}
