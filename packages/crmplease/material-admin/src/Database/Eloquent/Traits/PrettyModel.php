<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits;

use Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField;

trait PrettyModel
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
            return (string)$fallback;
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
     * @return string
     */
    public function renderActionView(array $actions = [])
    {
        return $this->renderView('datatables::columns.action', [
            'actions' => $actions
        ], null);
    }
}
