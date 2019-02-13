<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandLetter extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['contract_attached_files','contract_comments','company_id','date','demand_no','male_count','female_count','total','demand_attached_files','comments','lock_status','passport_attached_files','passport_comments','summary_attached_files','summary_comments'];

    protected $casts = [
        'demand_attached_files' => 'array',
        'summary_attached_files' => 'array',
        'passport_attached_files' => 'array',
        'contract_attached_files' => 'array'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function nameList()
    {
        return $this->belongsToMany('App\NameList', 'demand_letter_name_lists', 'demand_letter_id','name_list_id')->withPivot('labour_card_no','issue_labour_date','identification_card','issue_date_of_id_card','salary','passport_status','contract_status');
    }
}
