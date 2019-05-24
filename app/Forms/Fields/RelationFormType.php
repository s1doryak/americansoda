<?php

namespace App\Forms\Fields;

use App\Forms\BaseForm;
use Kris\LaravelFormBuilder\Fields\ChildFormType;
use Kris\LaravelFormBuilder\Form;

class RelationFormType extends ChildFormType
{
    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'relation_form';
    }

    /**
     * @return Form
     */
    protected function getClassFromOptions()
    {
        if ($this->form instanceof Form) {
            return $this->form->setName($this->name);
        }

        $fields = $this->getOption('fields');

        if ($fields) {
            $form = BaseForm::class;

            $formOptions = array_merge(
                [
                    'model' => $this->parent->getModel(),
                    'name' => $this->name,
                    'language_name' => $this->parent->getLanguageName(),
                    'items' => $this->getOption('items', []),
                    'fields' => $this->getOption('fields', []),
                    'resource' => $this->getOption('resource'),
                ],
                $this->getOption('formOptions')
            );

            $data = array_merge($this->parent->getData(), $this->getOption('data'));

            return $this->parent->getFormBuilder()->create($form, $formOptions, $data);
        }

        $class = $this->getOption('class');

        if (!$class) {
            throw new \InvalidArgumentException(
                'Please provide full name or instance of Form class.'
            );
        }

        if (is_string($class)) {
            $options = [
                'model' => $this->parent->getModel(),
                'name' => $this->name,
                'language_name' => $this->parent->getLanguageName(),
            ];

            if (!$this->parent->clientValidationEnabled()) {
                $options['client_validation'] = false;
            }

            if (!$this->parent->haveErrorsEnabled()) {
                $options['errors_enabled'] = false;
            }

            $formOptions = array_merge(
                $options,
                $this->getOption('formOptions')
            );

            $data = array_merge($this->parent->getData(), $this->getOption('data'));

            if (!ends_with($class, 'Form')) {
                $form = BaseForm::class;
                $model = new $class;
                $extra = [
                    'items' => $this->getOption('items', []),
                    'fields' => $this->getOption('fields', []),
                    'resource' => $this->getOption('resource'),
                ];
                $fieldsMethod = 'getFormFields';
                $optionsMethod = 'getFormOptions';

                if (method_exists($model, $fieldsMethod)) {
                    $extra['fields'] = call_user_func([$model, $fieldsMethod]);
                }

                if (method_exists($model, $optionsMethod)) {
                    $extra = array_merge($extra, call_user_func([$model, $optionsMethod]));
                }

                $formOptions = array_merge($formOptions, $extra);
            } else {
                $form = $class;
                $extra = [
                    'items' => $this->getOption('items', []),
                    'fields' => $this->getOption('fields', []),
                    'resource' => $this->getOption('resource'),
                ];

                $formOptions = array_merge($formOptions, $extra);
            }

            return $this->parent->getFormBuilder()->create($form, $formOptions, $data);
        }

        if ($class instanceof Form) {
            $class->setName($this->name, false);
            $class->setModel($class->getModel() ?: $this->parent->getModel());

            if (!$class->getData()) {
                $class->addData($this->parent->getData());
            }

            if (!$class->getLanguageName()) {
                $class->setLanguageName($this->parent->getLanguageName());
            }

            if (!$this->parent->clientValidationEnabled()) {
                $class->setClientValidationEnabled(false);
            }

            if (!$this->parent->haveErrorsEnabled()) {
                $class->setErrorsEnabled(false);
            }

            return $class->setName($this->name);
        }

        throw new \InvalidArgumentException(
            'Class provided does not exist or it passed in wrong format.'
        );
    }
}
