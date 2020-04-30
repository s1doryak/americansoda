<?php namespace Crmplease\MaterialAdmin\DataTables\Traits;

use Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField;

trait RenderHelpers
{
	/**
	 * @param $template
	 * @param array $data
	 * @param null $fallback
	 * @return string
	 */
	public function renderView($template, $data = [], $fallback = null)
	{
		try {
			return view()->make($template)->with($data)->render();
		} catch (\Throwable $e) {
			return (string)$e->getMessage();
		}
	}

	/**
	 * @return string
	 */
	public function renderDefaultView()
	{
		return $this->renderView('datatables::columns.default');
	}

	/**
	 * @param $email
	 * @return string
	 */
	public function renderEmailView($email)
	{
		return $this->renderView('datatables::columns.email', [
			'email' => (string)$email,
		], $email);
	}

	/**
	 * @param $phone
	 * @return string
	 */
	public function renderPhoneView($phone)
	{
		return $this->renderView('datatables::columns.phone', [
			'phone' => (string)$phone,
		], $phone);
	}

	/**
	 * @param $title
	 * @param string $color
	 * @param array $classes
	 * @return string
	 */
	public function renderBadgeView($title, $color = 'bgm-primary', array $classes = [])
	{
		return $this->renderView('datatables::columns.badge', [
			'title' => (string)$title,
			'color' => (string)$color,
			'classes' => (array)$classes,
		], $title);
	}

	/**
	 * @param $title
	 * @param $icon
	 * @param string $color
	 * @param array $classes
	 * @return string
	 */
	public function renderIconView($title, $icon, $color = 'c-primary', array $classes = ['zmdi-hc-lg', 'zmdi-hc-fw'])
	{
		return $this->renderView('datatables::columns.icon', [
			'title' => (string)$title,
			'icon' => (string)$icon,
			'color' => (string)$color,
			'classes' => (array)$classes
		], $title);
	}

	/**
	 * @param $title
	 * @param null $subtitle
	 * @param null $image
	 * @param string $thumbnail_size
	 * @return string
	 */
	public function renderMediaView($title, $subtitle = null, $image = null, $thumbnail_size = 'original')
	{
		if ($image instanceof ImageField) {
			$thumbnail = $original = (string)$image->original->url;

			if (isset($image->{$thumbnail_size})) {
				$thumbnail = (string)$image->{$thumbnail_size}->url;
			}
		} else {
			$thumbnail = $original = (string)$image;
		}

		return $this->renderView('datatables::columns.media', [
			'title' => (string)$title,
			'subtitle' => (string)$subtitle,
			'image' => $original,
			'thumbnail' => $thumbnail,
		], $title);
	}

	/**
	 * @param array $actions
	 * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model|null $model
	 * @return string
	 */
	public function renderActionView(array $actions = [], $model = null)
	{
		if ($model) {
			$actions = collect($actions)->filter(function ($attributes, $action) use ($model) {

				/**
				 * Have nested action
				 */
				if (isset($attributes['actions'])) {
					return true;
				}

				return $this->can($action, $model);

			})->toArray();
		}

		return $this->renderView('datatables::columns.action', [
			'actions' => $actions
		], null);
	}

	/**
	 * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
	 *
	 * @return string
	 */
	public function renderNameColumn($model)
	{
		return $this->renderView('datatables::columns.name', [
			'model' => $model
		], $model->name);
	}

	/**
	 * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
	 *
	 * @return string
	 */
	public function renderCreatedAtColumn($model)
	{
		return $this->renderView('datatables::columns.created_at', [
			'model' => $model
		], $model->created_at);
	}

	/**
	 * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
	 *
	 * @return string
	 */
	public function renderUpdatedAtColumn($model)
	{
		return $this->renderView('datatables::columns.updated_at', [
			'model' => $model
		], $model->updated_at);
	}

	/**
	 * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
	 *
	 * @return string
	 */
	public function renderDeletedAtColumn($model)
	{
		return $this->renderView('datatables::columns.deleted_at', [
			'model' => $model
		], $model->deleted_at);
	}

	/**
	 * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
	 *
	 * @return string
	 */
	public function renderActionColumn($model)
	{
		$actions = $this->getActions($model);

		return $this->renderActionView($actions, $model);
	}
}
