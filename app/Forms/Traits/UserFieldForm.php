<?php

namespace App\Forms\Traits;

use Auth;
use Gate;

trait UserFieldForm
{
	/**
	 * @param \App\User|null $entity
	 * @return array|string
	 */
	protected static function provideUserFormField($entity = null)
	{
		$value = null;

		if (Auth::user()) {
			$value = Auth::user()->getKey();
		}

		if ($entity) {
			$value = $entity->user_id;
		}

		if (Gate::allows('edit-users')) {
			$field = 'select';
		} else {
			$field = [
				'type' => 'hidden',
				'value' => $value
			];
		}

		return $field;
	}
}