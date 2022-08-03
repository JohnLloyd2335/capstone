<?php

namespace App\Models;

use App\Models\ImmunizationCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use HasFactory;

    public function immunization_category(){
        return $this->belongsTo(ImmunizationCategory::class);
    }

    protected $fillable = ['immunization_category_id','first_name','middle_name','last_name','date_of_birth','sex','place_of_birth','age','address','contact_no','father_full_name','mother_full_name','height','weight','vaccine_received','doses','doses_received','first_dose_schedule','second_dose_schedule','third_dose_schedule','remarks']; 
}
