<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Auction;

class AuctionsClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auctions:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close Auctions';

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
        // TODO Refactor
        $auctionsToBeClosed = Auction::toBeClosed()->get();
        foreach ($auctionsToBeClosed as $a) {
            $a->close();
        }
    }
}