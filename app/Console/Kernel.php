<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Reservation;

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
            $auctionsToBeClosed = DB::table('subastas')->where('fin', '<=', Carbon::now())->get();
            foreach($auctionsToBeClosed as $a) {
                if (!DB::table('pujas')->where('subasta_id', $a->id)->get()->isEmpty()) {
                    $winnerBid = DB::table('pujas')->where('subasta_id', $a->id)->latest()->first();
                    $winnerUser = DB::table('usuarios')->where('usuario_id', $winnerBid->id)->first();
                    while (($winnerUser->saldo < $winnerBid->monto) && (DB::table('pujas')->where('subasta_id', $a->id)->get()->except($winnerBid->id)->count() > 0)) {
                        $winnerBid = DB::table('pujas')->where('subasta_id', $a->id)->except($winnerBid->id)->latest()->first();
                        $winnerUser = DB::table('usuarios')->where('usuario_id', $winnerBid->id)->first();
                    }
                    if ($winnerUser->saldo >= $winnerBid->monto) {
                        $reservation = new Reservation();
                        $reservation->usuario_id = $winnerUser->id;
                        $reservation->valor_reservado = $winnerBid->monto;
                        $reservation->fecha = Carbon::now();
                        $reservation->modo_reserva = 0;
                        $reservation->save();
                    }
                }
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
