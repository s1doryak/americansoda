<?php

namespace App;


/**
 * AuthLog
 *
 * @property integer $id
 * @property \Illuminate\Support\Carbon|null $date
 * @property string $loggable_type
 * @property integer $loggable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \App\CustomerUser|null $loggable
 * @method \Illuminate\Database\Eloquent\Relations\MorphTo loggable()
 * @property string $user_agent
 * @property string $zendesk
 * @property string $version
 * @property string $sentry
 * @package App
 */
class AuthLog extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'loggable_type',
        'loggable_id',
        'user_agent',
        'zendesk',
        'version',
        'sentry',
    ];

    /**
     * @var array
     */
    protected $appends = [

    ];

    /**
     * @var array
     */
    protected $casts = [
        'loggable_id' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'date',
    ];

    /**
     * @var array
     */
    protected $images = [

    ];

    /**
     * @var array
     */
    protected $files = [

    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @var array
     */
    protected $belongsTo = [

    ];

    /**
     * @var array
     */
    protected $belongsToMany = [

    ];

    /**
     * @var array
     */
    protected $belongsToManyPivot = [

    ];

    /**
     * @var array
     */
    protected $belongsToManyPivotTimestamps = [

    ];

    /**
     * @var array
     */
    protected $hasOne = [

    ];

    /**
     * @var array
     */
    protected $hasMany = [

    ];

    /**
     * @var array
     */
    protected $hasManyThrough = [

    ];

    /**
     * @var array
     */
    protected $morphTo = [
        'loggable',
    ];

    /**
     * @var array
     */
    protected $morphOne = [

    ];

    /**
     * @var array
     */
    protected $morphMany = [

    ];

    /**
     * @var array
     */
    protected $morphToMany = [

    ];

    /**
     * @var array
     */
    protected $morphedByMany = [

    ];

    /**
     * @var array
     */
    protected $with = [

    ];

    /**
     * @var array
     */
    protected $touches = [

    ];

    public function renderHeadersWithIcons()
    {
        return $this->renderHeaderWithIcon('version') . PHP_EOL
            . $this->renderHeaderWithIcon('user_agent') . PHP_EOL
            . $this->renderHeaderWithIcon('zendesk', 'Zendesk') . PHP_EOL
            . $this->renderHeaderWithIcon('sentry', 'Sentry');
    }

    public function renderHeaderWithIcon($header, $title = null)
    {
        $color = $this->{$header} ? 'green' : 'gray';
        $title = $title ?: $this->{$header};

        return $this->renderIconView(
            $title,
            'circle',
            $color
        );
    }
}
