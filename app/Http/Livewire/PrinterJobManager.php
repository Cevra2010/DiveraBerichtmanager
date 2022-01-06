<?php

namespace App\Http\Livewire;

use App\Models\PrinterJob;
use App\Models\PrinterObject;
use Livewire\Component;

class PrinterJobManager extends Component
{
    public function render()
    {
        $jobs = PrinterJob::orderBy('isDone','DESC')->orderBy('created_at')->get();
        $files = PrinterObject::all();
        return view('livewire.printer-job-manager',[
            'jobs' => $jobs,
            'files' => $files,
        ]);
    }

    public function print(PrinterObject $object) {
        $printerJob = new PrinterJob();
        $printerJob->file = $object->filename;
        $printerJob->save();
    }

    public function abort(PrinterJob $job) {
        $job->delete();
    }
}
