<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Service extends Model
{
    public static $valRules = [
        "servname" => ["required", "min:3"],
        "description" => ["required"],
        "price" => ["required", "numeric", "min:3"],
        'img_path' => ['mimes:jpeg,png,jpg,gif,svg'],
    ];

    use HasFactory;

    protected $table = "services";

    protected $fillable = ["servname", "description", "price", "img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    public function orders() {
     return $this->belongsToMany(Order::class,'service_orderline','service_orderinfo_id','service_id')->withPivot('animal_id');
    }
}
