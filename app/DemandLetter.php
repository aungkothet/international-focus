<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandLetter extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['company_id','date','demand_no','male_count','female_count','total','demand_attached_files','comments','lock_status','summary_attached_files'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function nameList()
    {
        return $this->belongsToMany('App\NameList', 'demand_letter_name_lists', 'demand_letter_id','name_list_id');
    }
}
