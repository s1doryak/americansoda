<?php namespace Crmplease\MaterialAdmin\DataTables\Html;

use Illuminate\Support\Fluent;

/**
 * Class FilterColumn
 */
class FilterColumn extends Fluent
{
    /**
     * Column constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $attributes['name'] = isset($attributes['name']) ? $attributes['name'] : '';
        $attributes['data'] = isset($attributes['data']) ? $attributes['data'] : '';
        $attributes['type'] = isset($attributes['type']) ? $attributes['type'] : 'text';
        $attributes['value'] = isset($attributes['value']) ? $attributes['value'] : null;
        $attributes['default'] = isset($attributes['default']) ? $attributes['default'] : null;
        $attributes['multiple'] = isset($attributes['multiple']) ? $attributes['multiple'] : false;
        $attributes['operator'] = isset($attributes['operator']) ? $attributes['operator'] : null;
        $attributes['template'] = isset($attributes['template']) ? $attributes['template'] : null;

        // Allow methods override attribute value
        foreach ($attributes as $attribute => $value) {
            $method = 'parse' . ucfirst(strtolower($attribute));
            if (method_exists($this, $method)) {
                $attributes[$attribute] = $this->$method($value);
            }
        }

        parent::__construct($attributes);
    }
}
