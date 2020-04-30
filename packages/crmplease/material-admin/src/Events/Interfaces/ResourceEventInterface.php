<?php namespace Crmplease\MaterialAdmin\Events\Interfaces;

interface ResourceEventInterface
{
    /**
     * @return string
     */
    public function getNamespace();

    /**
     * @return string
     */
    public function getResource();

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return array
     */
    public function getAttributes();

    /**
     * @return array
     */
    public function getParams();
}
