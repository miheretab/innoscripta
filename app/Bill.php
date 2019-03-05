<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'rechnungstermine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'billNumber',
        'date',
        'company_ID'
    ];

    public $timestamps = false;

    /**
    * Company Bill Relationships
    *
    */
    public function company() {
        return $this->belongsTo('App\Company', 'company_ID');
    }

    public function getFormattedDateAttribute() {
        return date('d.m.Y', strtotime($this->date));
    }

    public function getFormattedAmountAttribute() {
        return number_format($this->amount, 2) . ' €';
    }

}
