<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Reservation;
use App\Auction;
use App\Bid;
use App\Notifications\ReservationObtained;

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
        $auctionsToBeClosed = Auction::where('fin', '<=', Carbon::now())->get();
        foreach ($auctionsToBeClosed as $a) {
            if (!DB::table('pujas')->where('subasta_id', $a->id)->get()->isEmpty()) {
                $winnerBid = Bid::where('subasta_id', $a->id)->latest()->first();
                $winnerUser = $winnerBid->user;
                while ((($winnerUser->creditos == 0) || ($winnerUser->saldo < $winnerBid->monto)) && (DB::table('pujas')->where('subasta_id', $a->id)->where('id', '<>', $winnerBid->id)->get()->count() > 0)) {
                    $winnerBid = Bid::where('subasta_id', $a->id)->where('id', '<>', $winnerBid->id)->latest()->first();
                    $winnerUser = $winnerBid->user;
                }
                if (($winnerUser->creditos > 0) && ($winnerUser->saldo >= $winnerBid->monto)) {
                    $reservation = new Reservation();
                    $reservation->usuario_id = $winnerUser->id;
                    $reservation->valor_reservado = $winnerBid->monto;
                    $reservation->semana_id = $a->week->id;
                    $reservation->modo_reserva = 0;
                    $reservation->save();
                    $winnerUser->creditos -= 1;
                    $winnerUser->saldo -= $winnerBid->monto;
                    $winnerUser->save();
                    $winnerUser->notify(new ReservationObtained($a->week->property->nombre, $a->week->fecha));
                }
            }
            $a->delete();
            $a->week->delete();
        }
    }
}