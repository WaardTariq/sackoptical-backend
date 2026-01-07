<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'od_sph',
        'od_cyl',
        'od_axis',
        'os_sph',
        'os_cyl',
        'os_axis',
        'add',
        'pd',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
