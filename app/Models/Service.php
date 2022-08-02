<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public static $valRules = [
        "servname" => ["required", "min:3"],
        "description" => ["required"],
        "price" => ["required", "numeric", "min:3"],
    ];

    use HasFactory;

    protected $table = "services";

    protected $fillable = ["servname", "description", "price", "img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
