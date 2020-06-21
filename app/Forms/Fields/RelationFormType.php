<?php

namespace App\Forms\Fields;

use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Fields\ChildFormType;

class RelationFormType extends ChildFormType
{
    /**
     * @var Form
     */
    protected $parent;

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'relation_form';
    }

    /**
     * @return array
     */
    protected function getFormOptions()
    {
        $relationOptions = [
            'name' => $this->name,
            'items' => $this->getOption('items', []),
            'fields' => $this->getOption('fields', []),
            'resource' => $this->getOption('resource'),
        ];

        return array_merge($relationOptions, $this->getOption('formOptions'));
    }

    protected function getFormData()
    {
        $withParentData = $this->getOption('with_parent_data', true);
        $data = $withParentData
            ? array_merge($this->getOption('data'), $this->parent->getData())
            : $this->getOption('data');

        return $withParentData && $this->getOption('parent_except')
            ? Arr::except($data, $this->getOption('parent_except'))
            : $data;
    }

    /**
     * @return Form
     */
    protected function getClassFromOptions()
    {
        return $this->parent
            ->getFormBuilder()
            ->create(Form::class, $this->getFormOptions(), $this->getFormData());
    }
}
