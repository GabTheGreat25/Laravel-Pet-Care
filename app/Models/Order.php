<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Animal;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Order extends Model 
//implements Searchable
{
    protected $table = 'service_orderinfo';
    protected $primaryKey = 'service_orderinfo_id';
    // public $timestamps = false;
    protected $fillable = ['customer_id','schedule','status'];
    public function customer() {
    return $this->belongsTo('App\Models\Customer');
    }
    public function items() {
    return $this->belongsToMany(Service::class,'service_orderline','service_orderinfo_id','service_id')->withPivot('animal_id');
    }

    public function pets() {
    return $this->belongsToMany(Animal::class,'service_orderline','service_orderinfo_id','animal_id')->withPivot('service_id');
    }

   //  public function getSearchResult(): SearchResult
   //  {
   //     $url = route('getcustomertransac', $this->id);
   //     return new \Spatie\Searchable\SearchResult(
   //        $this,
   //        $this->firstName,
   //        $this->lastName,
   //        $url
   //           );
   //  }
}
