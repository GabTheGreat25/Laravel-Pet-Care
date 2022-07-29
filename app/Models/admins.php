<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class admins extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "admins"; 

    protected $primaryKey = "id";

    protected $guarded = ["id"]; 

    protected $dates = ["deleted_at"]; 

    protected $fillable = [
        'user_id',
        'name',
        'job',
        'address',
        'phonenumber'
    ];

    public function users() {
        return $this->hasMany('App\Models\User','user_id');
    }
    
    public static $rules = [  
                 
                    'name'=>'required|regex:/^[a-zA-Z\s]*$/',
                    'age'=>'required|numeric',
                    'address'=>'required|regex:/^[a-zA-Z\s]*$/',
                    'job'=>'required|regex:/^[a-zA-Z\s]*$/',
                    'phoneNumber'=>'required|numeric',
                    'img_path' => 'mimes:jpeg,png,jpg,gif,svg'
];
                    
    public static $messages = [
            'required' => 'This is a required field',
            'min' => 'Text is too small',
            'alpha' => 'Letters only',
            'numeric' => 'Number only',
           
        ];
}
