<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\DataTables;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerUserSubscribe;

/**
 * CustomerUserSubscribe datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerUserSubscribeDataTable extends DataTable
{
	/**
	 * Get the query builder {@see DataTable::ajax()}.
	 *
	 * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
	 */
	public function query()
	{
		//  if ($user = $this->request()->user()) {
		//  	return parent::query()->whereHas('user', function ($query) use ($user) {
		//		    $query->where('id', $user->getKey());
		//	    });
		//  }

		return parent::query();
	}

	/**
	 * Get engine {@see DataTable::ajax()}.
	 *
	 * @param \Crmplease\MaterialAdmin\DataTables\DataTables $dataTables
	 * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
	 * @return \Crmplease\MaterialAdmin\DataTables\EloquentDataTable
	 */
	public function dataTable(DataTables $dataTables, $query)
	{
		//  return parent::dataTable($dataTables, $query)
		//	    ->orderColumn('name', 'SOUNDEX(name) $1, LENGTH(name) $1, name $1');

		return parent::dataTable($dataTables, $query);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns()
	{
		return [
            'customerUser.name' => [
                'data' => 'customerUser.name'
            ],
			'product.name' => [
				'data' => 'product.name'
			],

		];
	}

	/**
	 * Get columns allowed unescaped HTML content.
	 *
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
            'customerUser.name',
            'product.name',
			'action',
		];
	}

    /**
     * Aggregate columns configuration array.
     *
     * Default aggregate function: sum.
     *
     * Example:
     *
     *  'total',
     *  'price',
     *
     * or type specific:
     *
     *  'total' => 'sum',
     *  'price' => 'avg',
     *
     * or advanced configuration:
     *
     *  'total' => [
     *      'data' => 'another_column',
     *      'function' => 'sum',
     *      'distinct' => true,
     *      'format' => '%.02f %s',
     *      'format_args' => ['₽'],
     *  ],
     *  'price' => [
     *      'data' => 'price',
     *      'function' => 'sum',
     *      'format' => function($aggregate, $arg) {
     *          return sprintf("~%s %s", number_format($aggregate), $arg);
     *      },
     *      'format_args' => ['₽'],
     *  ],
     *
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [

        ];
    }

    /**
     * Filter columns configuration array.
     *
     * Available types: text (default), checkbox, choice, datepicker.
     * Compare operators: = (default), in, not_in, null, not_null
     *
     * Example:
     *
     *  'status',
     *  'event.name',
     *
     * or type specific:
     *
     *  'date' => 'datepicker',
     *  'event.name' => 'choice'
     *
     * or advanced configuration:
     *
     *  'date' => [
     *      'type' => 'datepicker',
     *      'default' => '01/01/2019 - 31/12/2019'
     *  ],
     *  'event.name' => [
     *      'type' => 'choice',
     *      'multiple' => true,
     *      'operator' => 'in',
     *      'data' => 'event.id',
     *      'lists' => 'event.name',
     *  ],
     *  'status' => [
     *      'type' => 'checkbox',
     *      'default' => 'done',
     *      'attr' => [
     *          'ts-color' => 'green',
     *          'ts-label' => 'Done',
     *      ]
     *  ],
     *
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
			'product.name' => [
				'type' => 'choice',
				'multiple' => true,
				'operator' => 'in',
				'data' => 'product.id',
				'lists' => 'product.name',
			],
			'customerUser.name' => [
				'type' => 'choice',
				'multiple' => true,
				'operator' => 'in',
				'data' => 'customerUser.id',
				'lists' => 'customerUser.name',
			],
        ];
    }

	/**
     * Get row buttons for "action" column {@see DataTable::renderActionColumn()}.
     *
	 * @param CustomerUserSubscribe $CustomerUserSubscribe
	 * @return array
	 */
	protected function getActions($CustomerUserSubscribe)
	{
		//	return [
		//		'pdf' => [
		//          'resource' => $this->resource,
		//			'url' => route('{{namespace_snake_case}}.customer_user_notification.pdf', $buildingApartment->getKey()),
		//			'target' => '_blank',
		//			'icon' => 'pdf',
		//			'color' => 'red',
		//			'title' => trans("{$this->translationNamespace}{$this->translationPrefix}.pdf.title"),
		//		],
		//	];

		return parent::getActions($CustomerUserSubscribe);
	}

    /**
	 * Get datatable buttons.
	 *
     * @return array
     */
    protected function getButtons()
    {
        //	return [
        //		[
        //			'text' => 'Import',
        //			'action' => "function(e, dt, node, config) {
        //				$.fn.DataTable.util.processAction(dt, 'import');
        //			}",
        //		],
        //		[
        //			'text' => 'Reset',
        //			'action' => "function(e, dt, node, config) {
        //				dt.search('').draw();
        //			}",
        //		],
        //		[
        //		    'extend' => 'link',
        //		    'className' => 'btn-icon-text btn-primary',
        //		    'text' => '<i class="zmdi zmdi-hc-fw zmdi-arrow-left"></i> Go',
        //		    'url' => route('{{namespace_snake_case}}.customer_user_notification.go'),
        //		]
        //		[
        //          /**
        //           * Require handle click event $(document).on('click', '[data-role="action"][data-action="create"]', handler);
        //			 */
        //          'extend' => 'action',
        //          'className' => 'btn-icon-text btn-primary',
        //			'text' => 'Create',
        //			'attr' => [
        //			    'data-role' => 'action',
        //			    'data-action' => 'create',
        //			    'data-resource' => 'customer_user_notification',
        //			    'data-url' => route('{{namespace_snake_case}}.customer_user_notification.create'),
        //			    'data-method' => 'GET',
        //			    'data-token' => csrf_token(),
        //			],
        //		],
        //		[
        //			/**
        //			 * Require action handler $.fn.dataTable.ext.buttons.customAction = function(e, dt, node, config); {@see https://datatables.net/extensions/buttons/config}.
        //			 */
        //			'text' => 'Custom Action',
        //			'action' => 'customAction',
        //		]
        //	];

        return parent::getButtons();
    }
}
