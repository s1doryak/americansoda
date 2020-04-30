<?php


namespace Crmplease\MaterialAdmin\Sidebar;

/**
 * Class Sidebar
 * @package Crmplease\MaterialAdmin
 */
class Sidebar
{
    /**
     * @var string
     */
    protected $defaultContext = 'default';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string|null $context
     * @return array
     */
    public function getData($context = null)
    {
        if (is_null($context)) {
            $context = $this->defaultContext;
        }

        return $this->data[$context] ?? [];
    }

    /**
     * @param array $data
     * @param string|null $context
     * @return Sidebar
     */
    public function setData(array $data = [], $context = null)
    {
        if (is_null($context)) {
            $context = $this->defaultContext;
        }

        $this->data[$context] = $data;

        return $this;
    }

    /**
     * @param null $context
     */
    public function appendContext($context = null)
    {
        if (is_null($context)) {
            $context = $this->defaultContext;
        }

        if (!isset($this->data[$context])) {
            $this->data[$context] = [];
        }

        return $this;
    }

    public function appendSection($section, $label = null, $context = null)
    {
        $this->appendContext($context);

        if (!isset($this->data[$context][$section])) {
            $this->data[$context][$section] = [
                'title' => $label,
                'resources' => []
            ];
        }
    }

    /**
     * @param string $data
     * @param string|null $context
     * @return Sidebar
     */
    public function appendItem($url, $label, $section, $context = null)
    {
        $this->appendContext($context)
            ->appendSection($section, null, $context);

        if (!isset($this->data[$context][$section]['resources'])) {
            $this->data[$context][$section]['resources'] = [];
        }

        $this->data[$context][$section]['resources'][$url] = $label;

        return $this;
    }
}
