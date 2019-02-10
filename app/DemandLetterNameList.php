<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandLetterNameList extends Model
{
    protected $fillable = ['demand_letter_id','name_list_id','labour_card_no','issue_labour_date','identification_card','issue_date_of_id_card','salary','passport_status'];
    
    public function demandLetter()
    {
        return $this->belongsTo('App\DemandLetter');
    }
}
