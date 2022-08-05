<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public static $valRules = [
        "name" => ["required", "min:3"],
        "position" => ["required"],
        "address" => ["required", "min:3"],
        "phonenumber" => ["required", "numeric"],
        'img_path' => ['mimes:jpeg,png,jpg,gif,svg'],
    ];

    public function user() {
        return $this->belongsTO('App\Models\User');
    }

    public function consultations() {
        return $this->belongsToMany('App\Models\consultations');
    }

    use HasFactory;

    protected $table = "employees";

    protected $fillable = ["name", "position", "address", "phonenumber", "img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
