<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'rechnungstermine';

    /**
    * Company Bill Relationships
    *
    */
    public function company() {
        return $this->belongsTo('Company', 'company_ID');
    }
}
