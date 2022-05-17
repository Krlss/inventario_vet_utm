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

    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name',
        'last_name1',
        'last_name2',
        'email',
        'address',
        'password',
        'api_token',
        'phone',
        'email_verified_at',
        'id_parish',
        'id_canton',
        'id_province',
        'main_street',
        'street_1_sec',
        'street_2_sec',
        'address_ref'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public static $rules = [
        'user_id' => 'required|max:13|min:10|unique:users',
        'name' => 'required|max:75',
        'last_name1' => 'required|max:50',
        'last_name2' => 'required|max:50',
        'email' => 'required|max:100|unique:users',
        'address' => 'max:2500',
        'phone' => 'digits:10|unique:users',
        'id_province' => 'required'
    ];

    public static $rules_create_movil = [
        'user_id' => 'required|max:13|min:10|unique:users',
        'name' => 'required|max:75',
        'last_name1' => 'required|max:50',
        'last_name2' => 'required|max:50',
        'email' => 'required|max:100|unique:users',
        'phone' => 'digits:10|unique:users'
    ];

    public static $rules_updated = [
        'user_id' => 'required|max:13|min:10',
        'name' => 'required|max:75',
        'last_name1' => 'required|max:50',
        'last_name2' => 'required|max:50',
        'email' => 'required|max:100',
        'address' => 'max:2500',
        'phone' => 'digits:10',
        'id_province' => 'required'
    ];

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
}
