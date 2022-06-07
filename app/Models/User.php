<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
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
        'address_ref',
        'profile_photo_path'
    ];

    /**
     * 
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];


    public static $rules = [
        'user_id' => 'required|digits_between:10,13|unique:users|numeric',
        'name' => 'required|max:75',
        'last_name1' => 'required|max:50',
        'last_name2' => 'required|max:50',
        'email' => 'required|max:100|unique:users|email',
        'address' => 'max:2500',
        'phone' => 'numeric|nullable|digits:10',
        'id_province' => 'required|numeric',
    ];

    public static $rules_create_movil = [
        'user_id' => 'required|digits_between:10,13|unique:users|numeric',
        'name' => 'required|max:75',
        'last_name1' => 'required|max:50',
        'last_name2' => 'required|max:50',
        'email' => 'required|max:100|unique:users|email',
        'phone' => 'numeric|nullable|digits:10',
    ];

    public static $rules_updated = [
        'user_id' => 'required|digits_between:10,13|numeric',
        'name' => 'required|max:75',
        'last_name1' => 'required|max:50',
        'last_name2' => 'required|max:50',
        'email' => 'required|max:100|email',
        'address' => 'max:2500',
        'phone' => 'digits:10|numeric|nullable',
        'id_province' => 'required|numeric',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->assignRole(config('role.auth.default'));
        });
    }
}
