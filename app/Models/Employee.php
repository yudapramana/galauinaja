<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model 
{

    protected $table = 'employees';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];
    

    public function work_unit()
    {
        return $this->belongsTo('App\Models\WorkUnit', 'id_work_unit', 'id');
    }

    public function workUnit()
    {
        return $this->belongsTo(WorkUnit::class, 'id_work_unit', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_employee');
    }

}