<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name','owner_id','sub_status','sub_type','sub_date'
    ,'cc_no','cc_name','expiry','cvv'];
}
