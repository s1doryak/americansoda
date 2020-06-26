<?php

namespace App;

use App\Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Translation\HasLocalePreference;

/**
 * User
 *
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $avatar
 * @property \App\Role $role
 * @property \App\Company $company
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo role()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo company()
 *
 * @package App
 */
class User extends \Crmplease\MaterialAdmin\Foundation\Auth\User implements HasLocalePreference
{
    use Notifiable;

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'name',
        'phone',
        'avatar',
        'role_id',
        'company_id',
    ];

    protected $casts = [

    ];

    protected $dates = [
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $belongsTo = [
        'role' => \App\Role::class,
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
        'avatar',
    ];

    protected $files = [

    ];
}
