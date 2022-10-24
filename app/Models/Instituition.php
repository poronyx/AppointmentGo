<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituition extends Model
{
    use HasFactory;

    protected $fillable = ['instituition_type','instituition_name','instituition_addr', 'instituition_phone',
    'instituition_desc','location'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'location' => 'array',
    ];
}
