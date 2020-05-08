<?php

namespace Crmplease\MaterialAdmin\Forms\Extensions;

use Illuminate\Support\Arr;

/**
 * Extended form builder.
 *
 * @package Crmplease\MaterialAdmin\Extensions
 */
class FormBuilder extends \Kris\LaravelFormBuilder\FormBuilder
{
    /**
     * Set depedencies and options on existing form instance
     *
     * @param \Crmplease\MaterialAdmin\Forms\Form $instance
     * @param array $options
     * @param array $data
     * @return \Crmplease\MaterialAdmin\Forms\Form
     */
    public function setDependenciesAndOptions($instance, array $options = [], array $data = [])
    {
        $resource = Arr::pull($options, 'resource');
        $items = Arr::pull($options, 'items', []);
        $fields = Arr::pull($options, 'fields', []);

        $instance = parent::setDependenciesAndOptions($instance, $options, $data);

        return $instance
            ->setFormFields($fields)
            ->setItems($items)
            ->setResource($resource);
    }
}
