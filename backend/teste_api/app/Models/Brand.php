<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    const BRAND_ELETROLUX = 0;
    const BRAND_BRASTEMP = 1;
    const BRAND_FISCHER = 2;
    const BRAND_SAMSUNG = 3;
    const BRAND_LG = 4;

    const BRANDS = [
        self::BRAND_ELETROLUX => 'Electrolux',
        self::BRAND_BRASTEMP => 'Brastemp',
        self::BRAND_FISCHER => 'Fischer',
        self::BRAND_SAMSUNG => 'Samsung',
        self::BRAND_LG => 'LG',
    ];
}
