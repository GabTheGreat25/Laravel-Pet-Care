<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Animal;
class Order extends Model
{
    protected $table = 'service_orderinfo';
    protected $primaryKey = 'service_orderinfo_id';
    // public $timestamps = false;
    protected $fillable = ['customer_id','schedule','status'];
    public function customer() {
    return $this->belongsTo('App\Models\Customer');
    }
    public function items() {
    return $this->belongsToMany(Service::class,'service_orderline','service_orderinfo_id','service_id')->withPivot('animal_id');;
    }

    // public function tests() {
    // return $this->belongsToMany(Service::class,'service_orderline','service_orderinfo_id','animal_id');
    // }
}
