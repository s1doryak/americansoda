<?php

namespace App\Listeners\Dashboard;

use App\Repositories\Contracts\SettingRepository;
use App\Setting;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Arr;

class AssignSettingValueItems
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param ResourceEventInterface $e
     * @return void
     */
    public function handle(ResourceEventInterface $e)
    {
        if (!$this->isValidNamespace($e->getNamespace())) {
            return;
        }

        if (!$this->isValidResource($e->getResource())) {
            return;
        }

        $attributes = $e->getAttributes();
        $params = $e->getParams();

        /** @var Setting $setting */
        $setting = $this->settingRepository->find($attributes['id']);
        $items = Arr::get($params, 'value', []);
        $setting->value = $this->cleanItems($items);
        $setting->save();
    }

    /**
     * @param array $items
     * @return array
     */
    protected function cleanItems($items)
    {
        foreach ($items as $key => $item) {
            if ($this->needRemove($item)) {
                unset($items[$key]);
            } else {
                $items[$key] = Arr::only($item, ['key', 'value', 'additional']);
            }
        }

        return $this->rebuildKeys($items);
    }

    /**
     * @param array $item
     * @return boolean|mixed
     */
    protected function needRemove($item)
    {
        return Arr::get($item, '_remove', false);
    }

    /**
     * @param array $items
     * @return array
     */
    protected function rebuildKeys(array &$items)
    {
        $key = 1;

        foreach ($items as $index => $item) {
            if (!$item['key'] || is_numeric($item['key'])) {
                $items[$index]['key'] = $key;
                $key += 1;
            }
        }

        return $items;
    }

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [
            'dashboard',
        ];
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'setting',
        ];
    }
}
