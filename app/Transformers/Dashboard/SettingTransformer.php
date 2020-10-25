<?php

namespace App\Transformers\Dashboard;

use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;
use Illuminate\Support\Arr;

/**
 * Setting transformer.
 *
 * @package App\Transformers\Dashboard
 */
class SettingTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'name' => $request->get('name'),
            'value' => $request->get('value', []),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'name' => $request->get('name'),
            'value' => $request->get('value', [])
        ];
    }

    /**
     * @param \App\Setting $setting
     * @return array
     */
    public static function toArray($setting)
    {
        return [
            'id' => (int)$setting->getKey(),
            'name' => $setting->name,
            'value' => $setting->value,


            'created_at' => (string)$setting->created_at,
            'updated_at' => (string)$setting->updated_at,
            'deleted_at' => (string)$setting->deleted_at,
        ];
    }
}
