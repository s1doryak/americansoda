<?php

namespace App\DataTables\Dashboard;

use App\Repositories\Contracts\CustomerUserRepository;
use Crmplease\MaterialAdmin\DataTables\DataTables;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\AuthLog;
use Illuminate\Support\Arr;

/**
 * AuthLog datatable.
 *
 * @package App\DataTables\Dashboard
 */
class AuthLogDataTable extends DataTable
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
			'loggable.name' => [
				'data' => 'loggable.name',
                'orderable' => false,
            ],
            'date',
            'headers',
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
			'loggable.name',
            'date',
            'action',
            'headers',
        ];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
        ];
    }

     /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
            'loggable_type' => [
                'type' => 'select',
                'multiple' => false,
                'items' => loggable_type_list(),
                'query' => function ($query, $filterColumn, $value) {
                    if ($value) {
                        $query->where($filterColumn, $value);
                    }
                },
            ],
            'customer_user' => [
                'type' => 'select',
                'multiple' => true,
                'items' => app(CustomerUserRepository::class)
                    ->all()
                    ->pluck('name', 'id')
                    ->prepend(trans('models/auth_log.placeholders.customer_user'), '0')
                    ->toArray(),
                'query' => function ($query, $filterColumn, $value) {
                    if ($value) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        $query->whereIn('loggable_id', Arr::wrap($value));
                    }
                },
            ],
            'version' => [
                'type' => 'checkbox',
                'default' => false,
                'items' => [],
                'query' => function ($query, $filterColumn, $value) {
                    if ($value) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        $query->whereNotNull($filterColumn);
                    }
                },
            ],
            'sentry' => [
                'type' => 'checkbox',
                'default' => false,
                'items' => [],
                'query' => function ($query, $filterColumn, $value) {
                    if ($value) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        $query->whereNotNull($filterColumn);
                    }
                },
            ],
            'zendesk' => [
                'type' => 'checkbox',
                'default' => false,
                'items' => [],
                'query' => function ($query, $filterColumn, $value) {
                    if ($value) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        $query->whereNotNull($filterColumn);
                    }
                },
            ],
            'user_agent' => [
                'type' => 'checkbox',
                'default' => false,
                'items' => [],
                'query' => function ($query, $filterColumn, $value) {
                    if ($value) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        $query->whereNotNull($filterColumn);
                    }
                },
            ],
        ];
    }

	/**
     * Get row buttons for "action" column {@see DataTable::renderActionColumn()}.
     *
	 * @param AuthLog $authLog
	 * @return array
	 */
	protected function getActions($authLog)
	{
	    return parent::getActions($authLog);
	}

    /**
	 * Get datatable buttons.
	 *
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param AuthLog $authLog
     * @return string
     */
    public function renderLoggable__NameColumn($authLog)
    {
        if ($this->isDataTableRequest()) {
            return $authLog->loggable ? $authLog->loggable->name : $this->renderDefaultView();
        }

        return $authLog->loggable ? $authLog->loggable->name : null;
    }

    /**
     * @param AuthLog $authLog
     * @return string
     */
    public function renderHeadersColumn($authLog)
    {
        if ($this->isDataTableRequest()) {
            return $authLog->renderView('dashboard::resources.auth_log.columns.headers', ['model' => $authLog]);
        }

        return $authLog->version;
    }
}
