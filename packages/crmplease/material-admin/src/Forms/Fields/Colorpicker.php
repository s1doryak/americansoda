<?php

namespace Crmplease\MaterialAdmin\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class Colorpicker extends FormField
{
	/**
	 * Get the template, can be config variable or view path.
	 *
	 * @return string
	 */
	protected function getTemplate()
	{
		return 'colorpicker';
	}

	/**
	 * Merge all defaults with field specific defaults and set template if passed.
	 *
	 * @param array $options
	 */
	protected function setDefaultOptions(array $options = [])
	{
		parent::setDefaultOptions($options);

		if (isset($options['value'])) {
			$this->setOption('value', $options['value']);
		} else {
			$this->setOption('value', config('colors.primary'));
		}

		if (isset($options['palette'])) {
			$this->setOption('palette', $options['palette']);
		} else {
			$this->setOption('palette', config('colors.palette'));
		}
	}
}