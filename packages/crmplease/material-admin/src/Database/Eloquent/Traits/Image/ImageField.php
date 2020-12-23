<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image;

use Crmplease\MaterialAdmin\Database\Eloquent\Traits\Interfaces\FileFieldInterface;
use File;

class ImageField implements FileFieldInterface
{
    public $original;
    protected $dimension;

    public function __construct(array $dimensions = [])
    {
        if (empty($dimensions) || !isset($dimensions['original'])) {

            $this->original = new ImageLocal();
            $this->original->url = null;
            $this->original->height = null;
            $this->original->width = null;

        }

        foreach ($dimensions as $dimension => $attributes) {

            $this->$dimension = new ImageLocal();
            $this->$dimension->url = isset($attributes['url']) ? $attributes['url'] : null;
            $this->$dimension->width = isset($attributes['width']) ? $attributes['width'] : null;
            $this->$dimension->height = isset($attributes['height']) ? $attributes['height'] : null;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->original->url;
    }

    public function toJson()
    {
        return json_encode($this);
    }

    /**
     * @return boolean
     */
    public function delete()
    {
        $images = json_decode($this->toJson(), true);

        foreach ($images as $image) {

            File::delete($image['url']);
        }

        return true;
    }

    /**
     * @param string $dimension
     * @param string $attribute
     * @return string
     */
    public function getByDimension($dimension, $attribute = 'url')
    {
        $dimension = $this->{$dimension} ?? $this->original;

        return $dimension->$attribute;
    }
}
