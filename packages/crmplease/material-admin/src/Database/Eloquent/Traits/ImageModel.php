<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits;

use Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageLocal;
use Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageService;
use Illuminate\Http\UploadedFile;

/**
 * Class ImageModel
 *
 * @package Crmplease\MaterialAdmin\Database\Eloquent\Traits
 */
trait ImageModel
{
	public function getImageAttributeValue($key)
	{
		$imageService = new ImageService();
		$imageService
			->setModel($this)
			->setAttribute($key);

		return $imageService->getImageFieldObject($this->getAttributeValue($key));
	}

	public function setImageAttributeValue($key, $value)
	{
		if (!isset($value)) {
			return false;
		}

		$imageService = new ImageService();
		$imageService
			->setModel($this)
			->setAttribute($key);

		/**
		 * Если передан URL, то скачиваем файл
		 */
		if (is_url($value)) {

			$value = $imageService->downloadImage($key, $value)->toJson();

			$this->attributes[$key] = $value;

			return $this;
		}

		/**
		 * Если передана строка JSON, то присвоим её в неизменном виде
		 */
		if (is_json($value)) {

			$this->attributes[$key] = $value;

			return $this;
		}

		/**
		 * Если передан объект, то загрузим или скачаем
		 */
		if (is_object($value)) {

			switch (get_class($value)) {

				/**
				 * $model->image = Input::file('image');
				 */
				case UploadedFile::class:

					$value = $imageService->uploadImage($key, $value)->toJson();

					$this->attributes[$key] = $value;

					return $this;

					break;

				/**
				 * $model->image = $other->image;
				 */
				case ImageLocal::class:

					$value = $imageService->copyImage($key, $value)->toJson();

					$this->attributes[$key] = $value;

					return $this;

					break;

			}
		}

		/**
		 * Если передан путь к файлу на диске
		 */
		if (is_readable($value)) {

			$value = $imageService->copyImage($key, $value)->toJson();

			$this->attributes[$key] = $value;

			return $this;
		}

		return false;
	}

	public static function bootImageModel()
	{
		static::updated(function ($model) {

			$attributes = $model->getAttributes();

			$dirty = $model->getDirty();

			$imageService = new ImageService();
			$imageService->setModel($model);

			/**
			 * Пройдемся по всем изображениям модели и посмотрим, были ли они изменены
			 */
			foreach ($model->images as $field) {

				if (empty($attributes[$field]) || empty($dirty[$field])) {
					continue;
				}

				$imageService->setAttribute($field);

				$imageObject = $imageService->getImageFieldObject($attributes[$field]);

				if ($imageObject) {

					$imageObject->delete();

				}
			}

		});

		static::deleted(function ($model) {

			/**
			 * Determine if the model have _not_ been modified.
			 */
			if (!count($model->getDirty())) {

				foreach ($model->images as $field) {
					$model->$field->delete();
				}
			}

		});

	}

}