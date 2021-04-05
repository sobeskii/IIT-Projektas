<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    /**
     * Get the rating record associated with the user.
    */
    public function ratings() {   return $this->hasMany('App\Models\Rating');  }
    /**
     * Get count of ratings of a user
    */
    public function getRatingCount()  { return $this->ratings()->whereUserId($this->id)->count(); }
    /**
     * Get rating of rated release
    */
    public function getReleaseRating($release)  {   return $this->ratings()->firstWhere( 'release_id', $release );  }
    /**
     * Check if user has rated specific release
    */
    public function isReleaseRated( $release )  {  return (  $this->ratings()->firstWhere( 'release_id', $release ) != null ) ? true : false; }
}
