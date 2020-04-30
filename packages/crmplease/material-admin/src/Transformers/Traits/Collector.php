<?php

namespace Crmplease\MaterialAdmin\Transformers\Traits;

use Illuminate\Support\Collection;

trait Collector
{
    /**
     * @param Collection $collection
     * @return Collection
     */
	public static function map($collection)
	{
		return $collection->map(function ($item) {
			return self::toArray($item);
		});
	}
}
