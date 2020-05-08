<?php namespace Crmplease\MaterialAdmin\Console\Commands\Resources;

interface ResourceCreatorContract
{
	/**
	 * @return string
	 */
	public function getEventNamespace();

	/**
	 * @return string
	 */
	public function getEventResource();

    /**
     * @return string
     */
    public function getEventAction();

	/**
	 * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
	 * @return array
	 */
	public function getEventAttributes($model);

	/**
	 * @return array
	 */
	public function getEventParams();
}
