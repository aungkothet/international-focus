<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NameList extends Model
{
    protected $fillable = ['name_mm','name_eng','father_name_mm','father_name_eng','gender_mm','gender_eng','nrc_mm','nrc_eng','qualification','dob_mm','dob_eng','address_mm','address_eng','passport_no','issue_date_of_passport','photo'];

    public function demandLetter()
    {
        return $this->belongsToMany('App\DemandLetter', 'demand_letter_name_lists', 'demand_letter_id', 'name_list_id');
    }
}
