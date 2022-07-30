<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VaccineCategory;

class Vaccine extends Model
{
    use HasFactory;

    public function vaccine_category(){
        return $this->belongsTo(VaccineCategory::class);
    }

    protected $fillable = ['vaccine_category_id','vaccine_name','doses','manufactured_date','expiration_date','description'];
}
