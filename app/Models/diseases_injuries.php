<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diseases_injuries extends Model
{
    use HasFactory;
    protected $table = "diseases_injuries"; 

    protected $primaryKey = "id";

    protected $guarded = ["id"]; 

    protected $fillable=['title','description'];

    public function consultations() 
	 {
	 	return $this->belongsToMany('App\Models\consultations');
	 }

     public function animals() {
        return $this->belongsTo('App\Models\animal');
   }
}
