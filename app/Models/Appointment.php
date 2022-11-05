<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['prescription_id','appointment_date','time','satisfaction_id', 'instituition_id',
    'appointment_type','symptoms','status','owner_id','owner_type','patient_id'];

    
 
}
