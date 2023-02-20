<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Language;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use LogsActivity;

    public function language()
    {
        return $this->hasOne(Language::class,'id','language_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logOnly(['id', 'firstname', 'lastname','role', 'phonenumber', 'email','language_id'])
            ->setDescriptionForEvent(fn(string $eventName) => "User has been {$eventName}");
    }
    protected static $logName = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phonenumber',
        'email',
        'password',
        'role',
        'language_id'
    ];
    public function getFullNameAttribute() // notice that the attribute name is in CamelCase.
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
