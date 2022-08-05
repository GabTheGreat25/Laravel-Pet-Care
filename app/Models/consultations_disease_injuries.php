<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class consultations_disease_injuries extends Model implements Searchable
{
    use HasFactory;
    protected $table = 'consultations_diseases_injuries';

    public $timestamps = false;
    
    protected $fillable = ['consultations_id','animals_id','diseases_injuries_id'];

       public function diseases_injuries()
       {
            return $this->belongsToMany(diseases_injuries::class);
        }
       
         public function employee()
         {
              return $this->belongsTo(employee::class);
          }
    
          public function animal()
         {
              return $this->belongsToMany(animal::class);
          }

          public function consultation()
          {
               return $this->belongsToMany(consultations::class);
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
