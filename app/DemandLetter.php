<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandLetter extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['company_id','date','demand_no','count','attached_files','comments','lock_status','status'];

    protected $casts = [
        'count' => 'array',
        'attached_files' => 'array',
        'comments' => 'array'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function nameList()
    {
        return $this->belongsToMany('App\NameList', 'demand_letter_name_lists', 'demand_letter_id','name_list_id')->withPivot('labour_card_no','issue_labour_date','identification_card','issue_date_of_id_card','salary');
    }
}
