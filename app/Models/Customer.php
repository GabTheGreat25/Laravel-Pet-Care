<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Customer extends Model implements Searchable
{
    public static $valRules = [
        "title" => ["required", "min:2"],
        "firstName" => ["required", "min:3"],
        "lastName" => ["required", "min:3"],
        "age" => ["required", "numeric"],
        "address" => ["required", "min:3"],
        "sex" => ["required"],
        "phonenumber" => ["required", "numeric"],
        'img_path' => ['mimes:jpeg,png,jpg,gif,svg'],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "customers";

    protected $fillable = ['title', 'firstName', 'lastName', 'age', 'address', 'sex', 'phonenumber', 'img_path', 'created_at', 'updated_at','deleted_at'];

    protected $primaryKey = "id";

    protected $guarded = ["id"];


    public function animals() {
        return $this->hasMany('App\Models\Animal');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
    
    public function getSearchResult(): SearchResult
    {
       $url = route('getcustomertransac', $this->id);
       return new \Spatie\Searchable\SearchResult(
          $this,
          $this->firstName, 
          $url
             );
    }
}
