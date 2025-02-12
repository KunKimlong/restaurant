<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public const ID = 'id';
    public const NUMBER = 'number';
    public const STREET = 'street';
    public const VILLAGE = 'village';
    public const COMMUNE = 'commune';
    public const DISTRICT = 'district';
    public const PROVINCE = 'province';
    public const IMAGE = 'image';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::NUMBER,
        self::STREET,
        self::VILLAGE,
        self::COMMUNE,
        self::DISTRICT,
        self::PROVINCE,
        self::IMAGE
    ];

    private $provinces = [
        "Phnom Penh",
        "Banteay Meanchey",
        "Battambang",
        "Kampong Cham",
        "Kampong Chhnang",
        "Kampong Speu",
        "Kampong Thom",
        "Kampot",
        "Kandal",
        "Kep",
        "Koh Kong",
        "Kratie",
        "Mondulkiri",
        "Oddar Meanchey",
        "Pailin",
        "Preah Sihanouk",
        "Preah Vihear",
        "Prey Veng",
        "Pursat",
        "Ratanakiri",
        "Siem Reap",
        "Stung Treng",
        "Svay Rieng",
        "Takeo",
        "Tboung Khmum"
    ];

    public function getAllProvinces(){
        return $this->provinces;
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class, self::ID);
    }

}
