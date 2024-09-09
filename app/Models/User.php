<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\User\UserTermsAcceptedEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'surname',
        'email',
        'password',
        'phone',
        'profile',
        'terms_accepted',
    ];

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
        'terms_accepted' => UserTermsAcceptedEnum::class
    ];

    protected $appends = [
        'full_name'
    ];

    public function getProfileImageAttribute()
    {
        $firstName = mb_substr($this->name, 0, 1);
        $lastName = mb_substr($this->surname, 0, 1);

        return !is_null($this->profile) ? $this->profile : "https://ui-avatars.com/api/?name=$firstName+$lastName&background=random&color=fff";
    }

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->surname;
    }

}
