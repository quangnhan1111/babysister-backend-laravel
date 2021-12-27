<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public $timestamps = false; //set time to false

    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'address',
        'date_of_birth',
        'password',
        'created_at',
        'updated_at',
        'type',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password',
//        'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = ['email_verified_at' => 'datetime'];


    public function getJWTIdentifier()
    {
        return $this->getKey();

    }//end getJWTIdentifier()


    public function getJWTCustomClaims()
    {
        return [];

    }//end getJWTCustomClaims()



//    public function isAdmin()
//    {
//
//        return $this->roles->contains('name','admin');
//    }
//
//
//    public function isOrganization()
//    {
//        return $this->roles->contains('name','organization');
//    }
//
//    public function isWriter()
//    {
//        return $this->roles->contains('name','writer');
//    }




}//end class
