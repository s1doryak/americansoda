<?php

namespace Crmplease\MaterialAdmin\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class File extends FormField
{
	/**
	 * Get the template, can be config variable or view path.
	 *
	 * @return string
	 */
	protected function getTemplate()
	{
		return 'file';
	}
}