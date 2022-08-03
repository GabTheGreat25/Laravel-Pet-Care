<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class consultations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"]; 

    protected $fillable = ['employee_id','dateConsult', 'fees', 'comment'];

    protected $table = "consultations"; 

    protected $primaryKey = "id";

    protected $guarded = ["id"]; 

    public static $rules = [  
        'id' =>'required|numeric',
      
        'dateConsult'=>'required|date',
        'fees'=>'required|numeric',
        'comment'=>'required|regex:/^[a-zA-Z\s]*$/'
        
];
                    
    public static $messages = [
            'required' => 'This is a required field',
            'min' => 'Text is too small',
            'alpha' => 'Letters only',
            'numeric' => 'Number only',
           
        ];
}
