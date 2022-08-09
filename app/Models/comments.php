<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class comments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"]; 

    protected $fillable = ['service_id', 'guestName', 'gEmail', 'cellnum', 'gcomment'];

    protected $table = "comments"; 

    protected $primaryKey = "id";

    protected $guarded = ["id"]; 

    public static $valRules = [  
        'service_id' =>'required|numeric', 
            'guestName'=>'required|regex:/^[a-zA-Z\s]*$/',
            'gEmail'=>'email| required',
            'cellnum'=>'required|numeric',
            'gcomment'=>'required|regex:/^[a-zA-Z\s]*$/'
];
                      
    public static $messages = [
            'required' => 'This is a required field',
            'min' => 'Text is too small',
            'alpha' => 'Letters only',
            'numeric' => 'Number only',
           
        ];
}
