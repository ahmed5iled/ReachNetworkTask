<?php

namespace App\Console\Commands;

use App\Models\Ad;
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
        $advertisers = User::whereHas('ads', function ($query) {
            $query->whereDate('date', '=', Carbon::tomorrow()->format('Y-m-d'));
        })->get();

        if ($advertisers->count()) {
            Mail::send('emails.adsReminder', [], function ($message) use ($advertisers) {
                $message->to($advertisers->pluck('email'));
            });
        }

        return Command::SUCCESS;
    }
}
