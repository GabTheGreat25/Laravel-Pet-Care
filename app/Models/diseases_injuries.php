<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class diseases_injuries extends Model 
//implements Searchable
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

   //  public function getSearchResult(): SearchResult
   //  {
   //     $url = route('getconsultation', $this->id);
   //     return new \Spatie\Searchable\SearchResult(
   //        $this,
   //        $this->title,
   //        $url
   //           );
   //  }
}
