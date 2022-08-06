<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class consultations extends Model implements Searchable
{

    use HasFactory;

    
    protected $table = "consultations"; 

    protected $primaryKey = "id";

    protected $guarded = ["id"]; 

    public static $valRules = [
       
        'employee_id' =>["required", "numeric"],
        'dateConsult' =>["required", "date"],
        'fees' =>["required", "numeric"],
        'comment' =>["required", "regex:/^[a-zA-Z\s]*$/'"],
    
    ];

    protected $fillable = ['employee_id','animal_id','dateConsult', 'fees', 'comment'];


    public function employee()
    {
         return $this->belongsTo(employee::class);
     }

     public function animal()
     {
          return $this->belongsTo(animal::class);
      }

    public function diseases_injuries()
	{
 		return $this->belongsToMany(diseases_injuries::class);
 	}
   
      public function getSearchResult(): SearchResult
      {
        $url = url('show-consultrecord/'.$this->id);
      
          return new \Spatie\Searchable\SearchResult(
             $this,
             $this->employee_id,
             $this->animal_id,
             $this->dateConsult,
             $this->fees,
             $this->comment,
             $url
             );
      }   
    }
