<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Reservation;
use App\Auction;
use App\User;
use App\Bid;
use App\Notifications\ReservationObtained;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $auctionsToBeClosed = Auction::where('fin', '<=', Carbon::now())->get();
            foreach($auctionsToBeClosed as $a) {
                if (!DB::table('pujas')->where('subasta_id', $a->id)->get()->isEmpty()) {
                    $winnerBid = Bid::where('subasta_id', $a->id)->latest()->first();
                    $winnerUser = $winnerBid->user;
                    while ((($winnerUser->creditos == 0) || ($winnerUser->saldo < $winnerBid->monto)) && (DB::table('pujas')->where('subasta_id', $a->id)->where('id', '<>',$winnerBid->id)->get()->count() > 0)) {
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
        })->everyMinute();

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
