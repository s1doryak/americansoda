<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image;

use File;
use Illuminate\Http\UploadedFile;

class ImageService
{
	protected $extension = 'jpeg';

	protected $model;

	protected $attribute;

	/**
	 * Imageine instance
	 *
	 * @var \Imagine\Gd\Imagine|\Imagine\Gmagick\Imagine|\Imagine\Imagick\Imagine
	 */
	protected $imagine;

	public function __construct($model = null)
	{
		$library = config('images.library');

		switch ($library) {
			case 'imagick':
				$this->imagine = new \Imagine\Imagick\Imagine();
				break;
			case 'gmagick':
				$this->imagine = new \Imagine\Gmagick\Imagine();
				break;
			default:
				$this->imagine = new \Imagine\Gd\Imagine();
				break;
		}
	}

	/**
	 * @param $model
	 *
	 * @return $this
	 */
	public function setModel($model)
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * @param $attribute
	 *
	 * @return $this
	 */
	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;

		return $this;
	}

	public function getExtension(\SplFileInfo $fileInfo)
	{
		return $fileInfo->getExtension() ?: $this->extension;
	}

	/**
	 * Get ImageFieldLocal from json data
	 *
	 * @param null $jsonData
	 *
	 * @return ImageField
	 */
	public function getImageFieldObject($json = null)
	{
		if (is_json($json)) {
			$dimensions = json_decode($json, true);
		} else {
			$dimensions = $this->getActualDimensions();
		}

		return new ImageField($dimensions);
	}

	public function getActualDimensions()
	{
		$actualDimensions = [];

		$dimensions = config('images.dimensions');

		foreach ($dimensions as $model => $attributes) {

			$className = get_class($this->model);

			if ($model == $className) {

				foreach ($attributes as $attribute => $attributeDimensions) {

					if ($attribute == $this->attribute) {

						$actualDimensions[$attribute] = [];

						foreach ($attributeDimensions as $key => $value) {

							/**
							 * If has many sizes
							 */
							if (is_array($value)) {

								unset($actualDimensions[$attribute]);

								$actualDimensions[$key] = $value;

							} else {

								$actualDimensions[$attribute][$key] = $value;

							}
						}
					}
				}
			}
		}

		return $actualDimensions;
	}

	/**
	 * @param \SplFileInfo $image
	 *
	 * @return ImageField
	 */
	public function createImageFieldObject(\SplFileInfo $image)
	{
		$dimensions = $this->getActualDimensions();

		$imageField = new ImageField($dimensions);

		$imageField->original->url = $this->getRelativePath($image);

		list($imageField->original->width, $imageField->original->height) = @getimagesize($image->getPathname()) ?: [0, 0];

		foreach ($dimensions as $dimension => $attributes) {
			$name = $dimension;

			$width = (int)$attributes['width'];
			$height = isset($attributes['height']) ? (int)$attributes['height'] : $width;
			$crop = isset($attributes['crop']) ? (boolean)$attributes['crop'] : false;
			$quality = isset($attributes['quality']) ? (int)$attributes['quality'] : config('images.quality');


			$destination = new \SplFileInfo(
				sprintf(
					"%s/%sx%s%s/%s",
					$image->getPath(),
					$width,
					$height,
					($crop ? '_crop' : ''),
					$image->getFilename()
				)
			);

			$resized = $this->resize($image, $destination, $width, $height, $crop, $quality);

			if ($name && $resized) {

				$imageField->{$name}->url = $this->getRelativePath($resized);

				list($imageField->{$name}->width, $imageField->{$name}->height) = @getimagesize($resized->getPathname()) ?: [0, 0];
			}

		}

		return $imageField;
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return ImageField
	 */
	public function copyImage($key, $value)
	{
		$original = new \SplFileInfo($value);

		$image = new \SplFileInfo($this->generateFileName($this->getExtension($original)));

		if (!File::isDirectory($image->getPath())) {
			File::makeDirectory($image->getPath(), 0777, true);
		}

		File::copy($original->getPathname(), $image->getPathname());

		$imageField = $this->createImageFieldObject($image);

		return $imageField;
	}

	/**
	 * @param $key
	 * @param UploadedFile $value
	 *
	 * @return ImageField
	 */
	public function uploadImage($key, $value)
	{
		$original = $value;

		$image = new \SplFileInfo($this->generateFileName($original->getClientOriginalExtension()));

		$original->move($image->getPath(), $image->getFilename());

		$imageField = $this->createImageFieldObject($image);

		return $imageField;
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return ImageField
	 */
	public function downloadImage($key, $value)
	{
		$original = new \SplFileInfo($value);

		$image = new \SplFileInfo($this->generateFileName($this->getExtension($original)));

		if (!File::isDirectory($image->getPath())) {
			File::makeDirectory($image->getPath(), 0777, true);
		}

		copy(
			$original->getPathname(),
			$image->getPathname(),
			stream_context_create(
				[
					'ssl' => [
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true,
					],
				]
			)
		);

		$imageField = $this->createImageFieldObject($image);

		return $imageField;
	}

	/**
	 * @return string
	 */
	public function getStoragePath()
	{
		$compiled = str_replace(
			[
				'{model}',
				'{attribute}',
			],
			[
				$this->model->getTable(),
				$this->attribute,
			],
			config('images.path')
		);

		return sprintf("%s/%s", public_path(), $compiled);
	}

	/**
	 * @return string
	 */
	public function getRelativePath(\SplFileInfo $image)
	{
		return str_replace(public_path(), '', $image->getPathname());
	}

	/**
	 * @param $extension
	 *
	 * @return string
	 */
	public function generateFileName($extension)
	{
		do {
			$fileName = sprintf("%s/%s.%s", $this->getStoragePath(), str_random(16), $extension);
		} while (File::exists($fileName));

		return $fileName;
	}

	/**
	 * @param \SplFileInfo $source
	 * @param \SplFileInfo $destination
	 * @param integer $width
	 * @param null $height
	 * @param boolean $crop
	 * @param integer $quality
	 *
	 * @return \SplFileInfo
	 */
	public function resize(
		\SplFileInfo $source,
		\SplFileInfo $destination,
		$width = 100,
		$height = null,
		$crop = false,
		$quality = 90
	)
	{
		if (!File::isDirectory($destination->getPath())) {
			File::makeDirectory($destination->getPath(), 0777, true);
		}

		try {

			// Set the size
			$size = new \Imagine\Image\Box($width, $height);

			// Now the mode
			$mode = $crop ? \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND : \Imagine\Image\ImageInterface::THUMBNAIL_INSET;

			$this->imagine
				->open($source)
				->thumbnail($size, $mode)
				->save($destination->getPathname(), array('quality' => $quality));

		} catch (\Exception $e) {

			\Log::error('[IMAGE SERVICE] Image resize Failed to crop image  [' . $e->getMessage() . ']');

		}

		return $destination;
	}
}
