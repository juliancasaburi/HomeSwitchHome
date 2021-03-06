<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Auction;

class NotifyAuctionStarted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auctions:notifyStarted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify auction started';

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
     * @return mixed
     */
    public function handle()
    {
        $pendingNotificationAuctions = Auction::whereNull('notificaciones_enviadas')->get();

        foreach ($pendingNotificationAuctions as $a) {
            $a->sendAuctionStartedNotifications();
        }
    }
}