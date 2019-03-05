<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'firmen';

    /**
    * Company Bill Relationships
    *
    */
    public function bills() {
        return $this->hasMany('Bill', 'company_ID');
    }
}
