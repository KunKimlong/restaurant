<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'foods';
    public const ID = 'id';
    public const NAME = 'name';
    public const PRICE = 'price';
    public const TYPE = 'type';
    public const DISCOUNT = 'discount';
    public const IMAGE = 'image';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::NAME,
        self::PRICE,
        self::TYPE,
        self::DISCOUNT,
        self::IMAGE,
    ];
}
