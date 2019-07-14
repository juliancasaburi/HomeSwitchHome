<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Hotsale;

class HotSalesClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotsales:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close HotSales';

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
        $hotsalesToBeClosed = HotSale::toBeClosed()->get();
        foreach ($hotsalesToBeClosed as $h) {
            $h->delete();
        }
    }
}