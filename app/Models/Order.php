<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'service_orderinfo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['customer_id','schedule','status'];
    public function customer() {
    return $this->belongsTo('App\Models\Customer');
    }
    public function items() {
    return $this->belongsToMany(Item::class,'service_orderline','id','service_id')->withPivot('quantity');
    }
}
