<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    public const VALIDATION_RULES = [
        "servname" => ["required", "min:3"],
        "description" => ["required"],
        "price" => ["required", "numeric", "min:3"],
        "img_path" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "services";

    protected $fillable = ["servname", "description", "price", "img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
