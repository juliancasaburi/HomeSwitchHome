<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerificarEmail;
use App\Notifications\ResetPassword;
use App\Notifications\EmailChanged;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activa', 'email', 'nombre', 'apellido', 'pais', 'DNI', 'fecha_nacimiento', 'creditos', 'saldo', 'password', 'numero_tarjeta', 'premium',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'usuarios';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* public function sendEmailVerificationNotification()
    {
        $this->notify(new Email);
    } */

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerificarEmail); // notificacion
    }

    /**
     * Send the email change notification.
     *
     * @return void
     */
    public function sendEmailChangedNotification()
    {
        $this->notify(new EmailChanged); // notificacion
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Accessor for Age.
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['fecha_nacimiento'])->age;
    }

    public function auctionInscriptions(){
        return $this->hasMany(InscriptionForFutureAuction::class, 'usuario_id', 'id');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class, 'usuario_id', 'id');
    }

    public function bids(){
        return $this->hasMany(Bid::class, 'usuario_id', 'id');
    }
}

