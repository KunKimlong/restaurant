<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const NAME = 'name';
    public const CREATE_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public $timestamps = false;

    protected $fillable = [
        self::NAME,
    ];
}
