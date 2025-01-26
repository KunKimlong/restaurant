<?php

namespace App\Models;

use Hamcrest\SelfDescribing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public const ID = 'id';
    public const FISRT_NAME = 'fisrt_name';
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
}
