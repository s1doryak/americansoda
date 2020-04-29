<?php namespace Crmplease\MaterialAdmin\DataTables\Html;

/**
 * Class Column
 */
class Column extends \Yajra\DataTables\Html\Column
{
	/**
	 * Column constructor.
	 *
	 * @param array $attributes
	 */
	public function __construct(array $attributes = [])
	{
		$attributes['orderable'] = isset($attributes['orderable']) ? $attributes['orderable'] : true;
		$attributes['exportable'] = isset($attributes['exportable']) ? $attributes['exportable'] : true;
		$attributes['printable'] = isset($attributes['printable']) ? $attributes['printable'] : true;
		$attributes['searchable'] = isset($attributes['searchable']) ? $attributes['searchable'] : false;
		$attributes['aggregate'] = isset($attributes['aggregate']) ? $attributes['aggregate'] : false;
		$attributes['footer'] = isset($attributes['footer']) ? $attributes['footer'] : null;
		$attributes['template'] = isset($attributes['template']) ? $attributes['template'] : null;
		$attributes['defaultContent'] = isset($attributes['defaultContent']) ? $attributes['defaultContent'] : null;
		$attributes['attr'] = isset($attributes['attr']) ? $attributes['attr'] : [];

		parent::__construct($attributes);
	}

	public function parseDefaultContent($value)
	{
		return view()->make('datatables::columns.default')->render();
	}

	public function parseFooter($value)
	{
		return trans('material-admin::datatables.attributes.footer');
	}
}
