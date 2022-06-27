<?php

namespace App\Console\Commands;

use App\Models\Bericht;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Zis\Ext\SettingsManager\Setting;

class AutodeleteBerichteCommand extends Command
{
    protected $signature = 'autodelete_berichte';

    protected $description = 'Löscht alle Bericht, die älter als 30 Tage sind.';

    public function handle()
    {
        if (Setting::get('bericht_autodelete'))
        {
            $today = Carbon::now();
            $beforThirtyDays = $today->subDays(30);
            $berichte = Bericht::where('created_at','<',$beforThirtyDays)->get();
            foreach($berichte as $bericht) {
                if(!$bericht->alarm->is_uebung) {
                    $bericht->alarm->delete();
                    $bericht->delete();
                }
            }
        }
        else
        {
            $this->info("Automatische Löschung ist deaktiviert.");
        }
    }
}
