<?php

namespace App;

/**
 * CompanyBankAccount
 *
 * @property integer $id
 * @property string $bank
 * @property string $swift
 * @property string $account
 * @property string $iban
 * @property boolean $default
 * @property \App\Company $company
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo company()
 *
 * @package App
 */
class CompanyBankAccount extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'bank',
        'swift',
        'account',
        'iban',
        'default',
        'company_id',
    ];

    protected $appends = [

    ];

    protected $casts = [
        'default' => 'boolean',
    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'company' => \App\Company::class,
    ];

    protected $belongsToMany = [

    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [

    ];

    protected $hasMany = [

    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [

    ];

    protected $with = [

    ];

    protected $images = [

    ];

    protected $files = [

    ];

    /**
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->renderMediaView(
            $this->account,
            sprintf("%s / %s / %s", optional($this->company)->name ?? '—', $this->bank, $this->iban)
        );
    }
}
