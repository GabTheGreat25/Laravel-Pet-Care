<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class consultations extends Model
{
    use HasFactory;

    public static $valRules = [
       
        'employee_id' =>["required", "numeric"],
        'dateConsult' =>["required", "date"],
        'fees' =>["required", "numeric"],
        'comment' =>["required", "regex:/^[a-zA-Z\s]*$/'"],
    
    ];

    protected $fillable = ['employee_id','dateConsult', 'fees', 'comment'];

    protected $table = "consultations"; 

    protected $primaryKey = "id";

    protected $guarded = ["id"]; 

      public function diseases_injuries()
	{
 		return $this->belongsToMany(diseases_injuries::class);
 	}
   
     public function employee()
     {
          return $this->belongsToMany(employee::class);
      }
}
