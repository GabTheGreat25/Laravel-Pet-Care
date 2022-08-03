<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultations_disease_injuries extends Model
{
    use HasFactory;
    protected $table = 'consultations_disease_injuries';

    public $timestamps = false;
    
    protected $fillable = ['consultations_id','animals_id','disease_injuries_id'];

       public function diseases_injuries()
       {
            return $this->belongsToMany(diseases_injuries::class);
        }
    }
