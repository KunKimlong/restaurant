<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Authenticatable
{
    use HasFactory;
    public const ID = 'id';
    public const FISRT_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const GENDER = 'gender';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const PROFILE = 'profile';
    public const PHONE_NUMBER = 'phone_number';
    public const ADDRESS = 'address';
    public const POSITION_ID = 'position_id';
    public const SALARY = 'salary';
    public const JOIN_DATE = 'join_date';
    public const ROLE = 'role';
    public const BRANCH_ID = 'branch_id';
    public const DATE_OF_BIRTH = 'date_of_birth';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = 'staffs';
    protected $fillable = [
        self::FISRT_NAME,
        self::LAST_NAME,
        self::GENDER,
        self::EMAIL,
        self::PASSWORD,
        self::PROFILE,
        self::PHONE_NUMBER,
        self::ADDRESS,
        self::POSITION_ID,
        self::SALARY,
        self::JOIN_DATE,
        self::ROLE,
        self::BRANCH_ID,
        self::DATE_OF_BIRTH
    ];

    public function branch(){
        return $this->belongsTo(Branch::class,self::BRANCH_ID);
    }
    public function position(){
        return $this->belongsTo(position::class,self::POSITION_ID);
    }

    public function fullName(){
        $prefix = $this->gender == "Male"?"Mr. ": "Ms. ";
        return $prefix.$this->first_name." ".$this->last_name;
    }

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
