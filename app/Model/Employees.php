<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model {
    
    protected $table = "employees";
    
    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone'
    ];
    
    function company () {
        return $this->belongsTo('App\Model\Companies', 'company_id');
    }
}
