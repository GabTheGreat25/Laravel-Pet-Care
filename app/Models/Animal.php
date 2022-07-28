<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    public static $valRules = [
        "petName" => ["required", "min:3"],
        "Age" => ["required", "numeric"],
        "Type" => ["required"],
        "Breed" => ["required"],
        "Sex" => ["required"],
        "Color" => ["required"],

    ];

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "animals";

    protected $fillable = [ "customer_id", "petName", "Age", "Type", "Breed", "Sex","Color","img_path"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
