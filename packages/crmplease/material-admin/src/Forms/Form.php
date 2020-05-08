<?php

namespace Crmplease\MaterialAdmin\Forms;

use Crmplease\MaterialAdmin\Forms\Extensions\FormBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Base form.
 *
 * @package Crmplease\MaterialAdmin\Forms
 */
class Form extends \Kris\LaravelFormBuilder\Form
{
    /**
     * @var FormBuilder
     */
    protected $formBuilder;

    /**
     * @var array
     */
    private $fieldsArray;

    /**
     * @var string
     */
    private $resource;

    /**
     * @var mixed
     */
    private $items;

    /**
     * Specify default options form the HTML form.
     *
     * @return array
     */
    public static function getDefaultOptions()
    {
        return [
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ];
    }

    /**
     * Returns the instance of the FormBuilder.
     *
     * @return FormBuilder
     */
    public function getFormBuilder()
    {
        return $this->formBuilder;
    }

    /**
     * Build form using some assumptions.
     *
     * @return void
     */
    public function buildForm()
    {
        $fields = $this->getFieldsArray();

        foreach ($fields as $name => $options) {

            if (is_null($options)) {
                continue;
            }

            $isArray = is_array($options);
            $type = $isArray ? Arr::get($options, 'type') : $options;

            $selectable = in_array($type, ['choice', 'select', 'entity', 'collection']);

            if ($selectable && (!$isArray || !isset($options['choices']))) {
                $options = $this->makeChoices($name, $options);
            }

            $options = $this->makeOptions($name, $options);

            $options = $this->makeLabel($name, $options);

            $this->add($name, $type, $options);
        }

        if ($this->getFormOption('submit', false) && !array_key_exists('submit', $fields)) {

            $this->add(
                'submit',
                'submit',
                [
                    'attr' => ['class' => 'btn btn-primary btn-sm'],
                    'label' => trans(
                        sprintf('material-admin::forms.buttons.%s', resource_action() == 'edit' ? 'update' : resource_action())
                    ),
                ]
            );

        }
    }

    /**
     * Make choices array for 'select' and 'choice' field types.
     *
     * @param string $field
     * @param $options
     *
     * @return mixed
     */
    private function makeChoices($field, $options)
    {
        if (is_string($options)) {
            $options = ['type' => $options];
        }

        $name = Str::endsWith($field, '_id') ? substr($field, 0, strrpos($field, '_id')) : $field;
        $plural = Str::plural($name);

        $options['choices'] = $this->getData($plural . '.items', []);
        $options['selected'] = $this->getData($plural . '.selected');
        $options['options'] = $this->getData($plural . '.options', Arr::get($options, 'options'));

        if (isset($options['empty_value'])) {
            $options['choices'] = ['' => $options['empty_value']] + (array)$options['choices'];
        }

        return $options;
    }

    /**
     * Make options array.
     *
     * @param string $field
     * @param string|array $options
     *
     * @return array
     */
    private function makeOptions($field, $options)
    {
        $options = is_string($options) ? ['type' => $options] : $options;

        if (!array_key_exists('value', $options)) {
            $options['value'] = $this->getData($field);
        }

        return $options;
    }

    /**
     * Make options array.
     *
     * @param string $field
     * @param string|array $options
     *
     * @return array
     */
    private function makeLabel($field, $options)
    {
        $options = is_string($options) ? ['type' => $options] : $options;

        $selectable = in_array($options['type'], ['choice', 'select', 'entity', 'collection']);

        $options = array_merge([
            'label' => $selectable ? $this->getModelRelationFieldLabel($field, $options) : $this->getModelFieldLabel($field),
        ], $options);

        return $options;
    }

    /**
     * Get translated field label.
     *
     * @param string $field
     *
     * @return string
     */
    protected function getModelFieldLabel($field)
    {
        return trans(
            preg_replace('/\[(%%idx%%|[0-9])\]/mui', '[]', sprintf('models/%s.fields.%s', $this->getResource(), $field))
        );
    }

    /**
     * Get translated relation field label.
     *
     * @param string $field
     * @param array $options
     *
     * @return string
     */
    protected function getModelRelationFieldLabel($field, $options)
    {
        $label = sprintf('models/%s.fields.%s.%s', $this->getResource(), $field, $options['lists'] ?? 'name');

        return trans(
            preg_replace('/\[(%%idx%%|idx|\d*)]/mui', '[]', $label)
        );
    }

    /**
     * Return fields array for the builder.
     *
     * @return array
     * @see buildForm()
     */
    public function getFieldsArray()
    {
        return $this->fieldsArray;
    }

    /**
     * Set fields array for the builder.
     *
     * @param array $fields
     *
     * @return $this
     */
    public function setFormFields(array $fields)
    {
        $this->fieldsArray = $fields;

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items = [])
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Return form resource.
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set form resource.
     *
     * @param string $resource
     *
     * @return $this
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }
}
