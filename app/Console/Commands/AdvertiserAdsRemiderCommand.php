<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
use App\Models\Ad;
use App\Models\Advertiser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AdvertiserAdsRemiderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ads reminder';

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
        $ads = Ad::whereDate('start_date', '=', Carbon::tomorrow()->format('Y-m-d'))->get();

        if ($ads->count()) {
            foreach ($ads as $ad) {
                Mail::to($ad->advertiser->email)->send(new ReminderMail($ad));
            }
        }

        return Command::SUCCESS;
    }
}
