<?php

namespace App;

use App\Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * CustomerUser
 *
 * @property integer $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $comment
 * @property string $token
 * @property \Illuminate\Support\Collection|CustomerUserSubscribe[] $customerUserSubscribes
 * @property \Illuminate\Support\Collection|\App\Customer[] $customers
 * @property \Illuminate\Support\Collection|\App\AuthLog[] $authLogs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany customers()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerUserSubscribes()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany authLogs()
 * @package App
 */
class CustomerUser extends \Crmplease\MaterialAdmin\Foundation\Auth\User implements JWTSubject, HasLocalePreference
{
    use Notifiable;

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'name',
        'phone',
        'comment',
        'token',
    ];

    protected $appends = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'token',
    ];

    protected $belongsTo = [

    ];

    protected $belongsToMany = [
        'customers' => [\App\Customer::class, 'customer_user_customer'],
    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [

    ];

    protected $hasMany = [
        'customerUserSubscribes' => CustomerUserSubscribe::class,
    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [
        'authLogs' => [AuthLog::class, 'loggable']
    ];

    protected $with = [

    ];

    protected $images = [

    ];

    protected $files = [

    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getLastAuthLog()
    {
        return $this->authLogs->last();
    }
}
