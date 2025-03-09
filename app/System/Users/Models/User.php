<?php

namespace App\System\Users\Models;

//use App\System\Support\Database\Traits\UserTracking;
use App\System\Users\Factories\UserFactory;
use App\System\Users\Notifications\WelcomeNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Relations\HasPasswordHistory,
        Traits\CanResetPassword,
        Traits\MustVerifyEmail,
        HasFactory, Notifiable, SoftDeletes;//, UserTracking;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /**
     *  The attributes that are mass assignable.
     *
     *  @var list<string>
     */
    protected $fillable = [
        'email',
        'locale',
        'name',
        'password',
        'username',
    ];

    /**
     *  The attributes that should be hidden for serialization.
     *
     *  @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     *  Get the attributes that should be cast.
     *
     *  @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'is_hidden' => 'boolean',
            'is_protected' => 'boolean',
            'password' => 'hashed',
        ];
    }

    /**
     *  Create a new factory instance for the model.
     *
     *  @return \Illuminate\Database\Eloquent\Factories\Factory
     *  @static
     */
    protected static function newFactory()
    {
        return new UserFactory;
    }

    /**
     *  Send the welcome notification.
     *
     *  @return void
     */
    public function sendWelcomeNotification()
    {
        if (config('enraiged.auth.send_welcome_notification') === true) {
            // $this->notify(
            //     (new \App\System\Users\Notifications\WelcomeNotification)
            //         ->locale($this->locale)
            //         ->onQueue('notifications')
            // );

            $this->notify(
                (new WelcomeNotification)->locale($this->locale)
            );
        }
    }
}
