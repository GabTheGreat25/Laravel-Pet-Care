<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\consultations;
class Animal extends Model implements Searchable
{
    public static $valRules = [
        "petName" => ["required", "min:3"],
        "Age" => ["required", "numeric"],
        "Type" => ["required"],
        "Breed" => ["required"],
        "Sex" => ["required"],
        "Color" => ["required"],
        'img_path' => ['mimes:jpeg,png,jpg,gif,svg'],
    ];

    use HasFactory;

    protected $table = "animals";

    protected $fillable = [ "customer_id", "petName", "Age", "Type", "Breed", "Sex","Color","img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function consultations() 
    {
       return $this->belongsToMany('App\Models\consultations');
    }

     public function getSearchResult(): SearchResult
      {
         $url = route('getconsultation', $this->id);
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->petName,
            $url
               );
      }

}
