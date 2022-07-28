<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    public static $valRules = [
        "name" => ["required", "min:3"],
        "position" => ["required"],
        "address" => ["required", "min:3"],
        "phonenumber" => ["required", "numeric"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "employees";

    protected $fillable = ["name", "position", "address", "phonenumber", "img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
