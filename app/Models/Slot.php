<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','owner_id','slot_date', 'time_slot','status', 'appointment_type','owner_type'];
}
