<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'companies';
    public const ID = 'id';
    public const NAME = 'name';
    public const LOGO = 'logo';
    public const ADDRESS = 'address';

    protected $fillable = [
        self::NAME,
        self::LOGO,
        self::ADDRESS,
    ];
}
