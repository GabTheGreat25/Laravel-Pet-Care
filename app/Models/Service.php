<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    public static $valRules = [
        "servname" => ["required", "min:3"],
        "description" => ["required"],
        "price" => ["required", "numeric", "min:3"],
    ];

    use HasFactory;

    use SoftDeletes;

    public $searchableType = 'Service Searched';

    protected $dates = ["deleted_at"];

    protected $table = "services";

    protected $fillable = ["servname", "description", "price", "img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
