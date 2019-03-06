<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'firmen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'funding',
        'fee',
        'country',
        'state',
        'city',
        'street',
        'code',
        'referenceNr'
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($company) {
             $company->bills()->get()->each->delete();
        });
    }

    /**
    * Company Bill Relationships
    *
    */
    public function bills() {
        return $this->hasMany('App\Bill', 'company_ID');
    }

    public function getFormattedAmountAttribute() {
        return number_format($this->funding, 2) . ' €';
    }


    public function getFormattedFeeAttribute() {
        return number_format($this->fee, 2) . '%';
    }
}
