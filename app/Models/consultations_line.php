<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultations_line extends Model
{
    use HasFactory;
    protected $table = 'consultations_line';

    protected $primaryKey = 'consultations_line_id';

    public $timestamps = false;
    
    protected $fillable = ['consultations_line_id','animal_id','disease_id','injury_id'];
}


