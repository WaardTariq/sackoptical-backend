<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'logo',
        'favicon',
        'social_links',
        'tax_settings',
        'currency_settings',
    ];

    protected $casts = [
        'social_links' => 'array',
        'tax_settings' => 'array',
        'currency_settings' => 'array',
    ];
}
